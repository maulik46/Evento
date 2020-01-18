<?php

namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Http\Request;
use App\tblevent;
use App\participant;
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
        $events=tblevent::where([['clgcode',Session::get('clgcode')]
        ])->orderby('edate','desc')->get()->toarray();//change
        return view('co-ordinates/newindex',['events'=>$events]);
    }
    public function view_can($id)
    {
        $participate=participant::select('senrl','tname')->where('eid',$id)->get()->toarray();
        $einfo=tblevent::select('eid','ename','e_type','edate')->where('eid',$id)->first()->toarray();
        return view('co-ordinates/view_candidates',['participate'=>$participate],['einfo'=>$einfo]);
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
    }
    public function err(Request $req){
        $ename = $req->ename;
        $gen=$req->gen;
        $events=tblevent::where([['clgcode',Session::get('clgcode')],['ename',$ename],['gallow',$gen]
        ])->count();
            return response()->json(array('msg'=> $events),200);
     }
     public function event_info($id)
     {      
            $einfo=tblevent::where('eid',$id)->first();
            return view("co-ordinates/event_info",['einfo'=>$einfo]);
     }
     public function event_result($id)
     {     
        
        $participate=participant::select('senrl','tname')->where('eid',$id)->get()->toarray();
        $einfo=tblevent::select('eid','ename','e_type','edate')->where('eid',$id)->first()->toarray();
        return view('co-ordinates/view_candidates',['participate'=>$participate],['einfo'=>$einfo]);
        
        return view("co-ordinates/result",['eresult'=>$eresult]);
     }

}

