<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

//Transações
//Route::get('/', [TransactionController::class, 'index']); (leva direto pra essa tela)
Route::get( '/transactions', [ TransactionController::class, 'index'] ) ->middleware('auth');;
Route::get( '/transactions/create', [ TransactionController::class, 'create' ] );
Route::post( '/transactions', [TransactionController::class, 'store' ]);
Route::delete( '/transactions/{id}', [TransactionController::class, 'destroy' ]);
Route::get( '/transactions/edit/{id}', [TransactionController::class, 'edit' ]);
Route::put( '/transactions/update/{id}', [TransactionController::class, 'update' ]);

//Categorias
//Route::get('/', [CategoryController::class, 'index']); (leva direto pra essa tela)
Route::get( '/categories', [ CategoryController::class, 'index' ] ) ->middleware('auth');
Route::get( '/categories/create', [ CategoryController::class, 'create' ] );
Route::post('/categories', [CategoryController::class, 'store' ]);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy' ]);
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit' ]);
Route::put('/categories/update/{id}', [CategoryController::class, 'update' ]);

//Contas
//Route::get('/', [AccountController::class, 'index']); (leva direto pra essa tela)
Route::get( '/accounts', [ AccountController::class, 'index' ] ) ->middleware('auth');
Route::get( '/accounts/create', [ AccountController::class, 'create' ] );
Route::post('/accounts', [AccountController::class, 'store' ]);
Route::delete('/accounts/{id}', [AccountController::class, 'destroy' ]);
Route::get('/accounts/edit/{id}', [AccountController::class, 'edit' ]);
Route::put('/accounts/update/{id}', [AccountController::class, 'update' ]);

// Ceps
Route::get('/ceps', [CepController::class, 'index']); //->middleware('auth');
Route::get('/ceps/create', [CepController::class, 'create']);
Route::post('/ceps', [CepController::class, 'store']);
Route::delete('/ceps/{id}', [CepController::class, 'destroy']);
Route::get('/ceps/edit/{id}', [CepController::class, 'edit']);
Route::put('/ceps/update/{id}', [CepController::class, 'update']);

// Coins
Route::get('/coins', [CoinController::class, 'index']); //->middleware('auth');
Route::get('/coins/create', [CoinController::class, 'create']);
Route::post('/coins', [CoinController::class, 'store']);
Route::delete('/coins/{id}', [CoinController::class, 'destroy']);
Route::get('/coins/edit/{id}', [CoinController::class, 'edit']);
Route::put('/coins/update/{id}', [CoinController::class, 'update']);

// Users
Route::get('/users', [UserController::class, 'index']) ->middleware('auth');
Route::get('/users/create', [UserController::class, 'create']) ->middleware('auth'); 
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->middleware(['auth']);
Route::put('/users/update/{id}', [UserController::class, 'update'])->middleware(['auth']);
Route::get('register', [RegisteredUserController::class, 'create']) ->name('register');

//Objetivos
//Route::get('/', [GoalController::class, 'index']); (leva direto pra essa tela)
Route::get( '/goals', [ GoalController::class, 'index' ] ) ->middleware('auth');
Route::get( '/goals/create', [ GoalController::class, 'create' ] );
Route::post('/goals', [GoalController::class, 'store' ]);
Route::delete('/goals/{id}', [GoalController::class, 'destroy' ]);
Route::get('/goals/edit/{id}', [GoalController::class, 'edit' ]);
Route::put('/goals/update/{id}', [GoalController::class, 'update' ]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
