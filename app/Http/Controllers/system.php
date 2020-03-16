<?php

namespace App\Http\Controllers;
use App\notice;
use session;
use App\admin;

use Illuminate\Http\Request;
date_default_timezone_set("Asia/Kolkata"); 
class system extends Controller
{
    public function index()
    {
        $clgs=\DB::table('tblcolleges')->join('tbladmin','tblcolleges.clgcode','tbladmin.clgcode')->get();
        // print_r($clgs);
        return view('system/index',['clgs'=>$clgs]);
    }
    public function demo_req(Request $req)
    {
        $demo_req=\DB::table('tbldemoreq')->insert(['aname'=>$req->aname,'email'=>$req->email,'iname'=>$req->iname,'contact'=>$req->contact,'city'=>$req->city,'address'=>$req->addr,'msg'=>$req->msg,'reqdate'=>date('Y-m-d')]);
        session()->flash("success","Demo request send successfully..");
        return back();
    }
    public function demo_request()
    {
        $demos=\DB::table('tbldemoreq')->get();
        return view('system/demo_request',['demos'=>$demos]);
    }
    public function send_notice(Request $req)
    {
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
        $clgs="";
        foreach($req->clg as $clg)
        {
            $clgs.=$clg."-";
        }
        $notice=new notice;
        $notice->topic=$req->title;
        $notice->message=$req->message;
        $notice->sender='system';
        $notice->sender_type='system';
        $notice->receiver='admin';
        $notice->ndate=date('Y-m-d');
        $notice->ntime=date('h:i A');//change
        $notice->clgcode=$clgs;
        $notice->attechment=$fname;
        $notice->save();
        session()->flash('alert-success', 'Notice send successfully');
        return redirect(url('/system'));

    }
    public function check_login(Request $req)
    {
        $user=\DB::table('tblsysadmin')->where([['s_email',$req->amail],['pass',$req->password]])->count();
        if($user==1)
        {
            $user=\DB::table('tblsysadmin')->where([['s_email',$req->amail],['pass',$req->password]])->first();
            session()->put('sysadmin',$user->s_aname);
            session()->put('sysemail',$user->s_email);
            session()->put('sysmobile',$user->s_mobile);
            session()->put('syspropic',$user->s_propic);
            return redirect(url('system'));
        }
        session()->flash('alert-danger','Invalid email or password');
        return back();
    }
    public function add_college(Request $req)
    {
        $admin=new admin;
        $admin->clgcode=$req->clg_code;
        $admin->name=$req->admin_name;
        $admin->email=$req->admin_email;
        $admin->mobile=$req->clg_mob;
        $admin->pass=$req->admin_pass;
        $admin->profilepic='child.svg';

        $tbl_clg_data=[
            'clgcode' => $req->clg_code, 
            'clgname' => $req->clg_name, 
            'address' => $req->clg_add, 
            'city' => $req->clg_city,
            'start_date'=>date('Y-m-d')

        ];
        $tbl_clg = \DB::table('tblcolleges')->insert($tbl_clg_data);

        $admin->save();
        return redirect(url('/system')); 
    }
    public function update_college($clgcode)
    {
        $clgcode=decrypt($clgcode);
        $table=admin::join('tblcolleges','tblcolleges.clgcode','=','tbladmin.clgcode')->where('tblcolleges.clgcode',$clgcode)->get()->first();
        return view('system/update_college',['clg_data'=>$table]); 
    }
    public function action_update_college(Request $req)
    {
        $clgcode = decrypt($req->clgcode);
        $admin_name = $req->admin_name;
        $admin_email = $req->admin_email;
        $admin_mobile = $req->clg_mob;

        $clg_name = $req->clg_name; 
        $clg_city = $req->clg_city;
        $clg_add = $req->clg_add;


        $tbl_admin_data=[
            'name'=>$admin_name,
            'email'=>$admin_email,
            'mobile'=>$admin_mobile
        ];
        $update=admin::where('clgcode',$clgcode)->update($tbl_admin_data);

        $tbl_clg_data=[
            'clgname'=>$clg_name,
            'address'=>$clg_city,
            'city'=>$clg_add
        ];
        $tbl_clg= \DB::table('tblcolleges')->where('clgcode', $clgcode)->update($tbl_clg_data);
        
        return redirect(url('/system'));

    }
    public function update_pro(Request $req)
    {
        $smobile=$req->user_mobile;
        $semail=$req->user_email;
        $sname=$req->user_name;
        if($file=$req->file('photo-upload'))
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
            $rec=\DB::table('tblsysadmin')->where('sid',$req->sid)->update(['s_aname'=>$sname,'s_email'=>$semail,'s_mobile'=>$smobile,'s_propic'=>$pro_pic]);
            session()->put('syspropic',$pro_pic);
        }
        else{
            $rec=\DB::table('tblsysadmin')->where('sid',$req->sid)->update(['s_aname'=>$sname,'s_email'=>$semail,'s_mobile'=>$smobile]);
        }
        
        if($rec>0)
        {
            
            session()->put('sysadmin',$sname);
            session()->put('sysemail',$semail);
            session()->put('sysmobile',$smobile);
            session()->flash('alert-success', 'Profile updated successfully');
        }
        return back();
    }
    public function update_pass(Request $req)
    {
        $c=\DB::table('tblsysadmin')->where([['sid',Session::get('sid')],['pass',$req->current_pass]])->count();
       if($c==1)
       {
           if($req->npass == $req->cpass)
           {
            \DB::table('tblsysadmin')->where('sid',Session::get('sid'))->update(['pass'=>$req->npass]);
           }
           else{
               session()->flash('alert-danger', 'Newpassword and confirm password not match..!');
               return redirect()->back();
           }
       }
       else
       {
           session()->flash('alert-danger', 'Invalid password..!');
           return redirect()->back();
           
       }
       session()->flash('alert-success', 'Password updated successfully..!');
       return redirect(url('system'));
    }
    public function add_institute(Request $req)
    {
        $iname=$req->iname;
        $pass=uniqid();
        $to_email=trim($req->email);
        $message="
        sub : <b>confrimation for demo request</b>
        <br><br>
        Dear <b>".ucfirst($req->aname)."</b>,
        <br><br>
        Last ".date('d,F Y',strtotime($req->reqdate)).", you sent demo request for your instistute  <b>".ucfirst($req->iname)."</b>.<br>
        we glad to inform you that the your demo request accepted.
        <br><br>
        <b>your login details as follow.</b>
        <table border=1 style='padding:10px'> <tr style='background-color:#e6e6e6'><td style='padding:5px'> User Name </td><td style='padding:5px'> Password </td></tr>  <tr><td style='padding:5px'>".$to_email."</td> <td style='padding:5px'>".$pass."</td></tr>    </table>
        <br>
        Sincerely,
        <br>
        Evento Team.";
        $data=array('name'=>"",'body'=>$message);
        \Mail::send('email',$data,function($message) use ($iname, $to_email){
            $message->to($to_email)->replyTo("eventoitsol@gmail.com",$name=null)
            ->from("eventoitsol@gmail.com", $name = "Evento")
            ->subject("Confirmation for demo request")->bcc($to_email);
        });
        
        $clg_insrt=\DB::table('tblcolleges')->insert(['clgcode'=>$req->clgcode,'clgname'=>$iname,'address'=>$req->addrs,'city'=>$req->city,'status'=>'running','start_date'=>date('Y-m-d')]);
        
        $admin=new admin();
        $admin->clgcode=$req->clgcode;
        $admin->name=$req->aname;
        $admin->email=$req->email;
        $admin->mobile=$req->contact;
        $admin->pass=$pass;
        $admin->last_noti="0";
        $admin->profilepic="professor.svg";
        $admin->save();
        \DB::table('tbldemoreq')->where('did',$req->did)->delete();
        session()->flash("alert-success","College added successfully..!");
        return response()->json(array('msg'=> "success"),200);
    }

}
