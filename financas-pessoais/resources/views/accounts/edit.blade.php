@extends('layouts.main') 

@section('title', 'Editar Conta') 

@section('content') 

<div class="container my-4">
    <h1 class="fs-4 fs-md-3 fs-lg-2">Editar Conta</h1>

    <form action='/accounts/update/{{$account->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="account_name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome da Conta:</label>
            <input type="text" class="form-control" name="account_name"
                id="account_name" value="{{$account->account_name}}" 
                placeholder="Informe o nome da conta" required>
        </div>
        
        <div class="mb-3">
            <label for="bank_code" class="form-label fs-6 fs-md-5 fs-lg-4">Banco:</label>
            <input type="text" class="form-control" name="bank_code"
                id="bank_code" value="{{$account->bank_code}}"
                placeholder="Informe o código do banco" required>
        </div>

        <div class="mb-3">
            <label for="agency_code" class="form-label fs-6 fs-md-5 fs-lg-4">Agência:</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="agency_code"
                id="agency_code" value="{{$account->agency_code}}"
                placeholder="Informe o código da agência" required>
                <input type="text" class="form-control" name="agency_digit"
                id="agency_digit" value="{{$account->agency_digit}}" 
                placeholder="Informe o dígito da agência">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_number" class="form-label fs-6 fs-md-5 fs-lg-4">Conta:</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="account_number"
                id="account_number" value="{{$account->account_number}}" 
                placeholder="Informe o número da conta" required>
                <input type="text" class="form-control" name="account_digit"
                id="account_digit" value="{{$account->account_digit}}"
                placeholder="Informe o dígito da conta">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo de Conta:</label>
            <select class="form-select" id="account_type" name="account_type" required>
                <option value="Conta Corrente"
                    {{$account->account_type == 'Conta Corrente' ? 'selected' : '' }}>
                    Conta Corrente</option>
                <option value="Conta Poupança"
                    {{$account->account_type == 'Conta Poupança' ? 'selected' : '' }}>
                    Conta Poupança</option>
                <option value="Cartão de Crédito" disabled
                    {{$account->account_type == 'Cartão de Crédito' ? 'selected' : '' }}>
                    Cartão de Crédito</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="initial_balance" class="form-label fs-6 fs-md-5 fs-lg-4">Saldo Inicial:</label>
            <input type="number" step="0.01" class="form-control" name="initial_balance"
                id="initial_balance" value="{{$account->initial_balance}}"
                placeholder="Informe o valor atual da conta" required>
        </div>

        <div class="mb-3 {{ $account->account_type != 'Cartão de Crédito' ? 'd-none' : '' }}" id="credit_limit_field">
            <label for="credit_limit" class="form-label fs-6 fs-md-5 fs-lg-4">Limite de Crédito:</label>
            <input type="number" step="0.01" class="form-control" name="credit_limit"
                id="credit_limit" value="{{ $account->credit_limit }}">
        </div>

        <div class="mb-3">
            <label for="created_at" class="form-label fs-6 fs-md-5 fs-lg-4">Data de Criação:</label>
            <input type="text" class="form-control" name="created_at"
                id="created_at" value='{{$account->created_at}}' disabled>
        </div>

        <div class="mb-3">
            <label for="updated_at" class="form-label fs-6 fs-md-5 fs-lg-4">Última Atualização:</label>
            <input type="text" class="form-control" name="updated_at"
            id="updated_at" value='{{$account->updated_at}}' disabled>
        </div>

        <div class="mb-3 d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle-fill"></i>
                <span>Salvar</span>
            </button>
            <a href='/accounts' class="btn btn-outline-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection