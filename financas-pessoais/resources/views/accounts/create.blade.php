@extends('layouts.main') 

@section('title', 'Nova Conta') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href='/accounts' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>

        <h1 class="fs-4 fs-md-3 fs-lg-2">Nova Conta</h1>
        
    </div>

    <form action='/accounts' method='post'>

        @csrf

        <div class="mb-3">
            <label for="account_name" class="form-label fs-6 fs-md-5 fs-lg-4 fs-6 fs-md-5 fs-lg-4">Nome da Conta:</label>
            <input type="text" class="form-control" name="account_name"
                id="account_name" placeholder="Informe o nome da conta" required>
        </div>
        
        <div class="mb-3">
            <label for="bank_code" class="form-label fs-6 fs-md-5 fs-lg-4">Banco:</label>
            <input type="text" class="form-control" name="bank_code"
                id="bank_code" placeholder="Informe o código do banco" required>
        </div>

        <div class="mb-3">
            <label for="agency_code" class="form-label fs-6 fs-md-5 fs-lg-4">Agência:</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="agency_code"
                id="agency_code" placeholder="Informe o código da agência" required>
                <input type="text" class="form-control" name="agency_digit"
                id="agency_digit" placeholder="Informe o dígito da agência">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_number" class="form-label fs-6 fs-md-5 fs-lg-4">Conta:</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="account_number"
                id="account_number" placeholder="Informe o número da conta" required>
                <input type="text" class="form-control" name="account_digit"
                id="account_digit" placeholder="Informe o dígito da conta">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo de Conta:</label>
            <select class="form-select" id="account_type" name="account_type" required>
                <option value="Conta Corrente">Conta Corrente</option>
                <option value="Conta Poupança">Conta Poupança</option>
                <option value="Cartão de Crédito" disabled>Cartão de Crédito</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="initial_balance" class="form-label fs-6 fs-md-5 fs-lg-4">Saldo Inicial:</label>
            <input type="number" step="0.01" class="form-control" name="initial_balance"
                id="initial_balance" placeholder="Informe o valor atual da conta" required>
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