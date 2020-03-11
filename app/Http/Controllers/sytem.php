<?php

namespace App\Http\Controllers;
use App\notice;
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
        $notice->receiver='adminn';
        $notice->ndate=date('Y-m-d');
        $notice->ntime=date('h:i A');//change
        $notice->clgcode=$clgs;
        $notice->attechment="";
        $notice->save();
    }
}
