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
	$this->post('/client_list', 'API\AuthController@client_list');
	$this->get('/importExcel', 'ImportExcelDataController@importExcel');
	$this->get('/backgroundWork', 'ImportExcelDataController@backgroundWork');
	$this->get('/flipbook/{id}', 'FlipbookDataController@flipbook');
    $this->post('/flipbook/fetchFlipData', 'FlipbookDataController@fetchFlipData');
    Route::get('/download/{filename}', function($filename)
     {
	 $publicpath=public_path();
		
	 $file_path = $publicpath.'/pdf/'.$filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        $errorMessage="File does not exist unable generate file";
		return Redirect::back()->withErrors(['message', "$errorMessage"]);
    }
	
	});


	
	//$this->get('/auth', 'API\AuthController@checkUser');


	Route::group(['middleware' => ['web']], function () {
		
		
   	$this->get('/generateDoc/{id}', 'DocController@generateDoc');


	$this->get('/generateHtmlPreview/{id}', 'HtmlPreviewPdfController@generateHtmlPreview')->middleware('revalidate');
	$this->get('/generatePdfPreview/{id}', 'PdfPreviewPdfController@generatePdfPreview');

	
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
	
	$this->get('/dashboard', 'DashboardController@index')->middleware('revalidate');


	route::get('loginsample','Auth\AuthController@check');

	//Add User Routes
	$this->get('/adduser', 'DashboardController@showUserForm')->middleware('revalidate');
	$this->post('/adduser', 'DashboardController@adduser')->middleware('revalidate');

	//list user Routed
	$this->get('/userlist', 'DashboardController@listUserForm')->middleware('revalidate');
	
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
	$this->get('/pdflist', 'PdfController@pdflist')->middleware('revalidate');
	$this->get('/fileGenerate', 'PdfController@fileGenerate');
	$this->get('/generate', 'PdfController@generate');
	$this->get('/fileview', 'PdfController@fileview');
	$this->get('/download', 'PdfController@download');
	$this->get('/listdelete/{id}','PdfController@listdelete');
	$this->post('/changeimage/{id}', 'PdfController@changeimage');
	$this->post('/galleryupload/{id}', 'PdfController@galleryupload');	
    $this->get('/form','FormController@index');
    $this->post('/getzip','FormController@checkUser');
	//Route::post('/galleryupload/{id}', 'PdfController@galleryupload');
	$this->get('/emailcheck/{email}', 'DashboardController@checkemail');
	$this->get('/phonecheck/{phone}', 'DashboardController@checkphone');

	$this->post('/updateemailcheck/{id}', 'DashboardController@updatecheckemail');
	$this->post('/updatephonecheck/{id}', 'DashboardController@updatephonecheck');
});
