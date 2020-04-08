<?php
use Illuminate\Http\Request;
use App\log;
use App\tblevent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ==========================================================================
// starting page routes start
// ==========================================================================

route::get('/',function(){
    $clg=\DB::table('tblcolleges')->select('clgname','clgcode')->get()->toarray();
    return view('start/college_list',['clgs'=>$clg]);
});
route::post('/event_list', function(Request $req){
    $events=tblevent::where([['clgcode',$req->clgcode],
        ['reg_end_date','>=',date('Y-m-d')],
        ['reg_start_date','<=',date('Y-m-d')]])
        ->orderby('reg_end_date')->get()->toArray();
    return view('start/event_list',['events'=>$events,'clgcode'=>$req->clgcode]);
});
route::view('/getdemo','start/demo');
route::get('/e_info/{eid}', function($eid){
    $eid=decrypt($eid);
    $einfo=tblevent::select('tblevents.*','tblcoordinaters.cname','tblcolleges.clgname','tblcategory.category_name')->join('tblcoordinaters','tblcoordinaters.cid','tblevents.cid')->join('tblcolleges','tblcolleges.clgcode','tblcoordinaters.clgcode')->join('tblcategory','tblcategory.category_id','=','tblevents.cate_id')->where('tblevents.eid',$eid)->first();
    return view('start/e_info',['einfo'=>$einfo]);
});


// ==========================================================================
// Student dashboard routes start
// ==========================================================================



Route::group(['middleware' => 'SessionCheck'], function () {
    route::get('/index',function(){
         return view('index');
});

    route::get('/profile','student@activity');
    
    route::get('/about_event/{pid}','student@about_event');
   
    

    route::get('index','student@index');

    Route::get('/logout','student@logout');
    
    Route::get('/notice','student@notice');

    Route::get('/explore/{name}','student@explore');

    Route::get('/team-insert/{eid}','student@team_ins');
    
    Route::post('/tnameexist','student@tnamecheck');

    Route::get('/participate-now/{eid}','student@participate');

    Route::get('/confirm-reg/{eid}/{maxteam}','student@confirm');

     Route::get('/winner-list',function(){
        $winners=\DB::table('tblparticipant')->select('eid')->where('rank','!=','p')->orderby('eid','desc')->groupby('eid')->get()->toarray();
        $ddclass=DB::table('tblstudent')->select('class')->groupBy('class')->get()->toArray();
        // print_r($winners);
        return view('/winner',['winners'=>$winners,'ddclass'=>$ddclass]);
    });

    Route::post('/filter','student@filter');
    
    Route::get('/teamvalidation','student@teamvalidation');
    
    Route::get('/confirm-reg/{eid}/{enrl}/{tname}','student@confirm_reg');

    Route::post('/insertteam','student@team_confirm');

    Route::get('/check_event_info/{id}','student@check_event_info');

    route::post('student_update_action/{senrl}', 'student@student_update_action');
    
    route::get('/profile/confirm_del/{pid}','student@confirm_del');
    // route::any('student_update/{senrl}', 'student@student_update');
    Route::get('/viewteam/{pid}', 'student@view_team');
    
    Route::post('/rate','student@rate');

});
Route::get('/otpview/{senrl}/{clgcode}/{check?}','student@otpview');
Route::post('/otp_check/{senrl}/{clgcode}/{check?}','student@otp_check');
Route::get('/timers','student@timers');
Route::get('/login','student@login');
Route::post('/checklogin','student@checklogin')->middleware('ValidCheck');
Route::get('/resend_otp/{senrl}/{clgcode}/{check?}', 'student@resend_otp');



// xxxxxxxxxxxxxxx Student dashboard routes finished xxxxxxxxxxxxxxxxxxxxxxxxx


// ==========================================================================
// co-ordinator dashboard routes start
// ==========================================================================

// Route::view('/cindex','co-ordinates/newindex');

Route::get('/clogin','co_ordinate@login');
Route::post('/c_checklogin','co_ordinate@checklogin')->middleware('co_valid_check');

Route::get('/resetpassword',function(){
    return view('co-ordinates/reset_pass');
});
Route::post('/csend_otp','co_ordinate@send_otp');

Route::post('/confirm_pass','co_ordinate@confirm_pass');

Route::post('/ctimers','co_ordinate@timers');

Route::post('/change_pass/{email}', 'co_ordinate@change_pass');

Route::post('/cresend_otp','co_ordinate@send_otp');

Route::group(['middleware' => 'co_session_check'], function () {

        Route::view('/cod_profile','co-ordinates/cod_profile');

        Route::get('/clogout','co_ordinate@logout');

        Route::view('/cnotice','co-ordinates/create_notice');

        Route::view('/change_pass','co-ordinates/change_pass');

        Route::get('/delete_event','co_ordinate@delete_event');
    
        Route::get('/update_event/{eid}','co_ordinate@update_event');
    
        Route::post('/action_update/{eid}','co_ordinate@action_update');
    
        Route::post('/del_banner','co_ordinate@del_banner');
    
        Route::get('/cindex','co_ordinate@index');

        Route::get('/view_candidates/{eid}','co_ordinate@view_can');
      
        Route::get('/create_event',function(){
            $class=App\tblstudent::select('class')->where('clgcode',Session::get('cclgcode'))->groupby('class')->orderby('class')->get();
            return view('co-ordinates/newevent',['class'=>$class]);    
        });  

        Route::post('/newevent','co_ordinate@create_event');

        Route::post('/msg','co_ordinate@err');
            
        Route::get('/event_info/{id}','co_ordinate@event_info');

        route::post('/lastnotice','co_ordinate@last_noti');
    
        Route::post('/update_pass','co_ordinate@update_pass');
    
        Route::post('/noticesend','co_ordinate@send_notice');
    
        Route::get('/view_team/{pid}', 'co_ordinate@view_team');
    
        Route::get('/create_result/{eid}','co_ordinate@create_result');
    
    
        Route::post('/rank','co_ordinate@rank');

        Route::get('/view_result/{eid}', 'co_ordinate@view_result');
    
        route::post('/cod_profile/updateprofile','co_ordinate@updateprofile');
    
        route::post('/update_propic','co_ordinate@update_propic');

        Route::get('/cindex/winner-list',function(){
            $winners=\DB::table('tblparticipant')->select('eid')->where('rank','!=','p')->orderby('eid','desc')->groupby('eid')->get()->toarray();
            $ddclass=DB::table('tblstudent')->select('class')->groupBy('class')->get()->toArray();
            // print_r($winners);
            return view('co-ordinates/winner',['winners'=>$winners,'ddclass'=>$ddclass]);
        });
    
        Route::post('/cfilter','student@filter');
});

// xxxxxxxxxxxxxxx co_ordinator dashboard routes finished xxxxxxxxxxxxxxxxxxxxxxxxx



// ==========================================================================
// super admin dashboard routes start
// ==========================================================================

route::view('/slogin','super-admin/superadmin_login');

Route::post('/a_checklogin','s_admin@checklogin');

Route::get('/a_resetpassword',function(){
    return view('super-admin/reset_pass');
});

Route::post('/a_send_otp','s_admin@send_otp');

Route::post('/a_confirm_pass','s_admin@confirm_pass');

Route::post('/a_timers','s_admin@timers');

Route::post('/a_change_pass/{email}', 's_admin@change_pass');

Route::post('/a_resend_otp','s_admin@send_otp');

Route::group(['middleware' => 'admin_session_check'], function () { 
            
        route::get('/sindex','s_admin@sindex');

        route::view('/snotice','super-admin/new_notice');

        route::post('/admin-noticesend','s_admin@send_notice');

        route::view('/new_cod','super-admin/new_cordinate');
    
        route::post('new_cod_add', 's_admin@new_cod_add');
    
        Route::post('/c_check','s_admin@err');

        route::view('/s_change_pass','super-admin/change_password');

        route::post('/change_pass','s_admin@update_pass');

        route::get('/alogout','s_admin@logout');

        route::post('/alastnotice','s_admin@last_noti');
    
        route::post('/import-excel','s_admin@import');
    
        route::view('/sbanner','super-admin/create_banner');


        route::get('/approval', 's_admin@approval');

        route::get('/approval/confirm_del/{eid}/{val}','s_admin@con_del');

        route::view('admin_profile','super-admin/admin_profile');

        route::view('add_student', 'super-admin/add_student');
    
        route::post('/checkenrl','s_admin@checkenrl');

        route::post('/checkemail','s_admin@checkemail');

        route::post('/checkmobile','s_admin@checkmobile');

        route::post('/checkrno','s_admin@checkrno');

        route::post('/studinsrt','s_admin@studinsrt');
     
        route::get('/check_logs', function(){
            $logs=log::join('tblcoordinaters','tblcoordinaters.cid','tbllog.uid')
            ->where([['tblcoordinaters.clgcode',Session::get('aclgcode')],['tbllog.utype','co-ordinator']])
            ->orderby('time','desc')->paginate(10);
            $cod=App\tblcoordinaters::select('cid','cname')->where('clgcode',Session::get('aclgcode'))->get();
            return view('super-admin/check_logs',['logs'=>$logs,'cod'=>$cod]);
        });

        route::any('/filterlog','s_admin@filterlog');

        route::get('view_students', 's_admin@view_students');

        route::any('action_update_stud/{senrl}', 's_admin@action_update_stud');

        route::any('update_stud/{senrl}', 's_admin@update_stud');
    
        route::post('/admin_profile/updateprofile','s_admin@updateprofile');

        Route::get('/sevent_info/{id}','s_admin@event_info');

        route::view('student_records','super-admin/student_records');

        Route::get('/sview_result/{eid}', 's_admin@view_result');

        Route::get('/sview_candidates/{eid}','s_admin@view_can');

        Route::get('/sview_team/{pid}', 's_admin@view_team');
    
        Route::get('/view_student/confirm_del/{enrl}','s_admin@stud_del');
    
        Route::get('confirm_del_cod/{cid}','s_admin@cod_del');
    
        route::post('/supdate_propic','s_admin@update_propic');
    
        Route::post('/srank','co_ordinate@rank');    
    
        route::get('/delay_res/{eid}','s_admin@delay_res');

        route::get('/event_reports','s_admin@event_reports');
    
        Route::get('/admin/winner-list',function(){
                $winners=\DB::table('tblparticipant')->select('eid')->where('rank','!=','p')->orderby('eid','desc')->groupby('eid')->get()->toarray();
                $ddclass=DB::table('tblstudent')->select('class')->groupBy('class')->get()->toArray();
                // print_r($winners);
                return view('super-admin/winner',['winners'=>$winners,'ddclass'=>$ddclass]);
            });
    
        Route::post('/afilter','student@filter');

        route::view('/add_category','super-admin/add_category');

        route::post('/addcat','s_admin@addcat');

        route::get('delcat/{cate_id}','s_admin@delcat');
   
        route::get('updatecat/{cate_id}',function($cid){
            $cat=\DB::table('tblcategory')->where('category_id',$cid)->first();
            return view('super-admin/updatecategory',['cat'=>$cat]);
        });

        route::post('updatecat','s_admin@updatecat');

        route::post('event_filter','s_admin@event_filter');

        route::any('single_record/{senrl}','s_admin@single_stud_rec');
    
        route::get('backup','s_admin@backup');
    });

// xoxoxxxxxxxxxxxxx super-admin dashboard routes finished xxxxxxxxxxxxxxxxxxxxxxxxx


// ==========================================================================
// System admin dashboard routes start
// ==========================================================================
route::post('/check_login', 'system@check_login');

 route::post('/demo_req','system@demo_req');
 route::view('/s_log_in', 'system/log_in');
 Route::group(['middleware' => 'system_session_check'], function () { 

    route::get('syslogout',function(){
        Session::flush(); 
        return redirect(url('/s_log_in'));
    });

    route::get('/system','system@index');

    route::get('/s_send_notice',function(){
        $clgs=\DB::table('tblcolleges')->select('clgname','clgcode')->get();
        return view('system/send_notice',['clgs'=>$clgs]);
    });

    route::post('send_notice','system@send_notice');

    route::get('/s_send_notice',function(){
    $clgs=\DB::table('tblcolleges')->select('clgname','clgcode')->get();
    return view('system/send_notice',['clgs'=>$clgs]);
    });

    route::get('/s_demo_request','system@demo_request');

    

    route::get('/s_read_request/{did}',function($did){
        $did=decrypt($did);
        $d_req=\DB::table('tbldemoreq')->where('did',$did)->first();
        return view('system/read_request',['d_req'=>$d_req]);
    });

    route::post('/system/add_institute','system@add_institute');

    route::post('system/update_profile','system@update_pro');

    route::get('/system/delreq/{did}',function($did){
        $del=\DB::table('tbldemoreq')->where('did',$did)->delete();
        session()->flash("alert-success","Request rejected successfully..!");
        return redirect(url('system'));
    });
    route::post('system/update_pass','system@update_pass');
    route::view('/s_add_college', 'system/add_college');
    route::any('/add_college','system@add_college');

    route::post('/action_update_college','system@action_update_college');
    route::any('/update_college/{clgcode}', 'system@update_college');
    
    route::post('/change_status','system@change_status');

    route::get('/delclg/{clgcode}','system@delclg');         

 });


