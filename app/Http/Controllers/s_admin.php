<?php

namespace App\Http\Controllers;
date_default_timezone_set("Asia/Kolkata"); 
use Illuminate\Http\Request;
use validator;
use App\tblevent;
use App\notice;
use App\tblcoordinaters;
use App\participant;
use App\log;
use App\admin;
use Cookie;
use Session;
class s_admin extends Controller
{
    public function checklogin(Request $req)
    {
        $login_details = admin::where([
            ['email', '=', $req->auser],
            ['pass', '=', $req->password]
        ])
        ->count();
        if ($login_details==1) 
        {
            $admin=admin::where([['pass', $req->password],['email',$req->auser]])->first();
            session()->put('aid', $admin['aid']);
            session()->put('clgcode', $admin['clgcode']);
            session()->put('aname',$admin['name']);
            session()->put('email',$admin['email']);  
            session()->put('mobile',$admin['mobile']);
            $log=new log;
            $log->uid=Session::get('aid');
            $log->action_on="login";
            $log->action_type="login";
            $log->time=time();
            $log->utype="admin";
            $log->ip_add=$_SERVER['REMOTE_ADDR'];
            $log->save();
            // print_r(session()->all());
            return redirect(url('sindex'));
        } 
        else
        {
            return back()->with('error','Invalid Co-ordinate ID or Password');
        }
    }
    public function logout()
    {
        $log=new log;
        $log->uid=Session::get('aid');
        $log->action_on="logout";
        $log->action_type="logout";
        $log->time=time();
        $log->utype="admin";
        $log->ip_add=$_SERVER['REMOTE_ADDR'];
        $log->save();
        Session::flush(); 
        return redirect(url('/slogin'));
    }
    public function sindex()
    {
        $events=tblevent::where([['clgcode',Session::get('clgcode')]
            ])->orderby('edate','desc')->get()->toarray();
        $cod=tblcoordinaters::where('clgcode',Session::get('clgcode'))->get();
        return view('super-admin/index',['events'=>$events,'cods'=>$cod]);
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
        ->join('tblcoordinaters','tblcoordinaters.cid','=','tblapproval.cid')->where('tblevents.clgcode',Session::get('clgcode'))->get()->toarray();
        return view('super-admin/approval',['delevnt'=>$apl]);
    }
    public function con_del($eid,$y)
    {
        $e_id=decrypt($eid);
        
        if($y=="del")
        {
            $msg_info=tblevent::join('tblapproval','tblapproval.eid','tblevents.eid')->where('tblevents.eid',$e_id)->first();
            $message="Event Name    <b>:".ucfirst($msg_info['ename'])."</b><br>Reason       <b>:".ucfirst($msg_info['reason']);
            
            
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
            
        }
        $del_event=\DB::table('tblapproval')->where('eid',$e_id)->delete();
        return back();
    }
}
