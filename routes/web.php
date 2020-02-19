<?php

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


Route::group(['middleware' => 'co_session_check'], function () {

        Route::get('/view_team/{pid}', 'co_ordinate@view_team');
    
        Route::get('/create_result/{eid}','co_ordinate@create_result');

        Route::view('/view_result', 'co-ordinates/view_result');

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

});

// xxxxxxxxxxxxxxx co_ordinator dashboard routes finished xxxxxxxxxxxxxxxxxxxxxxxxx



// ==========================================================================
// super admin dashboard routes start
// ==========================================================================

route::view('/slogin','super-admin/superadmin_login');

Route::post('/a_checklogin','s_admin@checklogin');

Route::group(['middleware' => 'admin_session_check'], function () { 
            
        route::get('/sindex','s_admin@sindex');

        route::view('/snotice','super-admin/new_notice');

        route::post('/admin-noticesend','s_admin@send_notice');

        route::view('/new_cod','super-admin/new_cordinate');

        route::view('/s_change_pass','super-admin/change_password');

        route::post('/change_pass','s_admin@update_pass');

        route::get('/alogout','s_admin@logout');

        route::post('/alastnotice','s_admin@last_noti');
    
        route::view('/sbanner','super-admin/create_banner');
    });

// xxxxxxxxxxxxxxx super-admin dashboard routes finished xxxxxxxxxxxxxxxxxxxxxxxxx

