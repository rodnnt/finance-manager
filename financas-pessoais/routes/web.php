<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

//Transações
//Route::get('/', [TransactionController::class, 'index']); (leva direto pra essa tela)
Route::get( '/transactions', [ TransactionController::class, 'index'] );
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