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

Route::get('/', function () {
    return view('portal');
})->middleware('auth');

Auth::routes();

Route::get('/portal', 'PortalController@index')->name('portal');
Route::get('/portal/reseller/{target}/{limit}/{orderby}/{filter}/{page}', 'ResellerController@query');
Route::get('/portal/resellerChart/{target}/{limit}/{orderby}/{filter}/{chart}', 'ResellerController@query');
Route::get('/portal/branch/{target}/{limit}/{orderby}/{filter}/{page}', 'BranchController@query');
Route::get('/portal/branchChart/{target}/{limit}/{orderby}/{filter}/{chart}', 'BranchController@query');