<?php

namespace App\Http\Controllers;
date_default_timezone_set("Asia/Kolkata"); 
use Illuminate\Http\Request;
use validator;
use DB;
use App\tblevent;
use App\notice;
use App\tblstudent;
use App\tblcoordinaters;
use App\participant;
use App\log;
use App\admin;
use Cookie;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStudent;
class s_admin extends Controller
{
    public function checklogin(Request $req)
    {
        $login_details = admin::join('tblcolleges','tblcolleges.clgcode','tbladmin.clgcode')->where([
            ['email', '=', $req->auser],
            ['pass', '=', $req->password],
            ['status','a']
        ])
        ->count();
        if ($login_details==1) 
        {
            $admin=admin::where([['pass', $req->password],['email',$req->auser]])->first();
           $clgname=\DB::table('tblcolleges')->select('clgname')->where('clgcode',$admin['clgcode'])->first();
            session()->put('aid', $admin['aid']);
            session()->put('aclgcode', $admin['clgcode']);
            session()->put('aclgname',$clgname->clgname);
            session()->put('aname',$admin['name']);
            session()->put('aemail',$admin['email']);  
            session()->put('adminprofile',$admin['profilepic']);  
            session()->put('amobile',$admin['mobile']);
            $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="login";
            $log->action_type="login";
            $log->descr="Successfully login";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            // print_r(session()->all());
            return redirect(url('sindex'));
        } 
        else
        {
            return back()->with('error','Invalid email address or Password');
        }
    }
    public function logout()
    {
       $log=new log;
        $log->uid=Session::get('aid');
        $log->action_on="logout";
        $log->action_type="logout";
        $log->time=time();
        $log->descr="logout Successfully";
        $log->utype="admin";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
        Session::flush(); 
        return redirect(url('/slogin'));
    }
    public function sindex()
    {
        $events=tblevent::where([['clgcode',Session::get('aclgcode')]
            ])->orderby('edate','desc')->get()->toarray();
        $cod=tblcoordinaters::join('tblcategory','tblcategory.category_id','tblcoordinaters.cate_id')->where('tblcoordinaters.clgcode',Session::get('aclgcode'))->where('tblcoordinaters.status','a')->get();
        $tblp=participant::select('tblparticipant.eid',DB::raw('COUNT(tblparticipant.eid) AS count_par'))
        ->join('tblevents','tblevents.eid','=','tblparticipant.eid')
        ->where('tblparticipant.clgcode',Session::get('aclgcode'))
        ->where([['tblevents.enddate','>=',date('Y-m-d')]])
        ->groupBy('tblparticipant.eid')->get()->toarray();
        
        $ename_string="";
        $part_count="";
        foreach($tblp as $p)
        {
            $ename=tblevent::where('eid',$p['eid'])->first();
            $ename_string.="'".$ename['ename']."'".",";
            $part_count.=$p['count_par'].",";
        }
        $class=tblstudent::select('class')->where('clgcode',Session::get('aclgcode'))->groupBy('class')->get()->toArray();
        $div=tblstudent::select('division')->where('clgcode',Session::get('aclgcode'))->groupBy('division')->get()->toArray();
        // print_r($class);
        // print_r($div);
        // $stud=tblstudent::join('tblparticipant', function($join) {
        //     $join->on('tblparticipant.senrl','LIKE',DB::raw("CONCAT('%',tblstudent.senrl,'%')"));
        // })->join('tblevents','tblevents.eid','=','tblparticipant.eid')
        // ->where([['tblevents.enddate','>=',date('Y-m-d')]])
        // ->where('tblstudent.class',"fybca")
        // ->where('tblstudent.division',"1")
        // ->get()->count();
        // // echo $stud;
        return view('super-admin/index',['events'=>$events,'cods'=>$cod,'ename_string'=>$ename_string,'part_count'=>$part_count,'class'=>$class,'div'=>$div]);
    }
     public function send_notice(Request $req)
    {
       $topic=$req->title;
       $message=$req->message;
       $filename="";
       $fname="";
       $receiver=$req->nfor;
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
        $cod=app('App\Http\Controllers\co_ordinate')->notice($topic,Session::get('aname'),'Admin',$receiver,$message,$fname);
        session()->flash('success', 'Notice send successfully');
       $log=new log;
       $log->uid=Session::get('aid');
       $log->action_on="Notice";
       $log->action_type="insert";
       $log->time=time();
       $log->descr="Notice send to the <b>". $receiver."</b> about the <b>".ucfirst($topic)."</b>";
       $log->utype="admin";
       $log->ip_add=$_SERVER['REMOTE_ADDR'];
       $log->save();
       return redirect(url('sindex'));
    }
    public function update_pass(Request $req)
    {
       $c=admin::where([['aid',Session::get('aid')],['pass',$req->current_pass]])->count();
       if($c==1)
       {
           if($req->npass == $req->cpass)
           {
               admin::where('aid',Session::get('aid'))->update(['pass'=>$req->npass]);
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
       $log->uid=Session::get('aid');
       $log->action_on="password ";
       $log->action_type="update";
       $log->descr="Password updated";
       $log->time=time();
       $log->utype="admin";
       $log->ip_add=$_SERVER['REMOTE_ADDR'];
       $log->save();
       session()->flash('success', 'Password updated successfully..!');
       return redirect(url('sindex'));
    }
    public function last_noti(Request $req)
    {
        $las_notice=$req->lastnote;
        admin::where('aid',Session::get('aid'))->update(['last_noti'=>$las_notice]);
        return response()->json(array('msg'=> $las_notice),200);
    }
    public function approval()
    {
        $apl=tblevent::join('tblapproval','tblapproval.eid','=','tblevents.eid')
        ->join('tblcoordinaters','tblcoordinaters.cid','=','tblapproval.cid')->where('tblevents.clgcode',Session::get('aclgcode'))->get()->toarray();
        return view('super-admin/approval',['delevnt'=>$apl]);
    }
    public function con_del($eid,$y)
    {
        $e_id=decrypt($eid);
        
        if($y=="del")
        {
            $msg_info=tblevent::join('tblapproval','tblapproval.eid','tblevents.eid')->where('tblevents.eid',$e_id)->first();
            $message="Event Name    <b>:".ucfirst($msg_info['ename'])."</b><br>Reason       <b>:".ucfirst($msg_info['reason'])."</b>";
            
            
            $notice=app('App\Http\Controllers\co_ordinate')->notice('Event Canceled','System','System','student-coordinator',$message,"");
            
            $tblp=participant::select('senrl')->where('eid',$e_id)->get()->toArray();
                
                foreach($tblp as $p)
                {
                    
                        $senrl=explode('-', $p['senrl']);

                        foreach ($senrl as $enrl) {
                            if ($enrl) {
                                
                                $tbls=tblstudent::select('sname', 'email')->where('senrl', $enrl)->get()->first();
                                $data=array('name'=>'Cancel Event','edate'=>$msg_info['edate'],'ename'=>$msg_info['ename'],'reason'=>$msg_info['reason'],'reciever'=>$tbls['sname']);
                                $this->mail($tbls['sname'], trim($tbls['email']), $data);
                            }
                        }
                }
            $events=tblevent::where('eid', $e_id)->delete();
            $del_part=participant::where('eid',$e_id)->delete();
            $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="Event delete request";
            $log->action_type="Delete";
            $log->descr="Event <b>".ucfirst($msg_info['ename'])." deleted .</b>";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
        }
        $del_event=\DB::table('tblapproval')->where('eid',$e_id)->delete();
        return back();
    }
     public function mail($to_name,$to_email,$data)
    {
        \Mail::send('del_email',$data,function($message) use ($to_name, $to_email){
                $message->to($to_email)->replyTo("eventoitsol@gmail.com",$name=null)
                ->from("eventoitsol@gmail.com", $name = "Evento")
                ->subject("Event cancelled")->bcc($to_email);
            });
    }
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        Excel::import(new ImportStudent, request()->file('import_file'));
        $log=new log;
        $log->uid=Session::get('aid');
        $log->action_on="Student";
        $log->action_type="Insert";
        $log->descr="Add student using Excelsheet ";
        $log->time=time();
        $log->utype="admin";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
        return back()->with('success', 'Student record inserted successfully.');
    }
     public function checkenrl(Request $req)
    {
        $enrl=$req->enrl;
        if($req->oenrl)
        {
            $c=tblstudent::where([['senrl','!=',$req->oenrl],['senrl',$enrl]])->count();
        }
        else{
            $c=tblstudent::where('senrl',$enrl)->count();
        }
        if($c>0)
        {
            return response()->json(array('msg'=> "This Enrollment number already available"),200);
        }
        return response()->json(array('msg'=> ""),200);
    }
    public function checkemail(Request $req)
    {
        $email=$req->email;
        if($req->enrl)
        {
            $c=tblstudent::where([['senrl','!=',$req->enrl],['email',$email]])->count();
        }
        else{
            $c=tblstudent::where('email',$email)->count();
        }
        if($c>0)
        {
            return response()->json(array('msg'=> "This email addess already taken"),200);
        }
        return response()->json(array('msg'=> ""),200);
    }
    public function checkmobile(Request $req)
    {
        $mobile=$req->mobile;
        if($req->enrl)
        {
            $c=tblstudent::where([['senrl','!=',$req->enrl],['mobile',$mobile]])->count();
        }
        else{
            $c=tblstudent::where('mobile',$mobile)->count();
        }
        if($c>0)
        {
            return response()->json(array('msg'=> "This Mobile number already taken"),200);
        }
        return response()->json(array('msg'=> ""),200);
    }
    public function checkrno(Request $req)
    {
        $rno=$req->rno;
        $clas=$req->clas;
        if($req->enrl)
        {
            $c=tblstudent::where([['senrl','!=',$req->enrl],['rno',$rno],['class',$clas]])->count();
        }
        else{
            $c=tblstudent::where([['rno',$rno],['class',$clas]])->count();
        }
        if($c>0)
        {
            return response()->json(array('msg'=> "This roll no already available for this class"),200);
        }
        return response()->json(array('msg'=> ""),200);
    }
    public function studinsrt(Request $req)
    {
        $stud=new tblstudent;
        $stud->senrl=$req->enrl;
        $stud->sname=$req->name;
        $stud->rno=$req->rno;
        $stud->clgcode=Session::get('aclgcode');
        $stud->dob=date('Y-m-d',strtotime($req->dob));
        $stud->class=$req->clas;
        $stud->division=$req->div;
        $stud->email=$req->email;
        $stud->mobile=$req->mobile;
        $stud->address=$req->add;
        $stud->gender=$req->gen;
        $stud->save();
       $log=new log;
        $log->uid=Session::get('aid');
        $log->action_on="Student";
        $log->action_type="Insert";
        $log->descr="Student <b>".$req->enrl. "</b>added by form";
        $log->time=time();
        $log->utype="admin";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
        return back()->with('success', 'Student record inserted successfully.');
    }
    public function view_students()
    {
        // Session::get('aclgname')
        
        $stud = tblstudent::where('clgcode',Session::get('aclgcode'))->get();
        // return $stud;
        // exit;
        $alldata = ['stud' => $stud];
        return view('super-admin/view_students', $alldata);

    }
    public function update_stud($en){
        $en = decrypt($en);
        $table = tblstudent::where('senrl', $en)->get()->first();
        return view('super-admin/update_student', ['stud_data' => $table]);

    }
    public function action_update_stud(Request $req,$en){
        $en = decrypt($en);        
        $senrl=$req->s_enrl;
        $sname=$req->s_name;
        $rno=$req->s_rollno;
        $dob=$req->s_dob;
        $class=$req->s_class;
        $division=$req->s_division;
        $email=$req->s_email;
        $mobile=$req->s_contact;
        $address=$req->s_address;
        $gender=$req->s_gender;

        $update = tblstudent::where('senrl', $en)->update(['sname' => $sname, 'rno' => $rno,'dob' => $dob,'class' => $class,'division' => $division,'email' => $email,'mobile' => $mobile,'address' => $address,'gender' => $gender]);
        if ($update) {
             $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="Student";
            $log->action_type="update";
            $log->descr="Student record enrollment no <b>".$req->s_enrl."</b> updated";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            session()->flash('msg', 'Record has been updated!!');
        }

        return redirect(url('/view_students'));

    }
     public function filterlog(Request $req)
    {
        $cid=$req->cid;
        $sdate=$req->sdate;
        $ldate=$req->ldate;
        if($cid=="all")
        {
            $cid='%%';
        }
        if($ldate=="")
        {
            $ldate=time();
        }
        else{
            $ldate=strtotime("+1 day", strtotime($ldate));
        }
        if($sdate=="")
        {
            $sdate=0;
        }
        else{
            $sdate=strtotime($sdate);
        }
        $logs=log::join('tblcoordinaters','tblcoordinaters.cid','tbllog.uid')
        ->where([['tblcoordinaters.clgcode',Session::get('aclgcode')],
        ['tbllog.utype','co-ordinator'],
        ['tblcoordinaters.cid','LIKE',$cid],
        ['tbllog.time','>=',$sdate],['tbllog.time','<=',$ldate]])->orderby('time','desc')->paginate(10);
        $msg="";
        $a=0;
        foreach($logs as $log){
            $a=1;
        $msg.='<div class="card mb-0 mt-3 new-shadow-sm">
            <div class="card-body py-2">
                <div class="row justify-content-between mx-0">
                    <div>
                    <span class="badge badge-info px-3 badge-pill  my-1">'.date('d-m-Y',$log['time']).'</span>
                    <span class="badge badge-danger px-3 badge-pill  my-1">'.date('h:m:s A',$log['time']).'</span>
                    <span class="badge badge-soft-primary px-3 badge-pill  my-1">By '.ucfirst($log['cname']).'</span>
                    </div>
                    <div id="action" class="row justify-content-between mx-0">
                        <div class="mr-1">
                            <span class="badge badge-dark px-3 rounded-0  my-1" style="margin-right:-5px;">Action on</span>
                            <span class="badge badge-soft-dark px-3 rounded-0">'.ucfirst($log['action_on']).'</span>
                        </div>
                        <div class="ml-1">
                            <span class="badge badge-dark px-3 rounded-0  my-1" style="margin-right:-5px;">Action</span>
                            <span class="badge badge-soft-dark px-3 rounded-0">'.ucfirst($log['action_type']).'</span>
                        </div>
                    </div>
                </div>
                <div class="card-text">
                    
                <span class="text-muted more">'. $log['descr'] .'</span>
                    <div class="float-right">
                        <span class="font-weight-bold">IP</span>
                        <span class="badge badge-soft-dark badge-pill px-2">'.$log['ip_add'].'</span>
                    </div>
                </div>
            </div>
            
        </div>';
        }
        if($a==0)
        {
            $msg.='<div class="text-center mt-5 font-weight-bold">No logs available!!</div>';
        }
        

        return response()->json(array('msg'=>$msg),200);
    }
    public function otp_mail($to_name,$to_email,$data)
    {
        \Mail::send('email',$data,function($message) use ($to_name, $to_email){
                $message->to($to_email)->replyTo("eventoitsol@gmail.com",$name=null)
                ->from("eventoitsol@gmail.com", $name = "Evento")
                ->subject("OTP Athentication")->bcc($to_email);
            });
    }
    public function send_otp(Request $req)
     {
         if ($req->ajax()) {
             $rand_num=rand(111111, 999999);
             if($req->get('cuser_resend'))
             {
                $cuser=$req->get('cuser_resend');
                session()->put('email_check',1);
             }
             else
             {
                $cuser=$req->get('cuser');
             }
             session()->put('otps', $rand_num);
             $message="<br/>---<br/> Thanks For visiting Evento ";
             $data=array('name'=>'OTP :'.Session::get('otps'),'body'=>$message);
             $tbla=admin::where('email', $cuser)->get()->first();
             if ($tbla) {
                 if (Session::get('email_check')==1) {
                    //  $this->otp_mail($tbla['name'], $tbla['email'], $data);
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
        return view("super-admin/confirm_pass",['email'=>$req->cuser]);
     }
     public function change_pass(Request $req,$email)
     {
        $email=decrypt($email);
        //echo $email;
        $pass=$req->password;
        $cpass=$req->cpassword;
        if($pass==$cpass)
        {
            $tblc=admin::where('email',$email)
            ->update(['pass' =>$pass]);
            if($tblc)
            {
                 $log=new log;
                $log->uid=Session::get('aid');
                $log->action_on="Password";
                $log->action_type="update";
                $log->descr="Passsword updated";
                $log->time=time();
                $log->utype="admin";
                $log->ip_add=$_SERVER['REMOTE_ADDR'];
                $log->save();
                session()->flash("success","Your Password Successfully Changed...");
            }
            return redirect(url('/slogin'));
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
    public function new_cod_add(Request $req)
    {
        if (isset($req->avatar)) {
            $avatar=$req->avatar;
        }
        else
        {
            $file=$req->file('photo-upload');
            $destinationPath=public_path('profile_pic/');
            $filename=time().$file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $avatar=$filename;
        }
        $tblc=tblcoordinaters::insert(['clgcode'=>Session::get('aclgcode'),'cname'=>strtolower($req->cname),'email'=>$req->email,'mobile'=>$req->cno,'status'=>'a',
        'password'=>$req->pass,'cate_id'=>strtolower($req->category),'pro_pic'=>$avatar] );
        if($tblc)
        {
            //echo "new co create";
            $to_name=strtoupper($req->cname);
            $to_email=$req->email;
            $message=" <table border=1 style='padding:10px'> <tr style='background-color:#e6e6e6'><td style='padding:5px'> User Name </td><td style='padding:5px'> Password </td></tr>  <tr><td style='padding:5px'>".$req->email."</td> <td style='padding:5px'>".$req->pass."</td></tr>    </table> ";
            $data=array('name'=>'Welcome to Evento ','body'=>$message);
            // \Mail::send('email',$data,function($message) use ($to_name, $to_email){
            //     $message->to($to_email)->replyTo("eventoitsol@gmail.com",$name=null)
            //     ->from("eventoitsol@gmail.com", $name = "Evento")
            //     ->subject("Co-ordinaters login")->bcc($to_email);
            // });
            $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="co-ordinator";
            $log->action_type="Insert";
            $log->descr="New co-ordinatore<b> ".$req->cname."</b> added";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            session()->flash('success','New Co-ordinater Created...!');
        }
        return redirect(url('/sindex'));
       
    }
    public function err(Request $req){
        $email = $req->email;
        $cno=$req->cno;
        $email_check=tblcoordinaters::where([['clgcode',Session::get('aclgcode')],['email',$email],['status','a']
        ])->count();
        $cno_check=tblcoordinaters::where([['clgcode',Session::get('aclgcode')],['mobile',$cno],['status','a']
        ])->count();
            return response()->json(array('email'=> $email_check,'phoneno'=> $cno_check),200);
     }
    public function updateprofile(Request $req)
    {
        $aname=$req->aname;
        $aid=$req->aid;
        $aemail=$req->aemail;
        $mobile=$req->mobile;
        $rec=admin::where('aid',$aid)->update(['name'=>$aname,'email'=>$aemail,'mobile'=>$mobile]);
        if($rec>0)
        {
            session()->put('aname',$aname);
            session()->put('email',$aemail);
            session()->put('mobile',$mobile);
            $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="Profile";
            $log->action_type="Update";
            $log->descr="Profile updated";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            session()->flash('success', 'Profile updated successfully');
        }
        return back();
    }
   public function event_info($id)
     {      $eid=decrypt($id);
        $einfo=tblevent::select('tblevents.*','tblcoordinaters.cname','tblcategory.category_name')->join('tblcoordinaters','tblcoordinaters.cid','tblevents.cid')->join('tblcategory','tblevents.cate_id','tblcategory.category_id')->where([['tblevents.eid',$eid],['tblevents.clgcode',Session::get('aclgcode')]])->first();
            return view("super-admin/event_info",['einfo'=>$einfo]);
     }
     public function view_result($eid)
     {
         $participant=participant::where([['eid',decrypt($eid)],['rank','p']])->count();
         $event=tblevent::select('eid','e_type','ename','edate','enddate')->where('eid',decrypt($eid))->first();
         return view('super-admin/view_result',['participant'=>$participant],['einfo'=>$event]);
     }
     public function view_can($id)
    {
        $id=decrypt($id);
        $participate=participant::select('senrl','tname')->where('eid',$id)->get()->toarray();
        $einfo=tblevent::select('eid','ename','e_type','edate')->where('eid',$id)->first()->toarray();
        return view('super-admin/view_candidates',['participate'=>$participate],['einfo'=>$einfo]);
    }
    public function view_team($id)
    {
        $id=decrypt($id);
        $team_candidates=participant::select('pid','eid','senrl','tname')->where('pid',$id)->first();
        // return $team_candidates;
        // exit;
        return view('super-admin/view_team_candidates',['tc'=>$team_candidates]);
    }
    public function stud_del($enrl)
    {
        $std=tblstudent::where('senrl',$enrl)->delete();
        if($std>0)
        {
             $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="Student";
            $log->action_type="Delete";
            $log->descr="Student <b>".$enrl."</b>";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            session()->flash('msg', 'Student deleted successfully');
        }
        return back();
    }
     public function delay_res($eid)
    {
        $eid=decrypt($eid);
        $candidates=participant::select('pid','senrl','tname')->where('eid',$eid)->get()->toarray();
        // $team_candidates=participant::select('pid', 'senrl', 'tname')->where('pid', $id)->get()->toarray();

        $einfo=tblevent::select('eid','ename','e_type','edate','tblcategory.category_name')->join('tblcategory','tblevents.cate_id','tblcategory.category_id')->where('eid',$eid)->first()->toarray();
        // $parameter_array=[
        //     'candidates'=>$candidates,
        //     // 'team_candidates'=>$team_candidates,
        //     'einfo'=>$einfo
        // ];
        return view('super-admin/delay_result',['candidates'=>$candidates,'einfo'=>$einfo]);
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
        $destinationPath=public_path('profile_pic/admin_pro_pic');
        $filename=time().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $pro_pic=$filename;
        $propic=admin::where('aid',Session::get('aid'))->update(['profilepic'=>$pro_pic]);
        if($propic)
        {
            $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="Profile photo";
            $log->action_type="Update";
            $log->descr="Profile photo updated to <b>".$file->getClientOriginalName()."</b>";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            session()->put('adminprofile',$pro_pic);
        }
        return back();
    }
    public function cod_del($cid)
    {
        $co=tblevent::where('cid',$cid)->count();
        if($co>0)
        {
            $updco=\DB::table('tblcoordinaters')->where('cid',$cid)->update(['status'=>'i']);
            session()->flash('success', 'Co-ordinater deleted successfully');
        }
        else{
            $tblc=tblcoordinaters::where('cid',$cid)->delete();
            if ($tblc) {
                $tble=tblevent::select('eid')->where('cid', $cid)->get();
                //print_r($tble);
                tblevent::select('eid')->where('cid', $cid)->delete();
                foreach($tble as $e)
                {
                    $tblp=participant::where('eid',$e['eid'])->delete();
                }
                session()->flash('success', 'Co-ordinater deleted successfully');
            }    
        } 
        return back();
    }
    public function event_reports()
    {
        $event_data=tblevent::join('tblcoordinaters','tblevents.cid','=','tblcoordinaters.cid')->join('tblcategory','tblcategory.category_id','tblcoordinaters.cate_id')->get();
        
        return view('super-admin/event_reports',['event_data'=>$event_data]);
    }
    public function event_filter(Request $req)
    {
        $cod=$req->cod;
        $from=$req->from;
        $to=$req->to;
        $gen=$req->gen;
        $etype=$req->etype;
        $cat=$req->cat;
        $ename=$req->ename;
        
        if(!$gen){
            $gen=['female','male'];
        }
        if(!$cat)
        {
            $cate=\DB::table('tblcategory')->where('clgcode',Session::get('aclgcode'))->get();
            $cat=array();
            foreach($cate as $ca)
            {
            array_push($cat,$ca->category_id);
            }
        }
        if(!$etype)
        {
            $etype=['solo','team'];
        }
        if(!$to)
        {
            $to=date('Y-m-d',time());
        }
        else{
            $to=date('Y-m-d',strtotime($to));
        }
        if($from=="")
        {
            $from=0;
        }
        else{
            $from=strtotime($from);
        }
        $rec=tblevent::join('tblcoordinaters','tblcoordinaters.cid','tblevents.cid')
        ->join('tblcategory','tblcategory.category_id','tblcoordinaters.cate_id')
        ->where('tblevents.ename','like','%'.$ename.'%')
        ->where('tblcoordinaters.cid','like','%'.$cod.'%')
        ->whereIn('tblcategory.category_id',$cat)
        ->whereIn('tblevents.gallow',$gen)
        ->whereIn('tblevents.e_type',$etype)
        ->where('tblevents.clgcode',Session::get('aclgcode'))
        ->where('edate','>=',date('Y-m-d',$from))
        ->where('edate','<=',$to)
        ->get();
        $msg="";
        $a=0;
        foreach($rec as $ed)
        {
            $a++;
            $msg.='<tr class="text-dark">
                <td>'.$a.'</td>
                <td>'.ucfirst($ed["ename"]).'</td>
                <td>'.date('d-m-Y',strtotime($ed["edate"])).'</td>
                <td>'.ucfirst($ed["cname"]).'</td>
                <td>'.ucfirst($ed["e_type"]).' Event</td>
                <td>'.ucfirst($ed["category_name"]).'</td>
                <td class="d-flex">
                <a href='.url("sevent_info").'/'.encrypt($ed["eid"]).'
                    class="btn p-1 btn-rounded" data-toggle="tooltip"
                    data-placement="top" title="About">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info  text-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                </a>
                <a href='.url("sview_candidates").'/'.encrypt($ed["eid"]).'
                    class="btn p-1 btn-rounded" data-toggle="tooltip"
                    data-placement="top" title="Candidates">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users  text-primary"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </a>';
                $r = \DB::table('tblparticipant')->select('senrl')->where([['eid', $ed['eid']], ['rank', 1]])->count();
                if($r==1)
                {
                $msg.='
                <a href='.url("sview_result").'/'.encrypt($ed["eid"]).'
                    class="btn btn-p-result p-1 btn-rounded" data-toggle="tooltip"
                    data-placement="top" title="Show Result">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award  text-success"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                </a>';
                }
                $msg.='</td>
            </tr>';
        }
        return response()->json(array('msg'=>$msg),200);
    }
    public function backup($bkpFileName = null)
    {
        // $ci =& get_instance();
        $targetTables = ['tblevents','tblnotice','tblcoordinaters','tblparticipant','tblstudent'];
        $newLine = "\r\n";
        $content="/* backup date:".date('d-m-Y h:i:s')."*/\n\n";
        
        foreach($targetTables as $table){
            $content.="-- ".$table." \n\n";
            $tableData = DB::select(DB::raw('SELECT * FROM '.$table.' where clgcode="'.Session::get('aclgcode').'"'));
            $cnt = 0;
            $content = (!isset($content) ?  '' : $content);
            foreach($tableData as $row){
                $subContent = "";
                $firstQueryPart = "";
                if($cnt == 0 || $cnt % 100 == 0){
                    $firstQueryPart .= "INSERT INTO {$table} VALUES ";
                    if(count($tableData) > 1)
                        $firstQueryPart .= $newLine;
                }

                $valuesQuery = "(";
                foreach($row as $key => $value){
                    $valuesQuery .= '\''.$value . "', ";
                }

                $subContent = $firstQueryPart . rtrim($valuesQuery, ", ") . ")";

                if( (($cnt+1) % 100 == 0 && $cnt != 0) || $cnt+1 == count($tableData))
                    $subContent .= ";" . $newLine;
                else
                $subContent .= ",".$newLine;

                $content .= $subContent;
                $cnt++;
            }
            $content .= "\n\n";
        }

        $targetTables1 = ['tblrates','tbllog'];
        $newLine = "\r\n";
        foreach($targetTables1 as $table){
            $content.="-- ".$table."\n\n";
            if($table=='tblrates')
            $tableData =\DB::table('tblrates')->select('tblrates.rid','tblrates.eid','tblrates.enrl','tblrates.rate')->join('tblevents','tblevents.eid','tblrates.eid')->where('tblevents.clgcode',Session::get('aclgcode'))->get()->toarray();
            else{
                $tableData =\DB::table('tbllog')->select('tbllog.*')->join('tblcoordinaters','tblcoordinaters.cid','tbllog.uid')->where([['tbllog.utype','co-ordinator'],['tblcoordinaters.clgcode',Session::get('aclgcode')]])->get()->toarray();
            }
            $cnt = 0;
            $content = (!isset($content) ?  '' : $content);
            foreach($tableData as $row){
                $subContent = "";
                $firstQueryPart = "";
                if($cnt == 0 || $cnt % 100 == 0){
                    $firstQueryPart .= "INSERT INTO {$table} VALUES ";
                    if(count($tableData) > 1)
                        $firstQueryPart .= $newLine;
                }

                $valuesQuery = "(";
                foreach($row as $key => $value){
                    $valuesQuery .= '\''.$value . "', ";
                }

                $subContent = $firstQueryPart . rtrim($valuesQuery, ", ") . ")";

                if( (($cnt+1) % 100 == 0 && $cnt != 0) || $cnt+1 == count($tableData))
                    $subContent .= ";" . $newLine;
                else
                    $subContent .= ",".$newLine;

                $content .= $subContent;
                $cnt++;
            }
            $content .= "\n\n";
        }

        $content = trim($content);


        //check for functions
       
        $dbBackupFile = 'f:/';
            $dbBackupFile .= date('d-m-Y').".sql";

        $handle = fopen($dbBackupFile, "w+");
        fwrite($handle, $content);
        fclose($handle);
        return response()->download($dbBackupFile);
        // return $content;
    }
    public function addcat(Request $req)
    {
        $cat=$req->catname;
        $catpic=$req->avatar;
        if($cat=="" || $catpic=="")
        {
            session()->flash('error', 'Please Enter category name or select image..!');
            return redirect(url('sindex'));
        }
        $c=\DB::table('tblcategory')->where('category_name',$cat)->count();
        if($c>0)
        {
            session()->flash('error', 'This category already exist..! ');
        }
        else{
            $cid=time();
            $insrt=\DB::table('tblcategory')->insert(['category_id'=>$cid,'cat_pic'=>$catpic,'category_name'=>$cat,'clgcode'=>Session::get('aclgcode'),'status'=>'a']);
            session()->flash('success', 'Category added successfully..');
        }
        return redirect(url('sindex'));
    }
    public function delcat($cid)
    {
        $c=tblevent::where('cate_id',$cid)->count();
        if($c>0)
        {
            $upd=\DB::table('tblcategory')->where('category_id',$cid)->update(['status'=>'i']);
            if($upd)
            {
                $updco=\DB::table('tblcoordinaters')->where('cate_id',$cid)->update(['status'=>'i']);
                session()->flash('success', 'Category Deleted successfully..');
            }
        }
        else{
            $del=\DB::table('tblcategory')->where('category_id',$cid)->delete();
            if($del)
            {
                $updco=\DB::table('tblcoordinaters')->where('cate_id',$cid)->delete();
                session()->flash('success', 'Category Deleted successfully..');
            }
        }
        return redirect(url('sindex'));
    }
    public function updatecat(Request $req)
    {
        $cat=$req->catname;
        $cid=$req->cid;
        if($cat=="")
        {
            session()->flash('error', 'Category name is not allowed empty..! ');
            return back();
        }
        $c=\DB::table('tblcategory')->where([['category_name',$cat],['category_id','!=',$cid]])->count();
        if($c>0)
        {
            session()->flash('error', 'This category already exist..! ');
            return back();
        }
        $up_cat=\DB::table('tblcategory')->where('category_id',$cid)->update(['category_name'=>$cat,'cat_pic'=>$req->avatar]);
        if($up_cat)
        {
            session()->flash('success', 'Category updated successfully.');
        }
        return redirect(url('sindex'));
    }
}
