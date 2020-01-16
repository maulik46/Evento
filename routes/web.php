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
    
    route::get('/winner-list',function(){
        return view('winner-list');    
    });   
    
    route::get('/','student@index');

    route::get('index','student@index');

    Route::get('/logout','student@logout');
    
    Route::view('/notice','notice');

    Route::get('/explore/{name}','student@explore');

    Route::get('/team-insert/{eid}','student@team_ins');

    Route::get('/participate-now/{eid}','student@participate');

    Route::get('/confirm-reg/{eid}','student@confirm');

    Route::get('/winner-list','student@winnerlist');

    Route::get('/action','student@action');
    
    Route::get('/confirm-reg/{eid}/{enrl}','student@confirm_team');

    Route::POST('/insertteam/{galw}/{alw_dif_class}/{a_d_d}','student@insert_team');

  
});
//Route::get('/getc','student@getc');
Route::get('/login','student@login');
Route::post('/checklogin','student@checklogin')->middleware(['ValidCheck', 'CookieCheck']);


// ==========================================================================
// Student dashboard routes finished
// ==========================================================================

// ==========================================================================
// co-ordinator dashboard routes start
// ==========================================================================

Route::view('/cindex','co-ordinates/newindex');

Route::view('/cnotice','co-ordinates/create_notice');

Route::view('/change_pass','co-ordinates/change_pass');

Route::view('/event_info','co-ordinates/event_info');

Route::view('/create_event','co-ordinates/newevent');

Route::view('/view_candidates','co-ordinates/view_candidates');

Route::view('/clogin','co-ordinates/coordinate_login');

// ==========================================================================
// co-ordinator dashboard routes finished
// ==========================================================================

// ==========================================================================
// super admin dashboard routes start
// ==========================================================================

route::view('/sindex','super-admin/index');

route::view('/snotice','super-admin/new_notice');

route::view('/new_cod','super-admin/new_cordinate');

route::view('/slogin','super-admin/superadmin_login');

route::view('/s_change_pass','super-admin/change_password');

route::view('/sbanner','super-admin/create_banner');

// ==========================================================================
// super admin dashboard routes end
// ==========================================================================
