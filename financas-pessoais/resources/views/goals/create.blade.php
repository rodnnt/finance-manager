@extends('layouts.main') 

@section('title', 'Novo Objetivos Financeiros') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href='/goals' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>

        <h1 class="fs-4 fs-md-3 fs-lg-2">Novo Objetivo</h1>
        
    </div>

    <form action='/goals' method='post'>

        @csrf

        <input type="hidden" name="created_by" value="{{ Auth::id() }}">

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome:</label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Informe o nome do objetivo" required>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fs-6 fs-md-5 fs-lg-4">Descrição:</label>
            <textarea class="form-control" name="description" id="description"
                placeholder="Informe a descrição do objetivo" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="target_value" class="form-label fs-6 fs-md-5 fs-lg-4">Valor Desejado:</label>
            <input type="number" step="0.01" class="form-control" name="target_value"
                id="target_value" placeholder="Informe o valor do objetivo" required>
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label fs-6 fs-md-5 fs-lg-4">Data Limite:</label>
            <input type="date" class="form-control" name="deadline"
                id="deadline" required>
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