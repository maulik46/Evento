<?php

namespace App\Http\Controllers;
use App\notice;
use session;
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
        print_r($req->file('attachment[]'));
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
        echo $fname;
        // $notice=new notice;
        // $notice->topic=$req->title;
        // $notice->message=$req->message;
        // $notice->sender='system';
        // $notice->sender_type='system';
        // $notice->receiver='admin';
        // $notice->ndate=date('Y-m-d');
        // $notice->ntime=date('h:i A');//change
        // $notice->clgcode=$clgs;
        // $notice->attechment=$fname;
        // $notice->save();
        // session()->flash('success', 'Notice send successfully');
        // return back();
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
        session()->flash('danger','Invalid email or password');
        return back();
    }
}
