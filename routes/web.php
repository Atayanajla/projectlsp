<?php

use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', [UserController::class, "logout"]);

Route::post('/register/store', [UserController::class, "storeRegister"]);
Route::post('/login/store/data', [UserController::class, "storeLogin"]);


Route::get('/profile', [UserController::class, "profilePage"]);
Route::put('/profile/update', [UserController::class, "profileUpdate"]);

//amind
Route::get('/admin/dashboard', function () {
    $users = UserModel::latest()->get();
    return view('admin.dashboard', compact("users"));
});

Route::get('/create/users', [UserController::class, "createuser"]);
Route::post('/profile/create-store', [UserController::class, "createuserStore"]);
Route::get('/admin/update/{id}', [UserController::class, "updateUser"]);
Route::put('/admin/update-{id}/store', [UserController::class, "updateUserStore"]);
Route::get('/admin/delete-{id}/store', [UserController::class, "deleteUserStore"]);