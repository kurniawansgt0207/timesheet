<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/changePassword','User@changePassword');
Route::post('/loginPost', 'User@loginPost');

Route::post('/kirimEmail','NotifikasiEmailController@sendEmailNotifikasiSingle');
Route::get('/kirimEmail2','NotifikasiEmailController@kirimEmailAuto');
Route::post('/kirimEmail3','NotifikasiEmailController@kirimEmailAuto');
Route::post('/kirimEmailMulti','NotifikasiEmailController@readKirimEmail');

Route::post('/ldap_get','User@get');
Route::post('/ldap_get_2','User@get_ldap');

Route::post('/auto_closed_ticket','TicketingController@autoClosedTicket');

Route::post('/master/company/store','CompanyInfoController@store_data');
Route::post('/master/client/store','ClientInfoController@storeData');
Route::get('/master/client/delete/{id}','ClientInfoController@delete_data');

Route::post('/modul/store','MasterModulController@store_data');
Route::get('/modul/{id}','MasterModulController@delete_data');

Route::post('/group/store','RoleGroupController@store_data');
Route::post('/group_access/store','RoleGroupDetailController@store_data');
Route::get('/group_access/{id}','RoleGroupDetailController@delete_data');

Route::post('/data_pekerja/store','DataPekerjaController@store_data');
Route::post('/data_pekerja/sync','DataPekerjaController@syncData');
Route::post('/data_pekerja/update_profil','DataPekerjaController@update_profil');

Route::post('/mitra_kerja/store','MitraKerjaController@store_data');
Route::post('/mitra_kerja/sync','MitraKerjaController@syncData');

Route::get('/kategori_layanan/list_data','KategoriLayananController@list_data');
Route::post('/kategori_layanan/store','KategoriLayananController@store_data');
Route::get('/kategori_layanan/{id}','KategoriLayananController@delete_data');

Route::post('/ticketing/request/store','TicketingRequestController@store_data');
Route::get('/ticketing/request/{id}','TicketingRequestController@delete_data');
Route::post('/ticketing/request/save','TicketingRequestController@save_data');
Route::post('/ticketing/request/confirmation','TicketingRequestController@confirmation');
Route::get('/ticketing/request/delete_file/{id}/{no}','TicketingRequestController@delete_file');

Route::post('/ticketing/assign/store','TicketingAssignController@update_data');

Route::post('/ticketing/approval/store','TicketingApprovalController@update_data');

Route::post('/ticketing/all_activity/store','TicketingController@update_data');
Route::get('/ticketing/all_activity/delete_file/{id}/{no}','TicketingController@delete_file');
