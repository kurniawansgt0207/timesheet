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

Route::get('/master/modul','MasterModulController@showAll');
Route::get('/master/modul/add_data','MasterModulController@add_data');
Route::get('/master/modul/edit_data/{id}','MasterModulController@edit_data');

Route::get('/master/group/add_data','RoleGroupController@add_data');

Route::get('/master/group_access','RoleGroupDetailController@showAll');
Route::get('/master/group_access/edit_data/{id}','RoleGroupDetailController@edit_data');

Route::get('/master/kategori_layanan','KategoriLayananController@index');
Route::get('/master/kategori_layanan/add_data','KategoriLayananController@add_data');
Route::get('/master/kategori_layanan/edit_data/{id}','KategoriLayananController@edit_data');

Route::get('/master/data_pekerja','DataPekerjaController@index');
Route::get('/master/data_pekerja/add_data','DataPekerjaController@add_data');
Route::get('/master/data_pekerja/list/{keyword}','DataPekerjaController@list_data');
Route::get('/master/data_pekerja/edit_data/{id}','DataPekerjaController@edit_data');
Route::get('/master/data_pekerja/profil/{nopek}','DataPekerjaController@profil');
Route::get('/master/data_pekerja/cek_pass/{nopek}/{pass}','DataPekerjaController@cek_password');

Route::get('/master/mitra_kerja','MitraKerjaController@index');
Route::get('/master/mitra_kerja/add_data','MitraKerjaController@add_data');
Route::get('/master/mitra_kerja/list/{keyword}','MitraKerjaController@list_data');
Route::get('/master/mitra_kerja/edit_data/{id}','MitraKerjaController@edit_data');

Route::get('/master/email_status/{param}','MailTicketingController@list_data');

Route::get('/ticketing/request','TicketingRequestController@index');
Route::get('/ticketing/request/add_data','TicketingRequestController@add_data');
Route::get('/ticketing/request/edit_data/{id}','TicketingRequestController@edit_data');
Route::get('/ticketing/request/view_data/{id}','TicketingRequestController@view_data');

Route::get('/ticketing/assign','TicketingAssignController@index');
Route::get('/ticketing/assign/{id}','TicketingAssignController@assign_data');
Route::get('/ticketing/assign/download/{file}','TicketingAssignController@downloadFile');

Route::get('/ticketing/approval','TicketingApprovalController@index');
Route::get('/ticketing/approval/{id}','TicketingApprovalController@approval_data');

Route::get('/ticketing/all_activity','TicketingController@index');
Route::get('/ticketing/all_activity/{id}','TicketingController@activity_data');

Route::get('/reporting/claim_per_day/{param}','ReportingController@claim_per_day');
Route::get('/reporting/per_category/{param}','ReportingController@per_category');

Route::get('/kirimemail/{email}','NotifikasiEmailController@index');
Route::get('/sendmail/{id}','NotifikasiEmailController@sendEmail');

Route::get('coba', 'NotifikasiEmailController@kirim_email');