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
// Student dashboard routes start
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
route::view('/winner', 'winner');
route::get('/e_info/{eid}', function($eid){
    $eid=decrypt($eid);
    $einfo=tblevent::select('tblevents.*','tblcoordinaters.cname','tblcolleges.clgname')->join('tblcoordinaters','tblcoordinaters.cid','tblevents.cid')->join('tblcolleges','tblcolleges.clgcode','tblcoordinaters.clgcode')->where('tblevents.eid',$eid)->first();
    return view('start/e_info',['einfo'=>$einfo]);
});

Route::group(['middleware' => 'SessionCheck'], function () {
    route::get('/index',function(){
         return view('index');
});

    route::get('/profile','student@activity');
    
    route::get('/about_event/{pid}','student@about_event');
    
    route::get('/winner-list',function(){
        return view('winner-list');    
    });   
    
    route::get('/','student@index');

    route::get('index','student@index');

    Route::get('/logout','student@logout');
    
    Route::get('/notice','student@notice');

    Route::get('/explore/{name}','student@explore');

    Route::get('/team-insert/{eid}','student@team_ins');
    
    Route::post('/tnameexist','student@tnamecheck');

    Route::get('/participate-now/{eid}','student@participate');

    Route::get('/confirm-reg/{eid}/{maxteam}','student@confirm');

    Route::get('/winner-list','student@winnerlist');

    Route::get('/filter','student@filter');
    
    Route::get('/teamvalidation','student@teamvalidation');
    
    Route::get('/confirm-reg/{eid}/{enrl}/{tname}','student@confirm_reg');

    Route::post('/insertteam','student@team_confirm');

    Route::get('/check_event_info/{id}','student@check_event_info');

    route::post('student_update_action/{senrl}', 'student@student_update_action');
    
    route::get('/profile/confirm_del/{pid}','student@confirm_del');
    // route::any('student_update/{senrl}', 'student@student_update');
    Route::view('/view_winner_team', 'view_winner_team');


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
    
        Route::get('/cindex','co_ordinate@index');

        Route::get('/view_candidates/{eid}','co_ordinate@view_can');
      
        Route::get('/create_event',function(){
            $class=App\tblstudent::select('class')->where('clgcode',Session::get('clgcode'))->groupby('class')->orderby('class')->get();
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
            ->where([['tblcoordinaters.clgcode',Session::get('clgcode')],['tbllog.utype','co-ordinator']])
            ->orderby('time','desc')->paginate(10);
            $cod=App\tblcoordinaters::select('cid','cname')->where('clgcode',Session::get('clgcode'))->get()->toarray();
            return view('super-admin/check_logs',['logs'=>$logs,'cod'=>$cod]);
        });

        route::post('/filterlog','s_admin@filterlog');

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
   
    });

// xoxoxxxxxxxxxxxxx super-admin dashboard routes finished xxxxxxxxxxxxxxxxxxxxxxxxx


// ==========================================================================
// System admin dashboard routes start
// ==========================================================================


 route::view('/system','system/index');
 route::view('/system_notice','system/system_notice');
 route::view('/system_change_password','system/change_password');
 route::view('/system_add_college', 'system/add_college');
