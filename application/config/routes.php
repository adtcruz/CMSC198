<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//routes for API
$route['add_materials_used'] = 'Add_materials_used_controller';
$route['add_work_done'] = 'Add_work_done_controller';
$route['cancel_job'] = 'Cancel_job_controller';
$route['create_account'] = 'Create_account_controller';
$route['delete_materials_used'] = 'Delete_materials_used_controller';
$route['delete_work_done'] = 'Delete_work_done_controller';
$route['edit_job'] = 'Edit_job_description_controller';
$route['get_office_users'] = 'Get_office_users_controller';
$route['get_job_description'] = 'Get_job_description_controller';
$route['get_job_request_contents'] = 'Get_job_request_contents_controller';
$route['get_logs'] = 'Get_logs_controller';
$route['get_materials_options'] = 'Get_materials_options_controller';
$route['get_materials_used'] = 'Get_materials_used_controller';
$route['get_schedule_job_form'] = 'Get_schedule_job_form_controller';
$route['get_technicians'] = 'Get_technicians_controller';
$route['get_user_type'] = 'Get_user_type_controller';
$route['get_work_done'] = 'Get_work_done_controller';
$route['get_work_options'] = 'Get_work_options_controller';
$route['login'] = 'Login_controller';
$route['logout'] = 'Logout_controller';
$route['mark_as_done'] = 'Mark_as_done_controller';
$route['schedule_job'] = 'Schedule_job_controller';
$route['submit_request'] = 'Submit_job_request_controller';
$route['update_materials_used'] = 'Update_materials_used_controller';
$route['update_password'] = 'Update_password_controller';
$route['update_priority'] = 'Update_job_priority_controller';
$route['update_profile'] = 'Update_profile_controller';
//routes for page loads
$route['new_account'] = 'New_account_controller';
$route['job_requests'] = 'Job_requests_controller';
$route['manage_application'] = 'Manage_application_controller';
$route['manage_accounts'] = 'Manage_accounts_controller';
$route['view_schedule'] = 'View_schedule_controller';
$route['add_client'] = 'Add_client_controller';
$route['view_logs'] = 'View_user_logs_controller';
$route['my_account'] = 'My_account_controller';
$route['topdf_bfp/(:any)'] = 'Bill_for_payment_controller';
$route['generate_bill'] = 'Generate_bill_controller';
$route['topdf_jrf'] = 'JobRequestForm_controller';
$route['default_controller'] = 'Home_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
