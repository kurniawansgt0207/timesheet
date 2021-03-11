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

Route::post('/master/user/store','User@storeData');
Route::get('/master/user/delete/{id}','User@delete_data');

Route::post('/master/client/store','ClientInfoController@storeData');
Route::get('/master/client/delete/{id}','ClientInfoController@delete_data');

Route::post('/master/group/store','GroupInfoController@storeData');
Route::get('/master/group/delete/{id}','GroupInfoController@delete_data');

Route::post('/master/area/store','AreaInfoController@storeData');
Route::get('/master/area/delete/{id}','AreaInfoController@delete_data');

Route::post('/master/jabatan/store','JabatanInfoController@storeData');
Route::get('/master/jabatan/delete/{id}','JabatanInfoController@delete_data');

Route::post('/master/departemen/store','DepartemenInfoController@storeData');
Route::get('/master/departemen/delete/{id}','DepartemenInfoController@delete_data');

Route::post('/master/level/store','LevelInfoController@storeData');
Route::get('/master/level/delete/{id}','LevelInfoController@delete_data');

Route::post('/master/role/store','RoleInfoController@storeData');
Route::get('/master/role/delete/{id}','RoleInfoController@delete_data');

Route::post('/master/employee/store','EmployeeInfoController@storeData');
Route::get('/master/employee/delete/{id}','EmployeeInfoController@delete_data');

Route::post('/master/cost/store','CostInfoController@storeData');
Route::get('/master/cost/delete/{id}','CostInfoController@delete_data');

Route::post('/master/areacost/store','AreaCostInfoController@storeData');
Route::get('/master/areacost/delete/{id}','AreaCostInfoController@delete_data');

Route::post('/master/set_document/store','SettingDocumentInfoController@storeData');
Route::get('/master/set_document/delete/{id}','SettingDocumentInfoController@delete_data');