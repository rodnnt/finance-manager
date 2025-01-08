@extends('layouts.main') 

@section('title', 'Nova Transação') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href='/transactions' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>

        <h1 class="fs-4 fs-md-3 fs-lg-2">Nova Transação</h1>
        
    </div>

    <form action='/transactions' method='post'>

        @csrf

        <div class="mb-3">
            <label for="transaction_date" class="form-label fs-6 fs-md-5 fs-lg-4">Data:</label>
            <input type="date" class="form-control" name="transaction_date"
                id="transaction_date" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Transação:</label>
            <input type="text" class="form-control" name="name"
                id="name" placeholder="Informe um título para a transação" required>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="Despesa">Despesa</option>
                <option value="Receita">Receita</option>
                <option value="Transferencia" disabled>Transferência</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label fs-6 fs-md-5 fs-lg-4">Categoria:</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="" selected disabled>Selecione uma categoria</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label fs-6 fs-md-5 fs-lg-4">Valor:</label>
            <input type="number" step="0.01" class="form-control" name="value"
                id="value" placeholder="Informe o valor da transação" required>
        </div>

        <div class="mb-3">
            <label for="account_id" class="form-label fs-6 fs-md-5 fs-lg-4">Conta:</label>
            <select class="form-select" id="account_id" name="account_id" required>
                <option value="" selected disabled>Selecione uma conta</option>
                @foreach($financial_accounts as $account)
                <option value="{{$account->id}}">{{$account->account_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description">Descrição:</label>
            <textarea class="form-control" name="description" id="description"
                placeholder="Informe a descrição da transação" rows="4"></textarea>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Cadastrar</span>
            </button>
            <button type="reset" class="btn btn-outline-danger">
                <i class="bi bi-backspace-reverse"></i>                
                <span>Limpar</span>
            </button>
        </div>
    </form>
</div>
@endsection