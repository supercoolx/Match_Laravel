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
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'admin_login'])->name('admin.login');

Route::get('/company/register', [CompanyController::class, 'register'])->name('company.register');
Route::get('/agent/register', [AgentController::class, 'register'])->name('agent.register');
Route::get('/engineer/register', [EngineerController::class, 'register'])->name('engineer.register');

Route::get('/users', [UserController::class, 'list'])->name('users.list');
Route::get('/projects', [ProjectController::class, 'list'])->name('projects.list');
Route::get('/projects/{id}', [ProjectController::class, 'detail'])->name('projects.detail');
Route::get('/addresses', [ProjectController::class, 'addressesTree'])->name('addresses');

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
    Route::post('/agent/setting', [UserController::class, 'update'])->name('agent.update');

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
    Route::get('/engineer/profile_setting', [EngineerController::class, 'profile_setting'])->name('engineer.profile.setting');
    Route::post('/engineer/setting', [UserController::class, 'update'])->name('engineer.update');
    Route::post('/engineer/profile_setting', [EngineerController::class, 'profile_update'])->name('engineer.profile.update');
});

Route::group(['middleware' => ['chat']], function() {
    Route::get('/projects/{id}/messages', [ChatController::class, 'link'])->name('chat.link');
    Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{channelId}', [ChatController::class, 'channel'])->name('chat.channel');
    Route::post('/message', [ChatController::class, 'message'])->name('chat.send');
    Route::post('/attachment', [ChatController::class, 'attachment'])->name('chat.attachment');

    Route::get('/channels', [ChatController::class, 'getChannels'])->name('chat.channels');
    Route::get('/channels/{channelId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::get('/channels/{channelId}/read', [ChatController::class, 'read'])->name('chat.read');
});

Route::group(['middleware' => ['admin']], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/members/{tab_for}', [AdminController::class, 'members'])->name('admin.members');
    Route::get('/admin/projects', [AdminController::class, 'projects'])->name('admin.projects');
    Route::get('/admin/{usertype}/{id}', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/password', function () { return view('admin.password'); })->name('admin.password');

    Route::post('/admin/members/delete', [AdminController::class, 'members_delete'])->name('admin.members.delete');
    Route::post('/admin/password/change', [AdminController::class, 'password'])->name('admin.password.change');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/terms-of-service', [TermsController::class, 'index'])->name('terms');
Route::get('/about-the-handling-of-personal-information', [PolicyController::class, 'index'])->name('policy');
