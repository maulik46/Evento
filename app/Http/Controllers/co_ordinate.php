<?php

namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Http\Request;
use App\tblevent;
use App\tblstudent;
use App\notice;
use App\tblcoordinaters;
use App\participant;
use App\log;
date_default_timezone_set("Asia/Kolkata"); 
class co_ordinate extends Controller
{
    public static function remain_result()
    {
        $evnt=tblevent::select('eid','cid','ename','enddate')->where([['clgcode',Session::get('clgcode')],['enddate','<',date("Y-m-d")]])->get();
        foreach($evnt as $e){
            $rr=participant::where([['eid',$e['eid']],['rank',1]])->count();
            if($rr==0)
            {
                $exist=DB::table('tblresult_delay')->where('eid',$e['eid'])->count();
                if($exist==0)
                {
                    $late_res=DB::table('tblresult_delay')->insert(['eid'=>$e['eid'],'cid'=>$e['cid']]);
                    $co=tblcoordinaters::select('cname')->where('cid',$e['cid'])->first();
                    if(isset($late_res))
                    {
                        (new self)->notice('Result Not Announced','System','System','student-admin','Result for Event <b>'.ucfirst($e['ename']).'</b> not declared  by co-ordinator <b>'.ucfirst($co['cname']).'</b>','');
                    }
                }
            }
        }
    }
    public function mail($to_name,$to_email,$data)
    {
        \Mail::send('email',$data,function($message) use ($to_name, $to_email){
                $message->to($to_email)->replyTo("eventoitsol@gmail.com",$name=null)
                ->from("eventoitsol@gmail.com", $name = "Evento")
                ->subject("Update Reports")->bcc($to_email);
            });
    }
   
   public static function studinfo($enrl)
   {
        $sinfo=tblstudent::where('senrl',$enrl)->first();
        return $sinfo;
   }
   public function notice($topic,$sender,$s_type,$receiver,$message,$fname)
   {
        $notice=new notice;
        $notice->topic=$topic;
        $notice->message=$message;
        $notice->sender=$sender;
        $notice->sender_type=$s_type;
        $notice->receiver=$receiver;
        $notice->ndate=date('Y-m-d');
        $notice->ntime=date('h:i A');//change
        $notice->clgcode=Session::get('clgcode');
        $notice->attechment=$fname;
        $notice->save();
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
             $clg= DB::table('tblcoordinaters')->where([['password', $req->password],['cname',$req->cuser]])
            ->orwhere([['password', $req->password],['email',$req->cuser]])->first();
            $clgname=DB::table('tblcolleges')->select('clgname')->where('clgcode',$clg->clgcode)->first();
            session()->put('cid', $clg->cid);
            session()->put('clgcode', $clg->clgcode);
            session()->put('clgname',$clgname->clgname);
            session()->put('cname',$clg->cname);
            session()->put('email',$clg->email);
            session()->put('cat',$clg->category);
            session()->put('mobile',$clg->mobile);
            session()->put('profilepic',$clg->pro_pic);
            $log=new log();
            $log->uid=Session::get('cid');
            $log->action_on="login";
            $log->action_type="login";
            $log->descr="Login successfully";
            $log->time=time();
            $log->utype="co-ordinator";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            return redirect(url('cindex'));
        } 
        else
        {
            return back()->with('error','Invalid Co-ordinate ID or Password');
        }
    }
    public function logout()//destroy session
    {
            
            $log=new log;
            $log->uid=Session::get('cid');
            $log->action_on="logout";
            $log->action_type="logout";
            $log->descr="Logout successfully";
            $log->time=time();
            $log->utype="co-ordinator";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            Session::flush(); 
            return redirect(url('/clogin'));
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
        $tble=tblevent::where('clgcode',session::get('clgcode'))->where('cid',session::get('cid'))->get()->toArray();
        $tblp=participant::select('tblparticipant.eid',DB::raw('COUNT(tblparticipant.eid) AS count_par'))
        ->join('tblevents','tblevents.eid','=','tblparticipant.eid')
        ->where('tblparticipant.clgcode',session::get('clgcode'))
        ->where('tblevents.cid',session::get('cid'))
        ->where([['tblevents.enddate','>=',date('Y-m-d')]])
        ->groupBy('tblparticipant.eid')->get()->toarray();
        $events=tblevent::where([['clgcode',Session::get('clgcode')]
        ])->orderby('enddate','desc')->get()->toarray();//change
        $ename_string="";
        $part_count="";
        foreach($tblp as $p)
        {
            $ename=tblevent::where('eid',$p['eid'])->first();
            $ename_string.="'".$ename['ename']."'".",";
            $part_count.=$p['count_par'].",";
        }
        return view('co-ordinates/newindex',['events'=>$events,'date_string'=>$date_string,'tble'=>$tble,'ename_string'=>$ename_string,'part_count'=>$part_count]);
    }
    public function view_can($id)
    {
        $id=decrypt($id);
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
            
            // $tblename=tblevent::where('eid',$eid)->get()->first();
            // $tble=tblevent::where('eid',$eid)->delete();
            // $tblp=participant::where('eid',$eid)->delete();
            // if(isset($tble) && isset($tblp))
            // {
            //     $topic=ucfirst($tblename['ename'])." Event has been Cancelled..!";
            //     $message=$reason;
            //     $notice=DB::table('tblnotice')->insert(
            //     ['topic'=>$topic,'message'=>$message,'sender'=>session::get('cname'),'receiver'=>'student-admin','ndate'=>date('Y-m-d'),'ntime'=>now(),'clgcode'=>Session::get('clgcode')]
            // );
            //     if(isset($notice))
            //     {
            //         session()->flash("success","Event Waiting for approval..!");
            //     }
            // }
            $tble=tblevent::where('eid',$eid)->get()->first();
            
            if(isset($tble))
            {
                $message=$reason;
                
                $tblap=DB::table('tblapproval')->insert(
                        ['eid'=>$eid,'reason'=>$message,'status'=>1,'cid'=>session::get('cid')]
                    );
                if(isset($tblap))
                {
                    session()->flash("success","Event Waiting for approval..!");        
                }
            }
            $data="success";
            //return redirect(url("/index"));
            echo json_encode($data);
        }
    }
    public function update_event($eid)
    {
        // echo $eid;
        $eid=decrypt($eid);
        $tble=tblevent::where('eid',$eid)->get()->first()->toArray();
        $tblp=participant::where('eid',$eid)->get()->count();
        if($tblp==0)
        {}
        else
        {
            session()->flash('updatealert','Student are Already Participanted So somes Fields are Disable..!');
        }
       // print_r($tble);
        return view('co-ordinates/updateevent',['e_data'=>$tble,'tblpcount'=>$tblp]);
    }
    public function action_update(Request $req,$eid)
    {
       $eid=decrypt($eid);     

        $req_edate=$req->edate;
            $req_enddate=$req->enddate;
            $req_sdate=$req->sdate;
            $req_ldate=$req->ldate;
            $req_etime=$req->etime;
            $req_ename=$req->ename;
            $req_loc=$req->loc;
            $req_rules=$req->rules;

            $req_etype=$req->etype;
            $req_efor=$req->efor; //for gender
            //$req_class=$req->class; //database name efor
            $req_tsize=$req->tsize;
            $req_alw_dif_class=$req->alw_diff_class;
            $req_alw_dif_div=$req->alw_diff_div;
            $req_mteam=$req->mteam;
            $req_class="";
            if (is_array($req->class)) {
                foreach ($req->class as $cls) {
                    $req_class.=$cls."-";
                }
            }
            else{
                $req_class=$req->class;
            }
            if($req_alw_dif_class=="yes")
            {
                $req_alw_dif_class=="yes";
            }
            else{
                $req_alw_dif_class="no";
            }
            if($req_alw_dif_div=="yes")
            {
                $req_alw_dif_div="yes";
            }
            else{
                $req_alw_dif_div="no";
            }
            $edate=date('Y-m-d',strtotime($req_edate));
            $sdate=date('Y-m-d',strtotime($req_sdate));
            $ldate=date('Y-m-d',strtotime($req_ldate));
            $etime=date('h:i:s',strtotime($req_etime));
            $enddate=date('Y-m-d',strtotime($req_enddate));
            $message="";
            $tble=tblevent::where('eid',$eid)->get()->first();
            if($tble['ename']!=$req_ename)
            {
                $message.="Event Rename <b style='color:blue;'>".ucfirst($tble['ename'])."</b> to <b style='color:blue; '>".ucfirst($req_ename)."</b><br/>\r\n";
            }
            if($req_mteam < $tble['maxteam'])
            {
                session()->flash('validteam','Maximum Team Size is Not Valid');
                return redirect()->back();                
            }
            if($tble['edate']!=$edate)
            {
                $message.="Event Date changed <b style='color:blue; '>".date('d-m-Y',strtotime($tble['edate']))."</b> to <b style='color:blue; '>".$req_edate."</b><br/>\r\n";
            }
            if($tble['time']!=$etime)
            {
                $message.="Event time changed <b style='color:blue;'>".date('h:i A',strtotime($tble['time']))."</b> to <b style='color:blue; '>".date('h:i A',strtotime($etime))."</b><br/>\r\n";
            }
            if($tble['reg_start_date']!=$sdate)
            {
                $message.="Registration starting date changed <b style='color:blue;'>".date('d-m-Y',strtotime($tble['reg_start_date']))."</b> to <b style='color:blue; '>".$req_sdate."</b><br/>\r\n";
            }
            if($tble['reg_end_date']!=$ldate)
            {
                $message.="Registration end date changed <b style='color:blue;'>".date('d-m-Y',strtotime($tble['reg_end_date']))."</b> to <b style='color:blue; '>".$req_ldate."</b><br/>\r\n";
            }
            if($tble['place']!=$req->loc)
            {
                $message.="Event Location changed <b style='color:blue; '>".ucfirst($tble['place'])."</b> to <b style='color:blue; '>".$req_loc."</b><br/>\r\n";
            }
            if($tble['rules']!=$req->rules)
            {
                $message.="Event Rules changed <b style='color:blue;'>".ucfirst($tble['rules'])."</b> to <b style='color:blue; '>".$req_rules."</b><br/>\r\n";
            }
            if($tble['enddate']!=$enddate)
            {
                $message.="Event End Date changed <b style='color:blue;'>".ucfirst($tble['enddate'])."</b> to <b style='color:blue; '>".$req_enddate."</b><br/>";
            }
            if($tble['e_type']!=$req_etype)
            {
                $message.="Event Type changed  <b style='color:blue; '>".ucfirst($tble['e_type'])."</b> to <b style='color:blue; '>".$req_etype."</b><br/>";
                $req_tsize=1;
            }
            if($req_etype=="solo")
            {
                $req_tsize=1;
            }
            if($tble['efor']!=$req_class)
            {
                $message.="Event for classes changed  <b style='color:blue;'>".ucfirst($tble['efor'])."</b> to <b style='color:blue; '>".$req_class."</b><br/>";
            }
            if($tble['tsize']!=$req_tsize)
            {
                $message.="Event team size changed  <b style='color:blue;'>".ucfirst($tble['tsize'])."</b> to <b style='color:blue; '>".$req_tsize."</b><br/>";
            }
            if($tble['maxteam']!=$req_mteam)
            {
                $message.="Event team size changed  <b style='color:blue;'>".ucfirst($tble['maxteam'])."</b> to <b style='color:blue; '>".$req_mteam."</b><br/>";
            }
            if($tble['alw_dif_class']!=$req_alw_dif_class)
            {
                $message.="Event changed for Allow Different class  <b style='color:blue;'>".ucfirst($tble['alw_dif_class'])."</b> to <b style='color:blue; '>".$req_alw_dif_class."</b><br/>";
            }
            if($tble['alw_dif_div']!=$req_alw_dif_div)
            {
                $message.="Event changed for Allow Different division  <b style='color:blue;'>".ucfirst($tble['alw_dif_div'])."</b> to <b style='color:blue; '>".$req_alw_dif_div."</b><br/>";
            }
            if($tble['gallow']!=$req_efor)
            {
                $message.="Event changed for Gender Allow  <b style='color:blue;'>".ucfirst($tble['gallow'])."</b> to <b style='color:blue; '>".$req_efor."</b><br/>";
            }
            
            $update_event=tblevent::where('eid',$eid)
                ->update(['ename' =>$req_ename,'edate' =>$edate,'enddate' =>$enddate,'time' => $etime,'reg_start_date' => $sdate,'reg_end_date' => $ldate,'gallow' =>$req_efor,'efor' =>$req_class,'e_type' =>$req_etype,'tsize' =>$req_tsize,'maxteam' =>$req_mteam,'place' => $req_loc,'alw_dif_class' =>$req_alw_dif_class,'alw_dif_div' =>$req_alw_dif_div,'rules' => $req_rules]);
            $topic="Update of Event ".$req_ename;
            
            if ($message!="") {
                $tblp=participant::where('eid',$eid)->get()->count();
                if ($tblp>0) {
                    $receiver="admin-student";
                }
                else
                {
                    $receiver="admin";
                }
                $notice=DB::table('tblnotice')->insert(
                    ['topic'=>$topic,'message'=>$message,'sender'=>'System','sender_type'=>'System','receiver'=>$receiver,'ndate'=>date('Y-m-d'),'ntime'=>now(),'clgcode'=>Session::get('clgcode')]
                );
            }
            $message.="<br>---<br> With Regards,<br> ".Session::get('cname')." (co-ordinate)<br>".Session::get('clgname');
            if($update_event)
            {
                $ename=tblevent::select('ename')->where('eid',$eid)->get()->first();
                $tbladmin=DB::table('tbladmin')->where('clgcode',Session::get('clgcode'))->get()->toArray();
                foreach($tbladmin as $admin)
                {
                    $data=array('name'=>'Update On '.$ename['ename'].' Event','body'=>"<h3>".$message."</h3>");
                   
                    //$this->mail($admin->name,$admin->email,$data);
                }
                $tblp=participant::select('senrl')->where('eid',$eid)->get()->toArray();
                
                foreach($tblp as $p)
                {
                    
                        $senrl=explode('-', $p['senrl']);
                        //print_r($senrl);
                        foreach ($senrl as $enrl) {
                            if ($enrl) {
                                $tbls=tblstudent::select('sname', 'email')->where('senrl', $enrl)->get()->first();
                                //echo $tbls['sname'],$tbls['email'];
                                $data=array('name'=>'Update On '.$ename['ename'].' Event','body'=>"<h3>".$message."</h3>");
                                //$this->mail($tbls['sname'], trim($tbls['email']), $data);
                            }
                        }
                }
                // $log=new log;
                // $log->cid=Session::get('cid');
                // $log->action_on="event " .$req_ename;
                // $log->action_type="update";
                // $log->time=time();
                // $log->save();
                session()->flash('success','Your Event is Successfully Updated..!');
            }
            return redirect(url('cindex'));
    }
   
    public function create_event(Request $req)
    {
        $edate=date('Y-m-d',strtotime($req->edate));
        $sdate=date('Y-m-d',strtotime($req->sdate));
        $enddate=date('Y-m-d',strtotime($req->enddate));
        $ldate=date('Y-m-d',strtotime($req->ldate));
        $alw_diff_class="no";
        $class="";
        if($req->alw_diff_class==="yes")
        {
            $alw_diff_class="yes";

        }
        $alw_diff_div="no";
        if($req->alw_diff_div==="yes")
        {
            $alw_diff_div="yes";

        }
        foreach($req->class as $cls)
        {
            $class.=$cls."-";
        }
        $tblevent=new tblevent;
        $tblevent->ename=$req->ename;
        $tblevent->category=Session::get('cat');
        $tblevent->edate=$edate;
        $tblevent->enddate=$enddate;
        $tblevent->time=$req->etime;        
        $tblevent->reg_start_date=$sdate;
        $tblevent->reg_end_date=$ldate;
        $tblevent->clgcode=Session::get('clgcode');
        $tblevent->gallow=$req->efor;
        $tblevent->efor=$class;
        $tblevent->e_type=$req->etype;
        $tblevent->tsize=$req->tsize;
        $tblevent->maxteam=$req->mteam;
        $tblevent->place=$req->loc;
        $tblevent->alw_dif_class=$alw_diff_class;
        $tblevent->alw_dif_div=$alw_diff_div;
        $tblevent->rules=$req->rules;
        $tblevent->cid=Session::get('cid');
        $tblevent->save();
        session()->flash('success', 'Event created successfully..!');
        $log=new log;
        $log->uid=Session::get('cid');
        $log->action_on="Event ";
        $log->action_type="insert";
        $log->descr="Event <b>".$req->ename." </b> created";
        $log->time=time();
        $log->utype="co-ordinator";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
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
        $log=new log;
        $log->uid=Session::get('cid');
        $log->action_on="password ";
        $log->action_type="update";
        $log->descr="Update password";
        $log->time=time();
        $log->utype="co-ordinator";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
        session()->flash('success', 'Password updated successfully..!');
        return redirect(url('cindex'));
     }
     public function send_notice(Request $req)
     {
        $topic=$req->title;
        $message=$req->message;
        $filename="";
        $fname="";
        if($file=$req->file('attachment'))
        {
            $req->validate([
                'attachment' => 'max:50',
            ],
        [
            'attachment.max'=>"The file size should be less then 50 Kb"
        ]);
            foreach($file as $att)
            {
                $destinationPath=public_path('attachment/');
                $filename=time().$att->getClientOriginalName();
                $att->move($destinationPath,$filename);
                $fname.=$filename.";";
            }
        }
        $this->notice($topic,Session::get('cname'),'co-ordinator','student',$message,$fname);
        session()->flash('success', 'Notice send successfully');
        $log=new log;
        $log->uid=Session::get('cid');
        $log->action_on="Notice";
        $log->action_type="insert";
        $log->descr="Notice about <b>".$topic."</b>";
        $log->time=time();
        $log->utype="co-ordinator";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
        return redirect(url('cindex'));
     }
     public function view_team($id)
    {
        $id=decrypt($id);
        $team_candidates=participant::select('pid','eid','senrl','tname')->where('pid',$id)->get()->toarray();
        // return $team_candidates;
        // exit;
        return view('co-ordinates/view_team_candidate',['team_candidates'=>$team_candidates]);
    }
    public function create_result($id)
    {
        $id = decrypt($id);

        $candidates=participant::select('pid','senrl','tname')->where('eid',$id)->get()->toarray();
        // $team_candidates=participant::select('pid', 'senrl', 'tname')->where('pid', $id)->get()->toarray();

        $einfo=tblevent::select('eid','ename','e_type','edate','category')->where('eid',$id)->first()->toarray();
        $parameter_array=[
            'candidates'=>$candidates,
            // 'team_candidates'=>$team_candidates,
            'einfo'=>$einfo
        ];
        return view('co-ordinates/create_result',$parameter_array);
    }
     public function rank(Request $req)
    {
        $a=participant::where('pid',$req->r1)->update(['rank'=>'1']);
        $b=participant::where('pid',$req->r2)->update(['rank'=>'2']);
        $c=participant::where('pid',$req->r3)->update(['rank'=>'3']);
        $eid=participant::select('eid')->where('pid',$req->r1)->first();
        session()->flash('success','Result announced successfully..!');
        \DB::table('tblresult_delay')->where('eid',$eid['eid'])->delete();
         $log=new log;
         if($req->utype)
         {
            $log->uid=Session::get('aid');
            $log->utype="admin";
         }
         else{
            $log->uid=Session::get('cid');
            $log->utype="co-ordinator";
         }
        
        $log->action_on="Rank";
        $log->action_type="insert";
        $log->descr="Result announced for event <b>".$req->ename." </b>";
        $log->time=time();
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();

        return response()->json(array('msg'=> $a.$b.$c),200);
    }
    public static function participant($eid)
    {
        $participant=participant::where([['eid',$eid],['rank','p']])->get()->toarray();
        return $participant;
    }
    public function view_result($eid)
    {
        $participant=participant::where([['eid',decrypt($eid)],['rank','p']])->count();
        $event=tblevent::select('eid','ename','edate','e_type')->where('eid',decrypt($eid))->first();
       
        return view('co-ordinates/view_result',['participant'=>$participant],['einfo'=>$event]);
    }
    public function otp_mail($to_name,$to_email,$data)
    {
        \Mail::send('email',$data,function($message) use ($to_name, $to_email){
                $message->to($to_email)->replyTo("eventoitsol@gmail.com",$name=null)
                ->from("eventoitsol@gmail.com", $name = "Evento")
                ->subject("OTP authentication")->bcc($to_email);
            });
    }
    public function send_otp(Request $req)
     {
         if ($req->ajax()) {
             $rand_num=rand(111111, 999999);
             session()->put('otps', $rand_num);
             if($req->get('cuser_resend'))
             {
                $cuser=$req->get('cuser_resend');
                session()->put('email_check',1);
             }
             else
             {
                $cuser=$req->get('cuser');
             }
             $message="<br/>---<br/> Thanks For visiting Evento ";
             $data=array('name'=>'OTP :'.Session::get('otps'),'body'=>$message);
             $tblco=tblcoordinaters::where('email', $cuser)->get()->first();
             if ($tblco) {
                if (Session::get('email_check')==1) {
                    $this->otp_mail($tblco['cname'], $tblco['email'], $data);
                    session()->put('email_check',0);
                }
                 $data=Session::get('otps');
             }
             else{
                 $data="Invalid Email Id..";
             }
            
             echo json_encode($data);
         }
     }
     public function confirm_pass(Request $req)
     {
        return view("co-ordinates/confirm_pass",['email'=>$req->cuser]);
     }
     public function change_pass(Request $req,$email)
     {
        $email=decrypt($email);
        //echo $email;
        $pass=$req->password;
        $cpass=$req->cpassword;
        if($pass==$cpass)
        {
            $tblc=tblcoordinaters::where('email',$email)
            ->update(['password' =>$pass]);
            if($tblc)
            {
                $log=new log;
                $log->uid=Session::get('cid');
                $log->action_on="password ";
                $log->action_type="update";
                $log->descr="Update password";
                $log->time=time();
                $log->utype="co-ordinator";
                $log->ip_add=$_SERVER['REMOTE_ADDR'];
                $log->save();
                session()->flash("success","Your Password Successfully Changed...");
            }
            return redirect(url('/clogin'));
        }
        else
        {
            return redirect()->back();
        }
     }
    public function timers(Request $req)
    {
        if($req->ajax())
        {
            if(Session::get('otps')==$req->get('otpcode'))
            {
                Session::forget('otps');
                $data="";
                echo json_encode($data);
            }
        }
        
    }
     public function updateprofile(Request $req)
    {
        $cname=$req->cname;
        $cid=$req->cid;
        $cemail=$req->cemail;
        $mobile=$req->mobile;
        $rec=tblcoordinaters::where('cid',$cid)->update(['cname'=>$cname,'email'=>$cemail,'mobile'=>$mobile]);
        if($rec>0)
        {
            session()->put('cname',$cname);
            session()->put('email',$cemail);
            session()->put('mobile',$mobile);
            session()->flash('success', 'Profile updated successfully');
            
        }
        return back();
    }
      public function update_propic(Request $req)
    {
        $req->validate([
            'photo-upload' => 'required|mimes:png,jpg,jpeg,svg|max:2000',
            ],
        [
            'photo-upload.max'=>"The file size should be less then 2 Mb",
            'photo-upload.mimes'=>"Only image or svg allowed"
        ]);
        $file=$req->file('photo-upload');
        $destinationPath=public_path('profile_pic/');
        $filename=time().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $pro_pic=$filename;
        $propic=tblcoordinaters::where('cid',Session::get('cid'))->update(['pro_pic'=>$pro_pic]);
        if($propic)
        {
            session()->put('profilepic',$pro_pic);
        }
        return back();
    }
}
