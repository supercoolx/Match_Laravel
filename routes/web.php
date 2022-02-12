<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
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
Auth::routes(['register' => false]);
/*
// Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'admin_login'])->name('admin.login');

Route::match(['get', 'post'], '/company/register', [CompanyController::class, 'register'])->name('company.register');
Route::match(['get', 'post'], '/agent/register', [AgentController::class, 'register'])->name('agent.register');
Route::match(['get', 'post'], '/engineer/register', [EngineerController::class, 'register'])->name('engineer.register');

Route::post('/user/follow/{id}', [UserController::class, 'follow'])->name('user.follow');
Route::post('/user/unfollow/{id}', [UserController::class, 'unfollow'])->name('user.unfollow');
Route::get('/projects', [ProjectController::class, 'list'])->name('projects.list');
Route::get('/projects/{id}', [ProjectController::class, 'detail'])->name('projects.detail');
Route::get('/invited/{token}', [UserController::class, 'invited'])->name('invite.accept');

Route::group(['middleware' => ['login']], function () {
    Route::get('/user/{id}', [UserController::class, 'detail'])->name('user.detail');
    
    Route::get('/invite', [UserController::class, 'invite'])->name('invite');
    Route::post('/invite', [UserController::class, 'invite'])->name('invite.send');

    Route::get('/users', [UserController::class, 'list'])->name('user.list');
    Route::get('/users/follow', [UserController::class, 'user_follow'])->name('user.follow.list');
    Route::get('/users/follower', [UserController::class, 'user_follower'])->name('user.follower.list');

    Route::post('/project/favourite', [ProjectController::class, 'addToFavourite'])->name('project.favourite.add');
    Route::get('/addresses', [ProjectController::class, 'addressesTree'])->name('addresses');
});

Route::group(['middleware' => ['company']], function() {
    Route::get('/company/dashboard', [CompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/company/setting', [CompanyController::class, 'setting'])->name('company.setting');
    Route::post('/company/setting', [UserController::class, 'update'])->name('company.update');

    Route::get('/company/project/post', [CompanyController::class, 'postProject'])->name('company.project.create');
    Route::get('/company/project/edit/{id}', [CompanyController::class, 'editProject'])->name('company.project.edit');
    Route::get('/company/projects/{id}', [CompanyController::class, 'projectDetail'])->name('company.project.detail');
    Route::post('/company/project/create', [ProjectController::class, 'create'])->name('company.project.post');
    Route::post('/company/project/update', [ProjectController::class, 'update'])->name('company.project.update');
    Route::post('/company/projects/delete', [ProjectController::class, 'delete'])->name('company.project.delete');
    Route::post('/company/projects/status', [ProjectController::class, 'status'])->name('company.project.status');
});

Route::group(['middleware' => ['agent']], function() {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/agent/setting', [AgentController::class, 'setting'])->name('agent.setting');
    Route::get('/agent/profile', [ProfileController::class, 'setting'])->name('agent.profile.setting');
    Route::get('/agent/score', [ProfileController::class, 'score'])->name('agent.score');
    Route::post('/agent/setting', [UserController::class, 'update'])->name('agent.update');
    Route::post('/agent/profile', [ProfileController::class, 'update'])->name('agent.profile.update');

    Route::get('/agent/project/post', [AgentController::class, 'postProject'])->name('agent.project.create');
    Route::get('/agent/project/edit/{id}', [AgentController::class, 'editProject'])->name('agent.project.edit');
    Route::get('/agent/projects/{id}', [AgentController::class, 'projectDetail'])->name('agent.project.detail');
    Route::post('/agent/project/create', [ProjectController::class, 'create'])->name('agent.project.post');
    Route::post('/agent/project/update', [ProjectController::class, 'update'])->name('agent.project.update');
    Route::post('/agent/projects/delete', [ProjectController::class, 'delete'])->name('agent.project.delete');
    Route::post('/agent/projects/status', [ProjectController::class, 'status'])->name('agent.project.status');
});

Route::group(['middleware' => ['engineer']], function() {
    Route::get('/engineer/dashboard', [EngineerController::class, 'dashboard'])->name('engineer.dashboard');
    Route::get('/engineer/setting', [EngineerController::class, 'setting'])->name('engineer.setting');
    Route::get('/engineer/profile', [ProfileController::class, 'setting'])->name('engineer.profile.setting');
    Route::post('/engineer/setting', [UserController::class, 'update'])->name('engineer.update');
    Route::post('/engineer/profile', [ProfileController::class, 'update'])->name('engineer.profile.update');
});

Route::group(['middleware' => ['chat']], function() {
    Route::get('/projects/{id}/messages', [ChatController::class, 'link'])->name('chat.link');
    Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{channelId}', [ChatController::class, 'channel'])->name('chat.channel');
    Route::get('/chat/setting', [ChatController::class, 'setting'])->name('chat.setting');
    Route::post('/chat/setting', [ChatController::class, 'setting'])->name('chat.setting');
    Route::post('/message', [ChatController::class, 'createMessage'])->name('chat.send');
    Route::post('/attachment', [ChatController::class, 'attachment'])->name('chat.attachment');
});

Route::group(['middleware' => ['admin']], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/members/{tab_for}', [AdminController::class, 'members'])->name('admin.members');
    Route::get('/admin/{usertype}/{id}', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/downloadCSV', [AdminController::class, 'exportCSV'])->name('admin.exportCSV');
    Route::get('/admin/password', function () { return view('admin.password'); })->name('admin.password');

    Route::post('/admin/members/delete', [AdminController::class, 'members_delete'])->name('admin.members.delete');
    Route::post('/admin/password/change', [AdminController::class, 'password'])->name('admin.password.change');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/terms-of-service', [TermsController::class, 'index'])->name('terms');
Route::get('/about-the-handling-of-personal-information', [PolicyController::class, 'index'])->name('policy');
