<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;

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

//Contas Bancárias
//Route::get('/', [AccountController::class, 'index']); (leva direto pra essa tela)
Route::get( '/bank-accounts', [ AccountController::class, 'index' ] ) ->middleware('auth');
Route::get( '/bank-accounts/create', [ AccountController::class, 'create' ] );
Route::post('/bank-accounts', [AccountController::class, 'store' ]);
Route::delete('/bank-accounts/{id}', [AccountController::class, 'destroy' ]);
Route::get('/bank-accounts/edit/{id}', [AccountController::class, 'edit' ]);
Route::put('/bank-accounts/update/{id}', [AccountController::class, 'update' ]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
