<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

//use Illuminate\Support\Facades\Auth;

// Главная
Route::get('/', [PageController::class, 'home_show']);

// Просмотр страниц
Route::get('/page/{slug?}', [PageController::class, 'page_show']);

// Админка
Route::group(['prefix' => 'admin'], function() {
    Route::get('/activity/', [ActivityController::class, 'index']);
    Route::get('/activity/{id?}', [ActivityController::class, 'index_pages']);
});

// Роуты для авторизации/регистрации/и т.д.
//Auth::routes();

// Сюда переадресовывает после регистрации и/или авторизации
// При этом переадресация прописана в /vendor/laravel/framework/src/Illuminate/Foundation/Auth/RedirectsUsers.php
// И нет возможности её изменить. Печаль
Route::get('/home', [PageController::class, 'home_show']);