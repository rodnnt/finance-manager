<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Página Inicial (Welcome)
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [WelcomeController::class, 'index']);

//Transações
//Route::get('/', [TransactionController::class, 'index']); (leva direto pra essa tela)
Route::get( '/transactions', [ TransactionController::class, 'index'] );
Route::get( '/transactions/create', [ TransactionController::class, 'create' ] ) ->middleware('auth');
Route::post( '/transactions', [TransactionController::class, 'store' ]);
Route::delete( '/transactions/{id}', [TransactionController::class, 'destroy' ]);
Route::get( '/transactions/edit/{id}', [TransactionController::class, 'edit' ]) ->middleware('auth');
Route::put( '/transactions/update/{id}', [TransactionController::class, 'update' ]);

//Categorias
//Route::get('/', [CategoryController::class, 'index']); (leva direto pra essa tela)
Route::get( '/categories', [ CategoryController::class, 'index' ] );
Route::get( '/categories/create', [ CategoryController::class, 'create' ] ) ->middleware('auth');
Route::post('/categories', [CategoryController::class, 'store' ]);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy' ]);
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit' ]) ->middleware('auth');
Route::put('/categories/update/{id}', [CategoryController::class, 'update' ]);

//Contas
//Route::get('/', [AccountController::class, 'index']); (leva direto pra essa tela)
Route::get( '/accounts', [ AccountController::class, 'index' ] );
Route::get( '/accounts/create', [ AccountController::class, 'create' ] ) ->middleware('auth');
Route::post('/accounts', [AccountController::class, 'store' ]);
Route::delete('/accounts/{id}', [AccountController::class, 'destroy' ]);
Route::get('/accounts/edit/{id}', [AccountController::class, 'edit' ]) ->middleware('auth');
Route::put('/accounts/update/{id}', [AccountController::class, 'update' ]);

// Ceps
Route::get('/ceps', [CepController::class, 'index']);
Route::get('/ceps/create', [CepController::class, 'create']) ->middleware('auth');
Route::post('/ceps', [CepController::class, 'store']);
Route::delete('/ceps/{id}', [CepController::class, 'destroy']);
Route::get('/ceps/edit/{id}', [CepController::class, 'edit']) ->middleware('auth');
Route::put('/ceps/update/{id}', [CepController::class, 'update']);

// Moedas
Route::get('/currencies', [CurrencyController::class, 'index']);
Route::get('/currencies/create', [CurrencyController::class, 'create']) ->middleware('auth');
Route::post('/currencies', [CurrencyController::class, 'store']);
Route::delete('/currencies/{id}', [CurrencyController::class, 'destroy']);
Route::get('/currencies/edit/{id}', [CurrencyController::class, 'edit']) ->middleware('auth');
Route::put('/currencies/update/{id}', [CurrencyController::class, 'update']);

// Usuários
Route::get('/users', [UserController::class, 'index']) ->middleware('auth');
Route::get('/users/create', [UserController::class, 'create']) ->middleware('auth');
Route::post('/users', [UserController::class, 'store']) ->middleware('auth');
Route::delete('/users/{id}', [UserController::class, 'destroy']) ->middleware('auth');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->middleware(['auth']);
Route::put('/users/update/{id}', [UserController::class, 'update'])->middleware(['auth']);
Route::get('register', [RegisteredUserController::class, 'create']) ->name('register');

//Objetivos
//Route::get('/', [GoalController::class, 'index']); (leva direto pra essa tela)
Route::get( '/goals', [ GoalController::class, 'index' ] ); 
Route::get( '/goals/create', [ GoalController::class, 'create' ] ) ->middleware('auth');
Route::post('/goals', [GoalController::class, 'store' ]);
Route::delete('/goals/{id}', [GoalController::class, 'destroy' ]);
Route::get('/goals/edit/{id}', [GoalController::class, 'edit' ]) ->middleware('auth');
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
