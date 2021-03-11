<?php
session_start();
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

Route::get('/', 'User@login');
Route::get('/home', 'User@index');
Route::get('/login_admin', 'User@login_admin');
Route::get('/login', 'User@login');
Route::post('/loginPost', 'User@loginPost');
Route::get('/ldap_post/{email}','User@cekPengguna');
Route::get('/ldap_reject', 'User@ldap_reject');
Route::get('/logout', 'User@logout');

Route::get('/dashboard/graph_1/{param}','User@showGraph_1');
Route::get('/dashboard/graph_2/{param}','User@showGraph_2');
Route::get('/dashboard/graph_3/{param}','User@showGraph_3');

Route::get('/master/company','CompanyInfoController@index');

Route::get('/master/user','User@listData');
Route::get('/master/user/add_data','User@addData');
Route::get('/master/user/edit_data/{id}','User@editData');

Route::get('/master/client','ClientInfoController@index');
Route::get('/master/client/add_data','ClientInfoController@addData');
Route::get('/master/client/edit_data/{id}','ClientInfoController@editData');

Route::get('/master/group','GroupInfoController@index');
Route::get('/master/group/add_data','GroupInfoController@addData');
Route::get('/master/group/edit_data/{id}','GroupInfoController@editData');

Route::get('/master/area','AreaInfoController@index');
Route::get('/master/area/add_data','AreaInfoController@addData');
Route::get('/master/area/edit_data/{id}','AreaInfoController@editData');

Route::get('/master/jabatan','JabatanInfoController@index');
Route::get('/master/jabatan/add_data','JabatanInfoController@addData');
Route::get('/master/jabatan/edit_data/{id}','JabatanInfoController@editData');

Route::get('/master/departemen','DepartemenInfoController@index');
Route::get('/master/departemen/add_data','DepartemenInfoController@addData');
Route::get('/master/departemen/edit_data/{id}','DepartemenInfoController@editData');

Route::get('/master/level','LevelInfoController@index');
Route::get('/master/level/add_data','LevelInfoController@addData');
Route::get('/master/level/edit_data/{id}','LevelInfoController@editData');

Route::get('/master/role','RoleInfoController@index');
Route::get('/master/role/add_data','RoleInfoController@addData');
Route::get('/master/role/edit_data/{id}','RoleInfoController@editData');

Route::get('/master/employee','EmployeeInfoController@index');
Route::get('/master/employee/add_data','EmployeeInfoController@addData');
Route::get('/master/employee/edit_data/{id}','EmployeeInfoController@editData');

Route::get('/master/cost','CostInfoController@index');
Route::get('/master/cost/add_data','CostInfoController@addData');
Route::get('/master/cost/edit_data/{id}','CostInfoController@editData');

Route::get('/master/areacost','AreaCostInfoController@index');
Route::get('/master/areacost/add_data','AreaCostInfoController@addData');
Route::get('/master/areacost/edit_data/{id}','AreaCostInfoController@editData');

Route::get('/master/set_document','SettingDocumentInfoController@index');
Route::get('/master/set_document/add_data','SettingDocumentInfoController@addData');
Route::get('/master/set_document/edit_data/{id}','SettingDocumentInfoController@editData');