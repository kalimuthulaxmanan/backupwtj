<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

	$this->post('/send_client_info', 'API\AuthController@checkUser');
	$this->get('/importExcel', 'ImportExcelDataController@importExcel');
	$this->get('/backgroundWork', 'ImportExcelDataController@backgroundWork');
	$this->get('/flipbook', 'FlipbookDataController@flipbook');




	//$this->get('/auth', 'API\AuthController@checkUser');

Route::group(['middleware' => ['web']], function () {
	
		$this->get('/generateHtmlPreview', 'HtmlPreviewPdfController@generateHtmlPreview');

	
	$this->get('/', 'Auth\AuthController@showLoginForm')->middleware('revalidate');

	$this->get('login', 'Auth\AuthController@showLoginForm')->middleware('revalidate');
	$this->get('forgetpassword', 'Auth\AuthController@showForGetPassword')->middleware('revalidate');
	$this->post('forgetpassword', 'Auth\AuthController@resetpassword')->middleware('revalidate');
	

	$this->post('login', 'Auth\AuthController@login');
	$this->get('logout', 'DashboardController@logout');

	// Registration Routes...
	//$this->get('register', 'Auth\AuthController@showRegistrationForm');
	//$this->post('register', 'Auth\AuthController@registeruser');

	// Password Reset Routes...
	$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	$this->post('password/reset', 'Auth\PasswordController@reset');
	
	$this->get('/dashboard', 'DashboardController@index');


	route::get('loginsample','Auth\AuthController@check');

	//Add User Routes
	$this->get('/user', 'DashboardController@showUserForm')->middleware('revalidate');
	$this->post('/adduser', 'DashboardController@adduser')->middleware('revalidate');

	//list user Routed
	$this->get('/list', 'DashboardController@listUserForm')->middleware('revalidate');
	
	//Edit the User Routes
	$this->get('/useredit/{id}', 'DashboardController@showuseredit');
	$this->post('/updateuser/{id}', 'DashboardController@updateuser');

	//Delete the User Routes
	$this->get('/userdelete/{id}', 'DashboardController@userdelete')->middleware('revalidate');

	//userprofile and change password
	$this->get('/changepassword','DashboardController@showChangePassword')->middleware('revalidate');
	$this->post('/savepassword', 'DashboardController@savePassword')->middleware('revalidate');

	//user and edit profile view
	$this->get('/viewprofile','DashboardController@showViewProfile')->middleware('revalidate');
	$this->get('/profileedit/{id}', 'DashboardController@showProfileedit');
	$this->post('/updateprofile/{id}', 'DashboardController@updateprofile');



	//viewpdf file list
	$this->get('/pdflist', 'PdfController@pdflist');
	$this->get('/fileGenerate', 'PdfController@fileGenerate');
	$this->get('/generate', 'PdfController@generate');
	$this->get('/fileview', 'PdfController@fileview');
	$this->get('/download', 'PdfController@download');
	$this->get('/listdelete/{id}','PdfController@listdelete');
	//Route::get('download', 'TestController@download');
});
