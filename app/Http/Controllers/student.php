<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use validator;
use App\tblstudent;
use Cookie;
use Session;
use Redirect;
use App\tblevent;
use App\participant;
class student extends Controller
{
 
 

    public function logout()//destroy cookies and session
    {
            Session::flush(); 
            \Cookie::queue(\Cookie::forget('clgcode'));
            \Cookie::queue(\Cookie::forget('senrl'));
            return redirect('/login');
    }
    //check for cookies Exist or not or values
    // public function getc(Request $req) 
    // {
    //         $value=$req->cookie('clgcode');
    //         $value2=$req->cookie('senrl');
    //     $login_details = tblstudent::where([
    //         ['clgcode', '=',$value],
    //         ['senrl', '=',$value2]
    //     ])->count();
    //     session()->put('sno',$value2);
    //     echo $value."-".$value2;
    //     if (Cookie::get('clgcode') !== null)
    //     {
    //         echo "-cookie set";
    //     }                
    //     else
    //     {
    //         echo "-not set";
    //     }   
    // }
    public function getevents()
    {
        $events=tblevent::where([['clgcode',Session::get('clgcode')],
        ['reg_end_date','>',date('Y-m-d H:i:s')],
        ['reg_start_date','<=',date('Y-m-d')]])
        ->where(function($q){
            $q->where('gallow',Session::get('gender'))
            ->orWhere('gallow','both');
        })
        ->orderby('reg_end_date')->get()->toArray();
        return $events;
    }
    public function login(Request $req)//when load Login page to Check Cookies Exist or not
    {
        $clg=DB::table('tblcolleges')->get();
		
        if (Cookie::get('clgcode') !== null)
        {
            $clgcode=$req->cookie('clgcode');
            $senrl=$req->cookie('senrl');
            $login_details = tblstudent::where([
            ['clgcode', '=',$clgcode],
            ['senrl', '=',$senrl]
        ])->count();
         if ($login_details==1) 
         {
            $user_details = tblstudent::where([
                ['clgcode', '=', $clgcode],
                ['senrl', '=', $senrl]
            ])->first();
            $clg=\DB::table('tblcolleges')->where('clgcode', $clgcode)->first();
            session()->put('senrl', $senrl);
            session()->put('sname',$user_details['sname']);
            session()->put('rno',$user_details['rno']);
            session()->put('email',$user_details['email']);
            session()->put('mobile',$user_details['mobile']);
            session()->put('dob',$user_details['dob']);
            session()->put('class',$user_details['class']);
            session()->put('gender',$user_details['gender']);
            session()->put('clgname',$clg->clgname);
            session()->put('div',$user_details['division']);
            session()->put('address',$user_details['address']);
            session()->put('clgcode', $clgcode);

            $events=$this->getevents();
            return view('/index',['events'=>$events]);
         } 
         else{
            return view('login',['clg'=>$clg]);;
         }
        } 
        else
        {
            return view('login',['clg'=>$clg]);;
        }
        
    }
    public function index()
    {
        $events=$this->getevents();
        return view('/index',['events'=>$events]);

    }
    public function checklogin(Request $req)//check student data for login other wise return error
    {
        $login_details = tblstudent::where([
            ['clgcode', '=', $req->clgcode],
            ['senrl', '=', $req->senrl]
        ])->count();
        if ($login_details==1) 
        {
            $user_details = tblstudent::where([
                ['clgcode', '=', $req->clgcode],
                ['senrl', '=', $req->senrl]
            ])->first();
            $clg=\DB::table('tblcolleges')->where('clgcode', $req->clgcode)->first();
            session()->put('senrl', $req->senrl);
            session()->put('sname',$user_details['sname']);
            session()->put('rno',$user_details['rno']);
            session()->put('email',$user_details['email']);
            session()->put('mobile',$user_details['mobile']);
            session()->put('dob',$user_details['dob']);
            session()->put('class',$user_details['class']);
            session()->put('gender',$user_details['gender']);
            session()->put('clgname',$clg->clgname);
            session()->put('div',$user_details['division']);
            session()->put('address',$user_details['address']);
            session()->put('clgcode', $req->clgcode);
            $events=$this->getevents();
            return view('/index',['events'=>$events]);
        } 
        else
        {
            return back()->with('error','Invalid College name or Enrollment Number');
        }
    }
    public function explore($cat)//function for explore event
    {
        $n=tblevent::where([['clgcode',Session::get('clgcode')],['category',$cat],['reg_end_date','>',date('Y-m-d')]])->count();
        if($n>0)
        {
            $events=tblevent::where([['clgcode',Session::get('clgcode')],
                                            ['category',$cat],
                                            ['reg_end_date','>',date('Y-m-d')],
                                            ['reg_start_date','<=',date('Y-m-d')]])
                                            ->where(function($q){
                                                $q->where('gallow',Session::get('gender'))
                                                ->orWhere('gallow','both');
                                            })
                                            ->get()->toArray();
            return view('explore-events',['events'=>$events]);
        }
        return view('explore-events')->with('massege','No Events available');
    }
    public function participate($eid)//function run when click on participate
    {
        $einfo=tblevent::where('eid',decrypt($eid))->first();

        return view('participate-now',['einfo'=>$einfo]);
    }
    public function confirm($eid)//function used fron confirm participation
    {
        $participant=new participant;
        $participant->eid=decrypt($eid);
        $participant->senrl=Session::get('senrl');
        $participant->clgcode=Session::get('clgcode');
        $participant->rank="p";
        $participant->reg_date=date("Y:m:d");
        $participant->save();
        session()->flash('alert-success', 'insert successfully!');
    	return redirect()->to('/index');
    }
    
    public function team_ins($eid)//insert team
    {
        $einfo=tblevent::where('eid',decrypt($eid))->first();
        return view('team-insert',['einfo'=>$einfo]);
    }
    public function insert_team(Request $request,$galw,$awl_diff_class,$a_d_d)//validation for team insert
    {
        $i=0; 
        $request->validate([
            'enrl.*' => 'required|distinct',
        ],
        [
            'enrl.*.required' => '* Please Enter player enrollment no',
            'enrl.*.distinct' => '* You Enter same enrollment number more then ones'
        ]);
        $galw=decrypt($galw);
        $awl_diff_class=decrypt($awl_diff_class);
        $a_d_d=decrypt($a_d_d);
        foreach($request->enrl as $enr)
		{
            $i++;
            if($galw=="both" && $awl_diff_class=="yes")
            {
                $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr]])->get()->toArray();
                if(!$st)
                {
                    ${'e'.$i}="*Invalid Enrollment Id of player".$i;
                    return back()->with('error'."$i",${'e'.$i});
                }
               
            }
            elseif($galw=="both" && $awl_diff_class=="no" && $a_d_d=="yes")
            {
                $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['class',Session::get('class')]])->get()->toArray();
                
                if(!$st)
                {
                     $e="*player ".$i." is not from ".Session::get('class') . "class or invalid Enrollment" ;
                     return back()->with('error'."$i",${'e'.$i});
                }
            }
            elseif($galw=="both" && $awl_diff_class=="no" && $a_d_d=="no")
            {
                $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['class',Session::get('class')],['division',Session::get('div')]])->get()->toArray();
                
                if(!$st)
                {
                     $e="*player ".$i." is not from ".Session::get('class') . "class or invalid Enrollment" ;
                     return back()->with('error'."$i",${'e'.$i});
                }
            }
            elseif($galw==Session::get('gender') && $awl_diff_class=="yes" )
            {
                $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['gender',$galw]])->get()->toArray();
                
                if(!$st)
                {
                    $e="*player ".$i." is not ". Session::get('gender')." or invalid enrollment number";
                    // echo $e;
                    return back()->with('error'."$i",${'e'.$i});

                }
            }
            elseif($galw==Session::get('gender') && $awl_diff_class=="no" && $a_d_d=="yes")
            {
                $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['gender',$galw],['class',Session::get('class')]])->get()->toArray();
                
                if(!$st)
                {
                  $e="*player ".$i." is not ".Session::get('gender') . " or not from class ".Session::get('class') . " or invalid Enrollment" ;
                  return back()->with('error'."$i",${'e'.$i});
                }
            }
            elseif($galw==Session::get('gender') && $awl_diff_class=="no" && $a_d_d=="no")
            {
                $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['gender',$galw],['class',Session::get('class')],['division',Session::get('div')]])->get()->toArray();
                
                if(!$st)
                {
                    ${'e'.$i}="*player ".$i." is not ".Session::get('gender') . " or not from class ".Session::get('class') . " or invalid Enrollment" ;
                    return back()->with('error'."$i",${'e'.$i});
                }
            }
            $st=participant::where([['senrl','LIKE','%'.$enr.'%'],['eid',$request->eid]])->get()->count();
            if($st>0)
            {
                $e="*Player".$i." Already participated";
                return back()->with('error'."$i",${'e'.$i});
            }
        }
        // $enr="";
        // foreach($request->enrl as $e)
        // {
        //     $enr.=$e."-";
        // }
        
        // $participant=new participant;
        // $participant->eid=$request->eid;
        // $participant->senrl=$enr;
        // $participant->class=Session::get('class');
        // $participant->division=Session::get('div');
        // $participant->clgcode=Session::get('clgcode');
        // $participant->rank="p";
        // $participant->reg_date=date("Y:m:d");
        // $participant->save();
        // session()->flash('alert-success', 'insert successfully!');
        // $einfo=tblevent::where('eid',decrypt($eid))->first();
        return view('participate-now-team',['req'=>$request]);
    	// return redirect()->to('/index');
    }   
    public function confirm_team($eid,$enrl)//confirm the team registration
    {
        $participant=new participant;
        $participant->eid=decrypt($eid);
        $participant->senrl=decrypt($enrl);
        $participant->clgcode=Session::get('clgcode');
        $participant->rank="p";
        $participant->reg_date=date("Y:m:d");
        $participant->save();
        session()->flash('alert-success', 'insert successfully!');
    	return redirect()->to('/index');
    }
    public function activity()
    {
        $activity=participant::join('tblevents','tblevents.eid','=','tblparticipant.eid')->where([['senrl','LIKE','%'.Session::get('senrl').'%'],['edate','<',date('Y-m-d')]])->orderby('edate','DESC')->get()->toarray();
        return view('profile',['activity'=>$activity]);
    }

       public function winnerlist()
    {
        $student_name = DB::table('tblstudent')
                ->join('tblparticipant', 'tblstudent.senrl', '=', 'tblparticipant.senrl')
                ->join('tblevents', 'tblparticipant.eid', '=', 'tblevents.eid')
                ->select('tblstudent.*', 'tblparticipant.*', 'tblevents.*')
                ->where('tblparticipant.rank', '!=', 'P')
                ->where('tblstudent.clgcode',Session::get('clgcode'))//session insert of clgcode
                ->orderBy('tblparticipant.eid', 'asc')
                ->orderBy('tblparticipant.rank', 'asc')
                ->get()->toArray();
        $count = DB::table('tblevents')
                ->where('clgcode',Session::get('clgcode'))//session insert of clgcode
                ->get()->count();

        $st=DB::table('tblparticipant')
            ->join('tblevents', 'tblparticipant.eid', '=', 'tblevents.eid')
            ->select('tblparticipant.*','tblevents.*')
            ->where('tblparticipant.rank', '!=', 'P')
            ->where('tblevents.e_type','team')
            ->orderBy('tblparticipant.rank','asc')
            ->get()->toArray();
        $ab=$st;
        $teamdata = collect([]);
        $counts=0;
        $counta = collect([]);
        $rankpos = collect([]);
        $merged = collect([]);
        foreach($st as $s)
        {
            // echo $s->ename;
            // echo $s->rank."-";
            $b=(explode("-",$s->senrl));
            foreach($b as $c)
            {
                $info=DB::table('tblstudent')
                ->where('senrl',$c)->get()->first();
                $rank=DB::table('tblparticipant')
                ->select('rank','eid')
                ->where('eid','3')
                ->where('senrl','like','%'.$c.'%')
                ->get()->first();
                $collection = collect($info);

                $merged->push($collection->merge($rank));

                //$alldata = $info->merge(['yash'=>1]);
                
                echo "<br>";
                // $teamdata->push($info);
                // $rankpos->push($rank);
                // $rankpos2 = collect([$rankpos,$teamdata]);
                // $r=$rankpos2->collapse();
                //print_r($info);
                //echo $info->sname;
                $counts+=1;
                
                // echo "-";
                // echo $info->senrl;
                // echo "<br>";
                
            }
            $counta->push($counts);
            
            $counts=0;
        }
        
        $merge=$merged->toArray();
        //$rankpos2 = array_merge($info);
       // $c = array_combine($teamdata, $b);
        //print_r($r);
        // foreach($rankpos as $c)
        //     {
        //         $y=$rankpos['0']['eid'];
        //         echo $y;
        //     }
            //echo $counta[0];
       return view('winner-list',['stud'=>$student_name,'count'=>$count,"merge"=>$merge]);
                      
    }
    public function action(Request $req)
    {
        if($req->ajax())
        {
            $sname=$req->get('sname');
            $rno=$req->get('rno');
            $clas=$req->get('clas');
            $division=$req->get('division');
            $ename=$req->get('ename');
            $category=$req->get('category');
            if($sname=="")
            {
                $sname='%';
            }
            else
            {
                $sname='%'.$sname.'%';
            }
            if($clas=="")
            {
                $clas='%';
            }
            else
            {
                $clas='%'.$clas.'%';
            }
            if($division=="")
            {
                $division='%';
            }
            else{
                $division='%'.$division.'%';
            }
            if($rno=="")
            {
                $rno='%';
            } 
            else{
                $rno='%'.$rno.'%';
            }
            if($ename=="")
            {
                $ename='%';
            }
            else
            {
                $ename='%'.$ename.'%';
            }
            if($category=="")
            {
                $category='%';
            }
            else
            {
                $category='%'.$category.'%';
            }

                // $dataset=DB::table('tblstudent')
                // ->select('senrl')
                // ->where('sname', 'like',$search)
                // ->get();
                // foreach($dataset as $d)
                // {
                //     $content=$d->senrl;
                // }

            $data=DB::table('tblstudent')
                ->join('tblparticipant', 'tblstudent.senrl', '=', 'tblparticipant.senrl')
                ->join('tblevents', 'tblparticipant.eid', '=', 'tblevents.eid')
                ->select('tblstudent.*', 'tblparticipant.*', 'tblevents.*')
                ->where('tblstudent.sname', 'like',$sname)
                ->where('tblstudent.rno', 'like',$rno)
                ->where('tblstudent.class','like',$clas)
                ->where('tblstudent.division','like',$division)
                ->where('tblevents.category','like',$category)
                ->where('tblevents.ename','like',$ename)
                //->where('tblparticipant.senrl', 'like','%tblstudent.senrl%')
                ->where('tblstudent.clgcode','sbccas')//session insert of clgcode
                ->where('tblparticipant.rank', '!=', 'P')
                ->orderBy('tblstudent.senrl','asc')
                ->get();
            $set="";
            $total_row=$data->count();
            if ($total_row > 0) {
                foreach ($data as $show) {
                    if ($show->rank==1) {
                        $set.="<tr><td><img src='assets/images/svg-icons/student-dash/winner/1.svg' height='22px' alt='1'></td>";
                    } elseif ($show->rank==2) {
                        $set.="<tr><td><img src='assets/images/svg-icons/student-dash/winner/2.svg' height='22px' alt='2'></td>";
                    } elseif ($show->rank==3) {
                        $set.="<tr><td><img src='assets/images/svg-icons/student-dash/winner/3.svg' height='22px' alt='3'></td>";
                    }
                
                    $set.="<td>".$show->sname."</td><td>"
                .$show->class."</td><td>".
                $show->division."</td><td>".
                $show->rno."</td><td>".
                $show->ename."</td><td>".
                $show->category."</td><td>".
                $show->edate."</td></tr>";
                }
            }
            else{
                $set.="<tr><td>No data Found</td></tr>";
            }
            $data=$set;
            echo json_encode($data);
        }
    }
   
}
