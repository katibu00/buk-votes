<?php

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\ElcomController;
use App\Http\Controllers\ElectComController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\Settings\AssignController;
use App\Http\Controllers\Settings\DepartmentController;
use App\Http\Controllers\Settings\FacultyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

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

//front end routes
Route::get('/', [FrontController::class, 'home']);
Route::get('/home', [FrontController::class, 'home'])->name('home');

Route::get('/official-list/{id}', [FrontController::class, 'offcial'])->name('official.list');
Route::get('/documentation', [FrontController::class, 'documentation'])->name('user.guide');
Route::get('/download/student', [FrontController::class, 'downloadStudent'])->name('download.doc.student');
Route::get('/download/candidate', [FrontController::class, 'downloadCandidate'])->name('download.doc.candidate');
Route::get('/download/elcom', [FrontController::class, 'downloadElcom'])->name('download.doc.elcom');

Route::get('/register/student_affairs', [RegisterController::class, 'index'])->name('register');
Route::post('/register/student_affairs', [RegisterController::class, 'store']);

Route::post('/users/delete', [UserController::class, 'delete'])->name('user.delete');
Route::post('/users/change_password', [UserController::class, 'password'])->name('user.password');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/voter/login', [LoginController::class, 'voter_index'])->name('voter.login');
Route::post('/voter/login', [LoginController::class, 'voter_login']);

Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

//home routes
Route::group(['middleware' => ['auth']], function(){
    Route::get('/student-affairs/home', [HomeController::class, 'admin'])->name('admin.home');
    Route::get('/elcom/home', [HomeController::class, 'elcom'])->name('elcom.home');
    Route::get('/candidate/home', [HomeController::class, 'candidate'])->name('candidate.home');
    Route::get('/student', [HomeController::class, 'voter'])->name('voter.home');
    Route::get('/voter', [HomeController::class, 'voterAlert'])->name('voter.homeAlert');
});


//student affairs and admin routes
Route::group(['middleware' => ['auth']], function(){
    Route::resource('faculty', FacultyController::class);
    Route::get('faculty/delete/{id}',[FacultyController::class, 'destroy'])->name('faculty.delete');

    Route::resource('department', DepartmentController::class);
    Route::get('department/delete/{id}',[DepartmentController::class, 'destroy'])->name('department.delete');

    Route::get('/assign-department/index',[AssignController::class, 'department_index'])->name('assign.index');
    Route::post('/assign-department/reset/{id}',[AssignController::class, 'department_reset'])->name('assign.delete');
    Route::get('/assign-department/create',[AssignController::class, 'department_create'])->name('assign.department');
    Route::post('/assign-department/store',[AssignController::class, 'department_store'])->name('assign.department.store');

    Route::resource('election', ElectionController::class);
    Route::post('election/delete/{id}',[ElectionController::class, 'destroy'])->name('election.delete');

    Route::resource('elcom', ElcomController::class);
    Route::get('elcom/delete/{id}',[ElcomController::class, 'destroy'])->name('elcom.delete');

    Route::resource('posts', PostController::class);
    Route::get('posts/delete/{id}',[PostController::class, 'destroy'])->name('posts.delete');

    Route::resource('clubs', ClubsController::class);
    Route::get('clubs/delete/{id}',[ClubsController::class, 'destroy'])->name('clubs.delete');

    Route::resource('associations', AssociationController::class);
    Route::get('associations/delete/{id}',[AssociationController::class, 'destroy'])->name('associations.delete');


    Route::get('forms/index',[FormsController::class, 'index'])->name('forms.index');
    Route::get('generate/form/index/{id}',[FormsController::class, 'form_generate'])->name('generate.form.index');
    Route::get('generate/form/sra/index/{id}',[FormsController::class, 'form_generate_sra'])->name('generate.form.sra.index');
    Route::post('forms/generate/store',[FormsController::class, 'form_store'])->name('generate.form.store');
    Route::post('forms/sra/generate/store/{id}',[FormsController::class, 'form_store_sra'])->name('generate.form.sra.store');
    Route::post('forms/sra/generate/update/{id}',[FormsController::class, 'form_update_sra'])->name('generate.form.sra.update');

    Route::get('forms/exco/edit/{id}',[FormsController::class, 'form_edit_exco'])->name('form.edit.exco');
    Route::get('forms/sra/edit/{id}',[FormsController::class, 'form_edit_sra'])->name('form.edit.sra');
    Route::post('forms/exco/update/{id}',[FormsController::class, 'form_update_exco'])->name('form.update.exco');
    Route::post('forms/exco/delete/{id}',[FormsController::class, 'delete_exco'])->name('forms.delete.exco');
    Route::post('forms/sra/delete/{id}',[FormsController::class, 'delete_sra'])->name('forms.delete.sra');


    Route::get('interests',[FormsController::class, 'my_interests'])->name('interests.index');


    Route::get('users/index',[UserController::class, 'index'])->name('users.index');
    Route::post('forms/generate/store',[FormsController::class, 'form_store'])->name('generate.form.store');

    Route::post('elcom/make/{id}',[UserController::class, 'make_elcom'])->name('make.elcom');

    Route::get('users/student_affairs/index',[UserController::class, 'SAindex'])->name('users.sa.index');
    Route::get('users/candidates/index',[UserController::class, 'Candidateindex'])->name('users.candidate.index');
    Route::post('elcom/dissolce',[ElectComController::class, 'dissolve'])->name('elcom.dissolve');

});

//any authenticated user routes

Route::group(['middleware' => ['auth']], function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/onsale', [FormsController::class, 'onsale'])->name('onsale.index');
    Route::post('/contest', [FormsController::class, 'contest'])->name('form.contest');
    Route::post('/contest/sra', [FormsController::class, 'contest_sra'])->name('form.contest.sra');

    Route::get('/user/details/{id}', [ProfileController::class, 'details'])->name('user.details');
});


//home routes
Route::group(['middleware' => ['auth']], function(){
    Route::post('/send-code', [AuthenticationController::class, 'send'])->name('authenticate.send');
    Route::post('/verify-code', [AuthenticationController::class, 'verify'])->name('authenticate.verify');


    Route::get('/cast-vote/index', [VoteController::class, 'index'])->name('cast.vote');
    Route::post('/cast-vote', [VoteController::class, 'index'])->name('vote.search');


    Route::post('/cast-vote/submit', [VoteController::class, 'submit'])->name('cast.submit');

    Route::get('/live-result', [ResultController::class, 'live'])->name('live.result');
    Route::post('/live-result/index', [ResultController::class, 'live'])->name('live.result.search');

    Route::get('/live-result/sra', [ResultController::class, 'livesra'])->name('live.result.sra');
    Route::post('/live-result/sra/index', [ResultController::class, 'livesra'])->name('live.result.search.sra');

});

//sales routes
Route::group(['middleware' => ['auth']], function(){

    Route::get('/form/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('/form/search', [SalesController::class, 'search'])->name('sales.search');
    Route::post('/form/payment', [SalesController::class, 'payment_exco'])->name('sales.payment');
    Route::post('/form/payment/sra', [SalesController::class, 'payment_sra'])->name('sales.payment.sra');

    Route::post('/form/qualify/sra', [SalesController::class, 'qualify_sra'])->name('sales.qualify.sra');
    Route::post('/form/qualify/exco', [SalesController::class, 'qualify_exco'])->name('sales.qualify.exco');

});


//return routes
Route::group(['middleware' => ['auth']], function(){

    Route::get('/return/exco', [ResultController::class, 'return_exco'])->name('return.exco');
    Route::post('/return/exco/index', [ResultController::class, 'return_exco'])->name('return.exco.search');
    Route::post('/return/exco', [ResultController::class, 'return_exco_store'])->name('return.exco');

    Route::get('/return/sra', [ResultController::class, 'return_sra'])->name('return.sra');
    Route::post('/return/sra/index', [ResultController::class, 'return_sra'])->name('return.sra.search');
    Route::post('/return/sra', [ResultController::class, 'return_sra_store'])->name('return.sra');


    Route::get('/return/certificate', [ResultController::class, 'certificate_index'])->name('certificate.return');
    Route::get('/return/certificate/download', [ResultController::class, 'certificate_download'])->name('certificate.download');

    Route::get('/timetable', [FrontController::class, 'timetable'])->name('timetable.index');
    Route::get('/timetable/index', [FrontController::class, 'timetable_back'])->name('timetable.backend');


    Route::get('/report/sales', [ReportController::class, 'sales_index'])->name('report.sales');
    Route::post('/report/sales', [ReportController::class, 'sales_generate']);

    Route::get('/preference/index', [AssignController::class, 'preference'])->name('preference.index');

    Route::get('/form/deposit-slip', [AssignController::class, 'deposit_index'])->name('deposit.slip');
    Route::post('/form/deposit-slip', [AssignController::class, 'deposit_generate']);

    Route::get('/election/form/index', [AssignController::class, 'election_form'])->name('election.form');
    Route::post('/election/form/index', [AssignController::class, 'election_generate']);

});

Route::get('/get-departments', [AssignController::class, 'getDept'])->name('get-departments');
//elcom routes
Route::group(['middleware' => ['auth']], function(){

    Route::get('/electoral-committees/index', [ElectComController::class, 'index'])->name('electcom.index');


});


Route::group(['middleware' => ['auth']], function(){

    Route::get('/message/index', [MessageController::class, 'index'])->name('message.index');
    Route::get('/message/delete', [MessageController::class, 'delete'])->name('message.delete');

});
Route::post('/message/index', [MessageController::class, 'send'])->name('message.index');

Route::group(['middleware' => ['auth']], function(){

    Route::post('/preferences/save', [SettingsController::class, 'save'])->name('settings.save');

});