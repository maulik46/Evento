<?php

namespace App\Http\Controllers;
date_default_timezone_set("Asia/Kolkata");
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
    public function student_update_action(Request $req,$en){
        $en = decrypt($en);
        $s_mobile=$req->user_mobile;
        $s_email=$req->user_email;
        $s_address=$req->user_address;

        $update=tblstudent::where('senrl',$en)->update(['mobile' =>$s_mobile,'email'=>$s_email,'address'=>$s_address]);
        if($update)
        {
        session()->put('email',$s_email);
        session()->put('mobile',$s_mobile); 
        session()->put('address',$s_address);
        session()->flash('msg','Your profile has been updated!!');
        }

        return redirect(url('/profile')); 
    }
    public function check_event_info($id){
        $id = decrypt($id);
        $einfo = tblevent::where('eid', $id)
        ->join('tblcoordinaters', 'tblevents.cid', '=', 'tblcoordinaters.cid')
        ->join('tblcategory','tblcategory.category_id','tblevents.cate_id')
        ->first();
        return view("check_event_info", ['einfo' => $einfo]);
    }
    public function about_event($pid)
    {
        $pid=decrypt($pid);
        //echo $pid;
        $list_about_event=participant::where('tblparticipant.pid',$pid)
            ->join('tblevents', 'tblparticipant.eid', '=', 'tblevents.eid')
            ->join('tblcoordinaters', 'tblevents.cid', '=', 'tblcoordinaters.cid')
            ->join('tblcolleges', 'tblparticipant.clgcode', '=', 'tblcolleges.clgcode')
            ->get()->first()->toArray();
        //print_r($list_about_event);
        // echo "<br>";
        // print_r($tble);
        // echo "<br>";
        //print_r($tblcollege);
        return view('about_event',['list_event_d'=>$list_about_event]);
    }
    public function logout()//destroy cookies and session
    {
            Session::flush(); 
            \Cookie::queue(\Cookie::forget('clgcode'));
            \Cookie::queue(\Cookie::forget('senrl'));
            return redirect('/login');
    }
    public function getevents()
    {
        $events=tblevent::join('tblcategory','tblcategory.category_id','tblevents.cate_id')->where([['tblevents.clgcode',Session::get('clgcode')],
        ['reg_end_date','>=',date('Y-m-d')],
        ['reg_start_date','<=',date('Y-m-d')]])
        ->where('efor','LIKE','%'.Session::get('class').'%')
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
    public function otp_check(Request $req,$senrl,$clgcode,$check)
    {
        $senrl=decrypt($senrl);
        $check=decrypt($check);
        $clgcode=decrypt($clgcode);

        $check=$this->validate($req,[
            'otp'=>'required|max:6|min:6'
        ],[
            'otp.required' => 'Please Enter Your OTP',
            'otp.max' => 'Enter Valid OTP Number',
            'otp.min' => 'Enter Valid OTP Number',
        ]);
         if($check)
         {
            $otp=$req->otp;
                if (session::get('otps')==$otp) {
                    if ($check==1) {
                        cookie()->queue('clgcode', $clgcode);
                        cookie()->queue('senrl', $senrl);
                    }                 
                    session()->put('senrl',$senrl);
                    session()->put('clgcode', $clgcode);
                    $user_details=tblstudent::where('senrl',$senrl)->where('clgcode',$clgcode)->get()->first();
                    $clg=\DB::table('tblcolleges')->where('clgcode', $clgcode)->first();
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
                    return redirect(url('/index'));
                } else {
                    return back()->with('error','Invalid OTP Number');
                }
         }
    }
    public function otpview($senrl,$clgcode,$check)
    {
        //echo $senrl;
        return view('otp',['senrl'=>$senrl,'clgcode'=>$clgcode,'check'=>$check]);
    }
    public function resend_otp($senrl,$clgcode,$check)
    {
        $senrl=decrypt($senrl);
        $clgcode=decrypt($clgcode);
        $user_details=tblstudent::where('senrl',$senrl)->where('clgcode',$clgcode)->get()->first();
        $clg=\DB::table('tblcolleges')->where('clgcode',$clgcode)->first();
        $rand_num=rand(111111,999999);
        session()->put('otps',$rand_num);
        session()->put('sname',$user_details['sname']);
        session()->put('email',$user_details['email']);
        session()->put('clgname',$clg->clgname);
        $to_name=Session::get('sname');
        $to_email=Session::get('email');
        $data=array('name'=>'OTP :'.$rand_num,'body'=>Session::get('clgname'));
            // \Mail::send('email',$data,function($message) use ($to_name,$to_email){
            //     $message->to($to_email)->replyTo('eventoitsol@gmail.com',$name=null)->from('eventoitsol@gmail.com', $name = 'Evento')
            //     ->subject('Log Authentication');
            // });
        return redirect(url('otpview/'.encrypt($senrl).'/'.encrypt($clgcode).'/'.encrypt($check)));
    }
    public function timers(Request $req)
    {
        if($req->ajax())
        {
            if(Session::forget('otps'))
            {
                $data="success";
                echo json_encode($data);
            }
        }
    }
    public function checklogin(Request $req)//check student data for login other wise return error
    {
        $login_details = tblstudent::join('tblcolleges','tblcolleges.clgcode','tblstudent.clgcode')->where([
            ['tblcolleges.clgcode', '=', $req->clgcode],
            ['senrl', '=', $req->senrl],
            ['status','a']
        ])->count();
        if ($login_details==1) 
        {
            $user_details = tblstudent::where([
                ['clgcode', '=', $req->clgcode],
                ['senrl', '=', $req->senrl]
            ])->first();
            $clg=\DB::table('tblcolleges')->where('clgcode', $req->clgcode)->first();
            $rand_num=rand(111111,999999);
            session()->put('otps',$rand_num);
            $events=$this->getevents();
            session()->put('sname',$user_details['sname']);
            session()->put('email',$user_details['email']);
            session()->put('clgname',$clg->clgname);
            $to_name=Session::get('sname');
            $to_email=Session::get('email');
            $data=array('name'=>'OTP :'.$rand_num,'body'=>Session::get('clgname'));
            // \Mail::send('email',$data,function($message) use ($to_name,$to_email){
            //     $message->to($to_email)->replyTo('eventoitsol@gmail.com',$name=null)->from('eventoitsol@gmail.com', $name = 'Evento')
            //     ->subject('Log Authentication');
            // });
            //echo "email send";
           $remainder = $req->get('remainder') ?? 0;
           if(Session::get('reload')=="")
           {
               session()->put('reload',$user_details['senrl']);
           }
           else
           {
            session()->put('reload2',$user_details['senrl']);
           }
          if(Session::get('reload')==Session::get('reload2'))
          {
            session()->put('change',0);
          }
          else
          {
            session()->put('change',1);
            
          }
        //   echo Session::get('reload')."<br/>";
        //   echo Session::get('reload2')."<br/>";
        //   echo "-".Session::get('change');
          session()->put('reload',Session::get('reload2'));
          session()->forget('reload2');
        return redirect(url('otpview/'.encrypt($req->senrl).'/'.encrypt($req->clgcode).'/'.encrypt($remainder)));
        } 
        else
        {
            return back()->with('error','Invalid College name or Enrollment Number');
        }
    }
    public function explore($cat)//function for explore event
    {
        $cat=decrypt($cat);
        $n=tblevent::where([['clgcode',Session::get('clgcode')],['cate_id',$cat],['reg_end_date','>=',date('Y-m-d')]])->count();
        if($n>0)
        {
            $events=tblevent::where([['clgcode',Session::get('clgcode')],
                                            ['cate_id',$cat],
                                            ['reg_end_date','>=',date('Y-m-d')],
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
    $einfo=tblevent::join('tblcoordinaters','tblevents.cid','=','tblcoordinaters.cid')->where('eid',decrypt($eid))->first();

        return view('participate-now',['einfo'=>$einfo]);
    }
  public function confirm($eid,$maxteam)//function used fron confirm participation
    {
        $team_avl=\DB::table('tblparticipant')->where('eid',decrypt($eid))->count();
        if(decrypt($maxteam)>0)
        {
            if(decrypt($maxteam) > $team_avl)
            {
                $participant=new participant;
                $participant->eid=decrypt($eid);
                $participant->senrl=Session::get('senrl');
                $participant->clgcode=Session::get('clgcode');
                $participant->rank="p";
                $participant->reg_date=date("Y:m:d");
                $participant->save();
                session()->flash('alert-success', 'You have successfully participated..!');
            }
            else{
                session()->flash('alert-danger', 'Maximum team already participated..!');
            }
        }
        else{
            $participant=new participant;
            $participant->eid=decrypt($eid);
            $participant->senrl=Session::get('senrl');
            $participant->clgcode=Session::get('clgcode');
            $participant->rank="p";
            $participant->reg_date=date("Y:m:d");
            $participant->save();
            session()->flash('alert-success', 'You have successfully participated..!');
        }
    	return redirect()->to('/index');
    }
     public function tnamecheck(Request $req){
        $tname = strtoupper($req->tname);
        $eid = $req->eid;
        $tcount=participant::where([['eid',$eid],['tname',$tname]
        ])->count();
            return response()->json(array('msg'=> $tcount),200);
     }
    public function team_ins($eid)//insert team
    {
        $eid=decrypt($eid);
        $einfo = tblevent::where('eid', $eid)
        ->join('tblcoordinaters', 'tblevents.cid', '=', 'tblcoordinaters.cid')
        ->first();
        return view('team-insert',['einfo'=>$einfo]);
    }
   public function teamvalidation(Request $req)
    {
        $enr=$req->enrl;
        $eid=$req->eid;
        $galw=$req->galw;
        $awl_diff_class=$req->alw_diff_class;
        $a_d_d=$req->a_d_d;
        $efor=$req->efor;
            if($galw=="both")
            {
                if($awl_diff_class=="yes")
                {
                    $st=tblstudent::select('class')->where([['clgcode',Session::get('clgcode')],['senrl',$enr]])->first();
                    if(!$st)
                    {
                        $msg="*Invalid Enrollment Id of player";
                        return response()->json(array('msg'=> $msg),200);
                    }
                }
                else
                {
                    if($a_d_d=="yes")
                    {
                        $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['class',Session::get('class')]])->first();
                        if(!$st)
                        {
                            $msg="This player not from ".Session::get('class') . " class or invalid Enrollment" ;
                            return response()->json(array('msg'=> $msg),200);
                        }
                    }
                    else
                    {
                        $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['class',Session::get('class')],['division',Session::get('div')]])->first();
                        if(!$st)
                        {
                            $msg="This player not from ".Session::get('class') ." class or invalid Enrollment  or not from Division ". Session::get('div') ;
                            return response()->json(array('msg'=> $msg),200);
                        }
                        // $efor=tblevent::where([['clgcode',Session::get('clgcode')],['eid',$eid],['efor','LIKE','%'.$st['class'].'%']])->count();
                    }
                }
            }
            else{
                if($awl_diff_class=="yes")
                {
                    $st=tblstudent::select('class')->where([['clgcode',Session::get('clgcode')],['senrl',$enr],['gender',$galw]])->first();
                
                    if(!$st)
                    {
                        $msg="*This player is not ". Session::get('gender')." or invalid enrollment number";
                        // echo $e;
                        return response()->json(array('msg'=> $msg),200);

                    }
                }
                else
                {
                    if($a_d_d=="yes")
                    {
                        $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['gender',$galw],['class',Session::get('class')]])->first();
                
                        if(!$st)
                        {
                            $msg="This player not ".Session::get('gender') . " or not from class ".Session::get('class') . " or invalid Enrollment" ;
                            return response()->json(array('msg'=> $msg),200);
                        }
                    }
                    else
                    {
                        $st=tblstudent::where([['clgcode',Session::get('clgcode')],['senrl',$enr],['gender',$galw],['class',Session::get('class')],['division',Session::get('div')]])->first();
                
                        if(!$st)
                        {
                            $msg="This player not ".Session::get('gender') . " or not from class ".Session::get('class') ." or not from Division ". Session::get('div'). " or invalid Enrollment" ;
                            return response()->json(array('msg'=> $msg),200);
                        }
                    }
                }
            }
        $class=explode('-',$efor);
        if(!in_array($st['class'],$class))
        {
            return response()->json(array('msg'=>'Student of class <b>'.ucfirst($st['class']).'</b> not allowed'),200);
        }
        $st=participant::where([['senrl','LIKE','%'.$enr.'%'],['eid',$eid]])->get()->count();
        if($st>0)
        {
            $msg="*Player"." Already participated";
            return response()->json(array('msg'=> $msg),200);
        }
        $msg="";
        return response()->json(array('msg'=> $msg),200);
    }   
    
    public function team_confirm(Request $req)
    {
        return view('participate-now-team',['req'=>$req]);

    }
    public function confirm_reg($eid,$enrl,$tname)//confirm the team registration
    {
        $eid=decrypt($eid);
        $maxteam=tblevent::select('maxteam')->where('eid',$eid)->first();
        $team_avl=\DB::table('tblparticipant')->where('eid',$eid)->count();
        if($maxteam['maxteam'])
        {
            if($maxteam['maxteam'] > $team_avl)
            {
                $participant=new participant;
                $participant->eid=$eid;
                $participant->senrl=decrypt($enrl);
                $participant->tname=strtoupper($tname);
                $participant->clgcode=Session::get('clgcode');
                $participant->rank="p";
                $participant->reg_date=date("Y:m:d");
                $participant->save();
                session()->flash('alert-success', 'You have successfully participated..!');
                
            }
            else{
                session()->flash('alert-danger', 'Maximum team already participated..!');
           }
        }
        else{
            $participant=new participant;
                $participant->eid=$eid;
                $participant->senrl=decrypt($enrl);
                $participant->tname=strtoupper($tname);
                $participant->clgcode=Session::get('clgcode');
                $participant->rank="p";
                $participant->reg_date=date("Y:m:d");
                $participant->save();
                session()->flash('alert-success', 'You have successfully participated..!');
                
        }
        return redirect()->to('/index');
    }
    public function activity()
    {
        $activity=participant::join('tblevents','tblevents.eid','=','tblparticipant.eid')->where([['senrl','LIKE','%'.Session::get('senrl').'%']])->orderby('edate','DESC')->get()->toarray();
        return view('profile',['activity'=>$activity]);
    }
    // public function part()
    // {
    //     $activity=participant::join('tblevents','tblevents.eid','=','tblparticipant.eid')->where([['senrl','LIKE','%'.Session::get('senrl').'%'],['edate','>',date('Y-m-d')]])->orderby('edate','DESC')->get()->toarray();
    //     print_r($activity);
    // }
    //  public function participatename()
    // {
    //     $st=\DB::table('tblparticipant')->select('senrl')->get()->toarray();
       
    //     $ab=$st;
    //     foreach($st as $s)
    //     {
    //         $b=(explode("-",$s->senrl));
    //         foreach($b as $c)
    //         {
    //             $info=tblstudent::where('senrl',$c)->first();
    //             echo $info['sname'];
    //             echo "---";
    //             echo $info['senrl'];
    //             echo "---";
    //         }
    //     }
    // print_r($st);
    // }
    public function confirm_del($pid)
    {
        $del=participant::where('pid',$pid)->delete();
        if($del>0)
        {
            session()->flash('msg', 'Your participation cancel successfully');
        }
        return back();
    }
    public function view_team($id)
    {
        $id=decrypt($id);
        $team_candidates=participant::select('pid','eid','senrl','tname')->where('pid',$id)->first();
        // return $team_candidates;
        // exit;
        return view('view_winner_team',['tc'=>$team_candidates]);
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
         $team=DB::table('tblparticipant')->select('eid')->groupBy('eid')->get();
        $ddename=DB::table('tblevents')->select('ename')->where('clgcode',Session::get('clgcode'))->groupBy('ename')->get()->toArray();
        $ddcategory=DB::table('tblevents')->select('category')->where('clgcode',Session::get('clgcode'))->groupBy('category')->get()->toArray();
        $ddclass=DB::table('tblstudent')->select('class')->where('clgcode',Session::get('clgcode'))->groupBy('class')->get()->toArray();
        // print_r($ddename);
        // echo "<br>";
        // print_r($ddcategory);
    return view('winner-list',['stud'=>$student_name,'count'=>$count,'team'=>$team,'ddename'=>$ddename,'ddcategory'=>$ddcategory,'ddclass'=>$ddclass]);
                      
    }
    // public function democ(Request $req)
    // {
    //     if($req->ajax())
    //     {
    //         $clas=$req->get('name');
            
    //         $data="<h1>".$clas."</h1>";
    //         echo json_encode($data);
    //     }
    // }
    public function action_division(Request $req)
    {
        if($req->ajax())
        {
            $clas=$req->get('clas');
            $data=DB::table('tblstudent')->select('division')->where('class',$clas)->groupBy('division')->get();  
            $total_row=$data->count();
            $set="<option value=''>Select Division</option>";
            if ($total_row > 0) {
                foreach ($data as $show) {                
                $set.="<option value='$show->division'>$show->division</option>";
                }
            }
            else{
                $set.="";
            }
            $data=$set;
            echo json_encode($data);
        }
    }
     public function filter(Request $req)
    {
        $class=$req->clas;
        $div=$req->div;
        $cat=$req->cat;
        $year=$req->year;
        $sname=$req->sname;
        $ename=$req->ename;
        $clgcode=$req->clgcode;
        $c=0;
        $team="";
        if(!$cat)
        {
            $cat=["team","solo"];
            $c++;
        }
        if(!$div)
        {
            $c++;
            $div=["1","2","3","4"];
        }
        if(!$class)
        {
            $c++;
            $clas=\DB::table('tblstudent')->select('class')->where('clgcode',$clgcode)->groupBy('class')->get()->toArray();
            $class=array();
            foreach($clas as $cls)
            {
            array_push($class,$cls->class);
            }
        }
        if (strlen($sname)<=0) {
            $c++;
            $sname="%%";
        }
        else
        {
            $sname='%'.$sname.'%';
        }
        if (strlen($ename)<=0) {
            $c++;
            $ename="%%";
        }
        else
        {
            $ename='%'.$ename.'%';
            
        }
        if($year=="")
        {
            $c++;
        }
        $a=0;
         $st=participant::join('tblevents', 'tblparticipant.eid', '=', 'tblevents.eid')
                                ->join('tblcategory','tblcategory.category_id','tblevents.cate_id')
                                ->where('tblparticipant.rank', '!=', 'p')
                                ->whereIn('tblevents.e_type',$cat)
                                ->where('tblparticipant.clgcode',$clgcode)
                                
                                ->where('tblevents.ename','like',$ename)
                                ->orderby('tblevents.enddate','desc')
                                ->orderby('tblevents.ename')
                                ->orderby('rank')
                                ->get()->toArray(); 
                                foreach ($st as $s) {
                                    if(date('Y',strtotime($s['enddate']))==$year || $year=="")
                                    {
                                    $enrl=explode("-", $s['senrl']);
                                        foreach ($enrl as $sen) {
                                            $tbls=tblstudent::where('senrl', $sen)
                                            ->where('sname','like',$sname)
                                            ->whereIn('class',$class)
                                            ->where('clgcode',$clgcode)
                                            ->whereIn('division',$div)
                                                ->get()->toArray();
                                                
                                            foreach ($tbls as $t) {    
                                                $a++;
                                                if($a==1)
                                                {
                                                    $team.='<thead class="light-bg2">
                                                    <tr class="text-dark">
                                                        <th scope="col">Rank</th>
                                                        <th scope="col">Roll no</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Class</th>
                                                        <th scope="col">Division</th>
                                                        <th scope="col">Event</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                }
                                                    if($s['rank']=='1')
                                                    {
                                                        $team.= "<tr><td><img src=".asset('assets/images/svg-icons/student-dash/winner/1.svg')." height='22px' alt='1'></td>";
                                                        
                                                    }
                                                    elseif($s['rank']=='2')
                                                    {
                                                        $team.= "<tr><td><img src=".asset('assets/images/svg-icons/student-dash/winner/2.svg')." height='22px' alt='2'></td>";
                                                    }
                                                    elseif($s['rank']=='3')
                                                    {
                                                        $team.= "<tr><td><img src=".asset('assets/images/svg-icons/student-dash/winner/3.svg')." height='22px' alt='3'></td>";
                                                    }
                                                    $team.= "<td> ".ucfirst($t['rno'])."</td><th>".ucfirst($t['sname'])."</th><td>".$t['class']."</td><td>".$t['division']."</td><td>".ucfirst($s['ename'])."</td><td>".ucfirst($s['category_name'])."</td><td>".date('d/m/Y',strtotime($s['enddate']))."</td></tr>";
                                                    
                                            }
                                            if($a>0)
                                            {
                                                $team.="</tbody>";
                                            }
                                        
                                        }
                                    }
                                }     
            $set="";
            
                
                if($team=="")
                {
                    $team="<tr><td colspan='8' class='font-weight-bold text-center text-muted'>No Data Found...!</td></tr>";
                }
                if($c==6)
                {
                    $team="";
                }
            $data=$team;
        return response()->json(array('msg'=>$data),200);
    }
    public function notice()
    {
        $notice=\DB::table('tblnotice')->where([['clgcode',Session::get('clgcode')],['receiver','like','%student%']])->orderby('nid','desc')->get()->toarray();
        return view('notice',['notice'=>$notice]);
    }

     public function rate(Request $req)
    {
        $eid=$req->eid;
        $star=$req->star;
        $exist=\DB::table('tblrates')->where([['eid',$eid],['enrl',Session::get('senrl')]])->count();
        if($exist>0)
        {
            $rate=\DB::table('tblrates')->select('rate')->where([['eid',$eid],['enrl',Session::get('senrl')]])->update(['rate'=>$star]);
        }
        else{
            $rate=\DB::table('tblrates')->insert(['rate'=>$star,'eid'=>$eid,'enrl'=>Session::get('senrl')]);
        }
        return response()->json(array('msg'=>'Thanks for review..'),200);
    }

}
