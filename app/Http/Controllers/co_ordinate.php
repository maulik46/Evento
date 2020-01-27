<?php

namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Http\Request;
use App\tblevent;
use App\notice;
use App\tblcoordinaters;
use App\participant;
date_default_timezone_set("Asia/Kolkata"); 
class co_ordinate extends Controller
{
    public function logout()//destroy session
    {
            Session::flush(); 
            return redirect(url('/clogin'));
    }
    public function login()
    {
        return view('co-ordinates/login');
    }
    public function checklogin(Request $req)//check coordinate data for login other wise return error
    {
        $login_details = DB::table('tblcoordinaters')->where([
            ['email', '=', $req->cuser],
            ['password', '=', $req->password]
        ])
        ->orwhere([
            ['cname', '=', $req->cuser],
            ['password', '=', $req->password]
        ])
        ->count();
        if ($login_details==1) 
        {
            $clg= DB::table('tblcoordinaters')->where('password', $req->password)->first();
            session()->put('cid', $clg->cid);
            session()->put('clgcode', $clg->clgcode);
            session()->put('cname',$clg->cname);
            session()->put('email',$clg->email);
            session()->put('cat',$clg->category);
            
            return redirect(url('cindex'));
        } 
        else
        {
            return back()->with('error','Invalid Co-ordinate ID or Password');
        }
    }
    public function index()
    {
        $date_string="";
        $today_date=date("d-m-Y");
        $date_array=array();
        for($i=0;$i<5;$i++)
        {
            $date_v=date("d-m-Y", strtotime("-1 day", strtotime($today_date)));
            $date_array[]=$date_v;
            $date_string.="'".$date_v."'".",";
            $today_date=$date_v;
        }
        $tble=tblevent::where('clgcode',session::get('clgcode'))->get()->toArray();
        $events=tblevent::where([['clgcode',Session::get('clgcode')]
        ])->orderby('edate','desc')->get()->toarray();//change
        return view('co-ordinates/newindex',['events'=>$events,'date_string'=>$date_string,'tble'=>$tble]);
    }
    public function view_can($id)
    {
        $participate=participant::select('senrl','tname')->where('eid',$id)->get()->toarray();
        $einfo=tblevent::select('eid','ename','e_type','edate')->where('eid',$id)->first()->toarray();
        return view('co-ordinates/view_candidates',['participate'=>$participate],['einfo'=>$einfo]);
    }
    public function delete_event(Request $req)
    {
        if($req->ajax())
        {
            $eid=$req->get('id');
            $reason=$req->get('reason');
            
            $tblename=tblevent::where('eid',$eid)->get()->first();;
            $tble=tblevent::where('eid',$eid)->delete();
            $tblp=participant::where('eid',$eid)->delete();
            if(isset($tble) && isset($tblp))
            {
                $topic=ucfirst($tblename['ename'])." Event has been Cancelled..!";
                $message=$reason;
                $notice=DB::table('tblnotice')->insert(
                ['topic'=>$topic,'message'=>$message,'sender'=>session::get('cname'),'receiver'=>'student-admin','ndate'=>date('Y-m-d'),'ntime'=>now(),'clgcode'=>Session::get('clgcode')]
            );
                if(isset($notice))
                {
                    session()->flash("success","Event Deleted Successfully..!");
                }
            }
                $data="success";
            // //return redirect(url("/index"));
            echo json_encode($data);
        }
    }
    public function update_event($eid)
    {
        // echo $eid;
        $eid=decrypt($eid);
        $tble=tblevent::where('eid',$eid)->get()->first()->toArray();
       // print_r($tble);
        return view('co-ordinates/updateevent',['e_data'=>$tble]);
    }
    public function action_update(Request $req,$eid)
    {
        $eid=decrypt($eid);
       // echo $eid;
        $req_edate=$req->edate;
        $req_sdate=$req->sdate;
        $req_ldate=$req->ldate;
        $req_etime=$req->etime;
        $req_ename=$req->ename;
        $req_loc=$req->loc;
        $req_rules=$req->rules;
        $edate=date('Y-m-d',strtotime($req_edate));
        $sdate=date('Y-m-d',strtotime($req_sdate));
        $ldate=date('Y-m-d',strtotime($req_ldate));
        $etime=date('h:i:s',strtotime($req_etime));
        $message="";
        $tble=tblevent::where('eid',$eid)->get()->first();
        if($tble['ename']!=$req_ename)
        {
            $message.="Event Rename <b>".ucfirst($tble['ename'])."</b> to <b>".ucfirst($req_ename)."</b><br/>";
        }
        if($tble['edate']!=$edate)
        {
            $message.="Event Date changed <b>".date('d-m-Y',strtotime($tble['edate']))."</b> to <b>".$req_edate."</b></br>";
        }
        if($tble['time']!=$etime)
        {
            $message.="Event time changed <b>".date('h:i A',strtotime($tble['time']))."</b> to <b>".$etime."</b></br>";
        }
        if($tble['reg_start_date']!=$sdate)
        {
            $message.="Registration starting date changed <b>".date('d-m-Y',strtotime($tble['reg_start_date']))."</b> to <b>".$req_sdate."</b></br>";
        }
        if($tble['reg_end_date']!=$ldate)
        {
            $message.="Registration end date changed <b>".date('d-m-Y',strtotime($tble['reg_end_date']))."</b> to <b>".$req_ldate."</b></br>";
        }
        if($tble['place']!=$req->loc)
        {
            $message.="Event Location changed <b>".ucfirst($tble['place'])."</b> to <b>".$req_loc."</b></br>";
        }
        if($tble['rules']!=$req->rules)
        {
            $message.="Event Rules changed <b>".ucfirst($tble['rules'])."</b> to <b>".$req_rules."</b></br>";
        }
        $update_event=tblevent::where('eid',$eid)
            ->update(['ename' =>$req_ename,'edate' =>$edate,'time' => $etime,'reg_start_date' => $sdate,'reg_end_date' => $ldate,'place' => $req_loc,'rules' => $req_rules]);
        $topic="Update of Event ".$req_ename;
        
        if ($message!="") {
            $notice=DB::table('tblnotice')->insert(
                ['topic'=>$topic,'message'=>$message,'sender'=>session::get('cname'),'receiver'=>'student-admin','ndate'=>date('Y-m-d'),'clgcode'=>Session::get('clgcode')]
            );
        }
        if($update_event)
        {
            session()->flash('success','Your Event is Successfully Updated..!');
        }
        return redirect(url('cindex'));
    }
    public function create_event(Request $req)
    {
        $edate=date('Y-m-d',strtotime($req->edate));
        $sdate=date('Y-m-d',strtotime($req->sdate));
        $ldate=date('Y-m-d',strtotime($req->ldate));
        $alw_diff_class="no";
        if($req->alw_diff_class==="yes")
        {
            $alw_diff_class="yes";

        }
        $alw_diff_div="no";
        if($req->alw_diff_div==="yes")
        {
            $alw_diff_div="yes";

        }
        $tblevent=new tblevent;
        $tblevent->ename=$req->ename;
        $tblevent->category=Session::get('cat');
        $tblevent->edate=$edate;
        $tblevent->time=$req->etime;        
        $tblevent->reg_start_date=$sdate;
        $tblevent->reg_end_date=$ldate;
        $tblevent->clgcode=Session::get('clgcode');
        $tblevent->gallow=$req->efor;
        $tblevent->e_type=$req->etype;
        $tblevent->tsize=$req->tsize;
        $tblevent->place=$req->loc;
        $tblevent->alw_dif_class=$alw_diff_class;
        $tblevent->alw_dif_div=$alw_diff_div;
        $tblevent->rules=$req->rules;
        $tblevent->cid=Session::get('cid');
        $tblevent->save();
        session()->flash('success', 'Event created successfully..!');
        return redirect(url('cindex'));
    }
    public function err(Request $req){
        $ename = $req->ename;
        $gen=$req->gen;
        $events=tblevent::where([['clgcode',Session::get('clgcode')],['ename',$ename],['gallow',$gen]
        ])->count();
            return response()->json(array('msg'=> $events),200);
     }
     public function last_noti(Request $req)
     {
         $las_notice=$req->lastnote;
         \DB::table('tblcoordinaters')->where('cid',Session::get('cid'))->update(['last_noti'=>$las_notice]);
         return response()->json(array('msg'=> $las_notice),200);
     }
     public function event_info($id)
     {      $id=decrypt($id);
            $einfo=tblevent::where('eid',$id)->first();
            return view("co-ordinates/event_info",['einfo'=>$einfo]);
     }
    //  public function event_result($id)
    //  {     
        
    //     $participate=participant::select('senrl','tname')->where('eid',$id)->get()->toarray();
    //     $eresult=tblevent::select('eid','ename','e_type','edate')->where('eid',$id)->first()->toarray();
    //     return view('co-ordinates/view_result',['participate'=>$participate],['einfo'=>$eresult]);
        
        
    //  }
     public function update_pass(Request $req)
     {
        $c=tblcoordinaters::where([['cid',Session::get('cid')],['password',$req->current_pass]])->count();
        if($c==1)
        {
            if($req->npass == $req->cpass)
            {
                tblcoordinaters::where('cid',Session::get('cid'))->update(['password'=>$req->npass]);
            }
            else{
                session()->flash('error', 'Newpassword and confirm password not match');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('error', 'Invalid password');
            return redirect()->back();
            
        }
        session()->flash('success', 'Password updated successfully..!');
        return redirect(url('cindex'));
     }
     public function send_notice(Request $req)
     {
        $topic=$req->title;
        $message=$req->message;
        $receiver=$req->receiver;
        $filename="";
        if($file=$req->file('attachment'))
        {
            $req->validate([
                'attachment' => 'max:50',
            ],
        [
            'attachment.max'=>"The file size should be less then 50 Kb"
        ]);
            $destinationPath=public_path('attachment/');
            $filename=$file->getClientOriginalName().time();
            $file->move($destinationPath,$filename);
        }
        $notice=new notice;
        $notice->topic=$topic;
        $notice->message=$message;
        $notice->sender=Session::get('cname');
        $notice->receiver="student";
        $notice->ndate=date('Y-m-d');
        $notice->clgcode=Session::get('clgcode');
        $notice->attechment=$filename;
        $notice->save();
        session()->flash('success', 'Notice send successfully..!');
        return redirect(url('cindex'));
     }
}

