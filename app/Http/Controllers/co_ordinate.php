<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\tblevent;
use App\participant;
class co_ordinate extends Controller
{
    public function index()
    {
        session()->put('cid','1');
        session()->put('cname','Akki');
        session()->put('clgcode','sbccas');
        session()->put('cat','sports');
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
}

