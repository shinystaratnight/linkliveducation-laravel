<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
	
    Route::get('/', 'IndexController@index');
    Route::post('login', 'IndexController@postLogin');  
    Route::get('logout', 'IndexController@logout');
    Route::get('dashboard', 'DashboardController@index');

    //*********admin profile routes***************//
    Route::get('profile', 'AdminController@profile');	
    Route::post('profile', 'AdminController@updateProfile');	
    Route::post('profile_pass', 'AdminController@updatePassword');

    //*********settings routes***************//
    Route::get('settings', 'SettingsController@settings');	
    Route::post('settings', 'SettingsController@settingsUpdates');
    Route::post('homepage_settings', 'SettingsController@homepage_settings');	
    Route::post('aboutus_settings', 'SettingsController@aboutus_settings');

    Route::post('services', 'SettingsController@services');
    Route::post('pricing', 'SettingsController@pricing');

    Route::post('contactus_settings', 'SettingsController@contactus_settings');
    Route::post('terms_of_service', 'SettingsController@terms_of_service');
    Route::post('privacy_policy', 'SettingsController@privacy_policy');
    Route::post('help', 'SettingsController@help');
    Route::post('cookies_policy', 'SettingsController@cookies_policy');
    Route::post('addthisdisqus', 'SettingsController@addthisdisqus');	
    Route::post('headfootupdate', 'SettingsController@headfootupdate');

    //*********users routes***************//
    Route::get('users', 'UsersController@userslist');

    //***********Course Categories Start*************//
    Route::get('pages/add_course_category', 'CategoriesController@category');
    Route::post('pages/add_course_category', 'CategoriesController@add_study_mat_category');
    Route::get('pages/course_category', 'CategoriesController@show_study_mat_category');
    Route::post('edit_course_category', 'CategoriesController@add_study_mat_category');
    Route::get('delete_course_category/{id}', 'CategoriesController@study_mat_category_delete');

    Route::post('edit_course_subcategory', 'SubCategoriesController@add_study_mat_subcategory');
    Route::post('delete_course_subcategory', 'SubCategoriesController@study_mat_subcategory_delete');
    Route::get('pages/add_course_subcategory', 'SubCategoriesController@subcategory');
    Route::post('pages/add_course_subcategory', 'SubCategoriesController@add_study_mat_subcategory');
    Route::get('pages/course_subcategory', 'SubCategoriesController@show_study_mat_subcategory');
    Route::get('pages/studymatCategory', 'SubCategoriesController@studymatCategory');
    //***********Course Categories End*************//
    
    //***********Course Categories Start*************//
    Route::get('pages/add_test_category', 'CategoriesController@testcategory');
    Route::post('pages/add_test_category', 'CategoriesController@add_test_category');
    Route::get('pages/test_category', 'CategoriesController@show_test_category');
    Route::post('edit_test_category', 'CategoriesController@add_test_category');
    Route::get('delete_test_category/{id}', 'CategoriesController@test_category_delete');

    Route::post('edit_test_subcategory', 'SubCategoriesController@add_test_subcategory');
    Route::post('delete_test_subcategory', 'SubCategoriesController@test_subcategory_delete');
    Route::get('pages/add_test_subcategory', 'SubCategoriesController@testsubcategory');
    Route::post('pages/add_test_subcategory', 'SubCategoriesController@add_test_subcategory');
    Route::get('pages/test_subcategory', 'SubCategoriesController@show_test_subcategory');
    Route::get('pages/testCategory', 'SubCategoriesController@testCategory');
    //***********Course Categories End*************//
    
    //***********Test Start*************//


//    Route::resource('/test', 'TestController');
    Route::get('/test/create', 'TestController@create');
    Route::post('/test/store', 'TestController@store');
    Route::get('/tests', 'TestController@index');
    Route::get('/test/addQuestion', 'TestController@addQuestion');
    Route::get('/getSubs/{id}', 'TestController@getSubs');
    Route::get('/questions/{id}', 'TestController@questions')->name('questions');
    Route::get('/questionUpdate/{id}', 'TestController@edit')->name('questionUpdate');
    Route::patch('/questionUpdated/{id}', 'TestController@update')->name('questionUpdated');
    Route::delete('/questionDelete/{id}', 'TestController@destroy')->name('questionDelete');
    Route::delete('/testDelete/{id}', 'TestController@destroyTest')->name('testDelete');
    Route::get('/results', 'TestController@results')->name('results');
    Route::get('/addQuestion/{id}', 'TestController@anotherQuestion')->name('anotherQuestion');
    Route::post('/question/store', 'TestController@storeQuestion');
    Route::get('/quizUpdate/{id}', 'TestController@quizUpdate')->name('quizUpdate');
    Route::patch('/quizUpdated/{id}', 'TestController@quizUpdated')->name('quizUpdated');
    //***********Test End*************//

    //***********categories of video*************//
    Route::get('pages/video', 'VideoController@video');
    Route::post('pages/addvideo', 'VideoController@getvideo');
    Route::get('pages/allvideos', 'VideoController@allvideo');
    Route::get('pages/videow', 'VideoController@selectcat');
    Route::get('pages/edit_video/{id}', 'VideoController@editvideo');
    Route::get('pages/delete_video/{id}', 'VideoController@deletevideo');
    Route::get('pages/deletevideo/{allvideo}/{id}', 'VideoController@delete_video');
    //***********categories of video*************//
    Route::get('vlog', 'VideoController@vlog');
    Route::post('vlog', 'VideoController@getvlog');
    Route::get('allvlog', 'VideoController@allvlog');
    Route::get('edit_vlog/{id}', 'VideoController@editvlog');
    Route::get('delete_vlog/{id}', 'VideoController@deletevlog');
    
    //***********Orders*************//
    Route::get('orders', 'VideoController@orders');
});

/*front end rooting*/
Route::get('/', 'IndexController@index');
Route::get('services', 'IndexController@services');
Route::get('about', 'IndexController@about');
Route::get('vlog', 'IndexController@vlog');
Route::get('contact', 'IndexController@contact');
Route::post('contact', 'IndexController@contact_us');
Route::get('faq', 'IndexController@faq');
Route::get('partner', 'IndexController@partner');
Route::post('register', 'IndexController@postRegister');
Route::get('signin', 'IndexController@signin');
Route::post('login', 'IndexController@postLogin');
Route::get('logout', 'IndexController@logout');
Route::get('check_email', 'IndexController@check_email');
Route::get('check_username', 'IndexController@check_username');
Route::get('check_phone', 'IndexController@check_phone');
Route::get('video-courses/{id}/{name}', 'IndexController@video_courses');
Route::get('view-course/{id}/{name}', 'IndexController@video_courses_subcategory');

Route::get('profile', 'UsersController@profile')->name('userProfile');
Route::post('edit_user_info', 'UsersController@edit_user_info');
Route::get('states', 'UsersController@states');
Route::post('profile_pic', 'UsersController@profile_pic');
Route::post('cover_pic', 'UsersController@cover_pic');
Route::get('videos', 'UsersController@user_videos');
Route::post('video_questions', 'UsersController@video_questions');
Route::post('post_answer', 'UsersController@post_answer');
Route::get('course-videos/{id}/{name}', 'UsersController@course_videos');
Route::get('watch-video/{id}/{name}', 'UsersController@watch_videos');

Route::get('success', 'PaymentController@success');
Route::get('failure', 'PaymentController@failure');
Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'PaymentController@status']);
Route::post('buy-course', 'PaymentController@buy_course');



Route::get('/subCategories/{id}', 'CertificationController@categories');
Route::get('/tests/{id}', 'CertificationController@tests')->name('tests');
Route::get('/testDetails/{id}', 'CertificationController@details')->name('details');
Route::get('/user_tests', 'CertificationController@user_tests')->name('user_tests');
Route::get('/results', 'CertificationController@user_results');
Route::get('/test/{id}', 'CertificationController@giveTest')->name('giveTest');
Route::get('/buyNow/{id}', 'CertificationController@buyNow')->name('buyNow');
Route::post('saveMarks', 'QuizApiController@store')->name('saveMarks');

Route::post('/saveInfo', 'CertificationController@store');
Route::get('/getStates/{id}', 'CertificationController@getStates');