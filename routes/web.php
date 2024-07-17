<?php

use App\Http\Controllers\CrimeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUserController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('start');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //свои роуты - начало

    //роуты для простых пользователей
    Route::get('taskuser', 'App\Http\Controllers\TaskUserController@index')->middleware('auth')->name('taskuser.index'); //Задачи пользователя
    Route::get('taskuser/{taskuser}', 'App\Http\Controllers\TaskUserController@show')->middleware('auth')->name('taskuser.show'); //Задачи пользователя
    Route::patch('taskuser/{taskuser}', 'App\Http\Controllers\TaskUserController@update')->middleware('auth')->name('taskuser.update'); //Роут для комментариев
    Route::get('employer', 'App\Http\Controllers\EmployerController@frontIndex')->middleware('auth')->name('employer.front-index'); //Заказчики
    Route::patch('employer/{employer}', 'App\Http\Controllers\EmployerController@frontUpdate')->middleware('auth')->name('employer.front-update'); //Заказчики правка

    //роуты для оу/опик/админ
    Route::middleware('ou')->group(function () {
        Route::get('statistics', 'App\Http\Controllers\StatisticController@index')->name('statistic.index');
        Route::post('statistics', 'App\Http\Controllers\StatisticController@store')->name('statistic.store');
        Route::patch('statistics/{assignment}', 'App\Http\Controllers\StatisticController@update')->name('statistic.update');
        Route::delete('statistics/{assignment}', '\App\Http\Controllers\StatisticController@destroy')->name('statistic.destroy');
    });

    //роуты для опика/админа
    Route::middleware('nopic')->group(function () {

        Route::post('task/download', 'App\Http\Controllers\TaskController@download')->name('task.download'); //выгрузка текущих задач Excel
        Route::get('task/copy/{id}', 'App\Http\Controllers\TaskController@copy')->name('task.copy.edit'); //копирование задач
        Route::prefix('task')->resource('task', TaskController::class); //КРУД задач
        Route::get('archive', '\App\Http\Controllers\ArchiveController@index')->name('archive.index'); //архив задач

    });


    //роуты для админа
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::resource('status', StatusController::class); //Статусы задач и роли пользователей
        Route::resource('department', DepartmentController::class); //Подразделения
        Route::resource('position', PositionController::class); //Должности
        Route::resource('user', UserController::class); //Пользователи
        Route::resource('crime', CrimeController::class); //Статьи
        Route::resource('employer', EmployerController::class); //Заказ.,линии
    });




    //свои роуты - конец


});

require __DIR__ . '/auth.php';
