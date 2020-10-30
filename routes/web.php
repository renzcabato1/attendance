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

Route::get('/','AccountController@login');
Route::post('/', 'AccountController@try_login');
Route::post('/login-a', 'AccountController@try_login');
Auth::routes();
Route::get('/view/{id}','LaborersController@view');
Route::get('/load-data','LaborersController@load_data');
Route::group( ['middleware' => 'auth'], function()
{
Route::get('/report', 'AttendanceController@view_attendance');
Route::get('/attendance', 'AttendanceController@view_record');
Route::get('/devices', 'DeviceController@view_device');
Route::get('/schedules', 'ScheduleController@view_schedule');
Route::get('/new-schedule', 'ScheduleController@new_schedule');
Route::post('/new-schedule', 'ScheduleController@save_new_schedule');
Route::get('/user-account', 'AccountController@useraccount');
Route::post('/change-password', 'AccountController@change_password');
Route::post('/edit-user/{id}', 'AccountController@edit_user');
Route::get('/reset-account/{id}', 'AccountController@reset_account');
Route::post('/new-account', 'AccountController@new_account');
Route::post('/edit-user/{id}', 'AccountController@edit_user'); 
Route::post('/edit-laborer/{id}', 'LaborersController@save_edit_laborer'); 
Route::get('laborers','LaborersController@laborers', ['name' => 'laborers']);
Route::get('/get-image', 'LaborersController@getImage');
Route::post('/new-laborer', 'LaborersController@new_laborer');
Route::get('/department', 'DepartmentController@department_view');
Route::post('/new-department', 'DepartmentController@new_department');
Route::post('/edit-department/{id}', 'DepartmentController@save_edit_department');
Route::post('/edit-schedule/{id}', 'ScheduleController@save_edit_schedule');
Route::get('/delete-schedule/{id}', 'ScheduleController@delete_schedule');
Route::get('/delete-attendance/{id}', 'AttendanceController@delete_attendance');
Route::get('/delete-remarks/{id}', 'VerificationController@delete_remarks');
Route::post('/add-schedule', 'ScheduleController@add_schedule');
Route::post('/add-attendance', 'AttendanceController@add_new_attendance');
Route::post('/edit-attendance/{id}', 'AttendanceController@save_edit_attendance');
Route::post('/approve-ot/{id}', 'AttendanceController@approved_ot');
Route::get('/for-verification', 'AttendanceController@for_verification');
Route::get('/generate-laborer', 'LaborersController@generate_laborer');
Route::post('/add-remarks', 'VerificationController@add_remarks_verification');
Route::post('/save-edit-remarks/{id}', 'VerificationController@save_edit_remarks');
Route::post('/verification', 'VerificationController@verification');
Route::get('/home', function () {return view('show');});
Route::get('/login-a', 'AttendanceController@view_attendance');
Route::get('/device-generate','DeviceController@generate_devices');
Route::get('/ap','AttendanceController@ap', ['name' => 'ap']);
Route::get('/print-ap','AttendanceController@ap_pdf_report');

Route::get('/payments','PaymentController@payment_view');
Route::get('/rates-for-approval','PaymentController@for_approval');
Route::post('/edit-salary','PaymentController@edit_salary');
Route::post('/new-rate','PaymentController@new_rate');
Route::post('/approve-rate/{id}','PaymentController@add_salary');
Route::get('/rate-for-approval','PaymentController@for_approval');



Route::get('/manpower','ManpowerController@manpower_view');
Route::post('/new-manpower','ManpowerController@new_manpower');
Route::post('/edit-manpower/{id}','ManpowerController@edit_manpower');
Route::post('/approved/{id}','ManpowerController@approved_manpower');
Route::get('/cancel-request/{id}','ManpowerController@cancel_request');
Route::post('/cancelled_manpower/{id}','ManpowerController@cancelled_request');
Route::get('for-approval','ManpowerController@for_approval');
Route::get('overtime-manpower','OvertimeController@overtime_manpower');
Route::get('overtime','OvertimeController@for_approval_overtime');
Route::get('deactivate-account/{user_id}','AccountController@deactivate_account');
Route::get('activate-account/{user_id}','AccountController@activate_account');

Route::get('/holidays','HolidayController@view_holidays');
Route::post('/new-holiday','HolidayController@new_holiday');
Route::get('/delete-holiday/{id}','HolidayController@delete_holiday');
Route::post('/edit-holiday/{id}','HolidayController@edit_holiday');

Route::get('get-date-range','AttendanceController@date_range');


Route::get('delete-ot-request/{id}','OvertimeController@delete_ot_request');
Route::get('can-file-ots','OvertimeController@can_file_ots');
Route::post('new-file-ot','OvertimeController@new_file_ot');
Route::post('edit-ot-request/{id}','OvertimeController@save_edit_request');
Route::post('new-ot-request','OvertimeController@new_ot_request');
Route::post('approved_ot/{id}','OvertimeController@approved_ot');
Route::post('cancell_ot/{id}','OvertimeController@cancel_ot');


Route::post('edit-device/{id}','DeviceController@edit_device');

Route::get('positions','WorkController@work');
Route::post('new-position','WorkController@new_position');
Route::post('/edit-position/{id}','WorkController@edit_position');
Route::get('/get-laborer-details','LaborersController@view_laborers');
Route::get('/get-laborers-ot','LaborersController@view_laborers_ot');


Route::get('/company', 'CompanyController@company_view');
Route::post('/new-company', 'CompanyController@new_company');
Route::post('/edit-company/{id}', 'CompanyController@save_edit_company');
Route::get('get-data','CompanyController@get_data');

Route::get('generate-ap','AttendanceController@generateAp');
Route::get('generates','AttendanceController@generates');
Route::post('save-remarks/{generateId}','AttendanceController@saveEditGenerate');
Route::get('payroll-reports','AttendanceController@payrollReports');
Route::get('payroll-report-print','AttendanceController@payroll_report_pdf');
Route::get('monitoring','AttendanceController@monitoring', ['name' => 'monitoring']);


Route::get('print_id_laborer/{laborer}','LaborersController@printID');
Route::get('generate','AttendanceController@generate_records');
Route::post('generate-all','AttendanceController@generateAll');
Route::get('get-schedule','AttendanceController@scheduleall');


Route::get('test','LaborersController@testapi');
}
);