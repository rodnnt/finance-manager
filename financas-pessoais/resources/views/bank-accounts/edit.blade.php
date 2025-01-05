@extends('layouts.main') 

@section('title', 'Editar Conta Bancária') 

@section('content') 

<div class="container my-4">
    <h1>Editar Conta Bancária</h1>

    <form action='/bank-accounts/update/{{$bankAccount->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="account_name" class="form-label">Nome da Conta:</label>
            <input type="text" class="form-control" name="account_name"
                id="account_name" value="{{$bankAccount->account_name}}" 
                placeholder="Informe o nome da conta" required>
        </div>
        
        <div class="mb-3">
            <label for="bank_code" class="form-label">Banco:</label>
            <input type="text" class="form-control" name="bank_code"
                id="bank_code" value="{{$bankAccount->bank_code}}"
                placeholder="Informe o código do banco" required>
        </div>

        <div class="mb-3">
            <label for="agency_code" class="form-label">Agência:</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="agency_code"
                id="agency_code" value="{{$bankAccount->agency_code}}"
                placeholder="Informe o código da agência" required>
                <input type="text" class="form-control" name="agency_digit"
                id="agency_digit" value="{{$bankAccount->agency_digit}}" 
                placeholder="Informe o dígito da agência">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_number" class="form-label">Conta:</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="account_number"
                id="account_number" value="{{$bankAccount->account_number}}" 
                placeholder="Informe o número da conta" required>
                <input type="text" class="form-control" name="account_digit"
                id="account_digit" value="{{$bankAccount->account_digit}}"
                placeholder="Informe o dígito da conta">
            </div>
        </div>

        <div class="mb-3">
            <label for="account_type" class="form-label">Tipo de Conta:</label>
            <select class="form-select" id="account_type" name="account_type" required>
                <option value="Conta Corrente"
                    {{$bankAccount->account_type == 'Conta Corrente' ? 'selected' : '' }}>
                    Conta Corrente</option>
                <option value="Conta Poupança"
                    {{$bankAccount->account_type == 'Conta Poupança' ? 'selected' : '' }}>
                    Conta Poupança</option>
                <option value="Cartão de Crédito" disabled
                    {{$bankAccount->account_type == 'Cartão de Crédito' ? 'selected' : '' }}>
                    Cartão de Crédito</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="initial_balance" class="form-label">Saldo Inicial:</label>
            <input type="number" step="0.01" class="form-control" name="initial_balance"
                id="initial_balance" value="{{$bankAccount->initial_balance}}"
                placeholder="Informe o valor atual da conta" required>
        </div>

        <div class="mb-3 {{ $bankAccount->account_type != 'Cartão de Crédito' ? 'd-none' : '' }}" id="credit_limit_field">
            <label for="credit_limit" class="form-label">Limite de Crédito:</label>
            <input type="number" step="0.01" class="form-control" name="credit_limit"
                id="credit_limit" value="{{ $bankAccount->credit_limit }}">
        </div>

        <div class="mb-3">
            <label for="created_at">Data de Criação:</label>
            <input type="text" class="form-control" name="created_at"
                id="created_at" value='{{$bankAccount->created_at}}' disabled>
        </div>

        <div class="mb-3">
            <label for="updated_at">Última Atualização:</label>
            <input type="text" class="form-control" name="updated_at"
            id="updated_at" value='{{$bankAccount->updated_at}}' disabled>
        </div>

        <div class="mb-3 d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href='/bank-accounts' class="btn btn-secondary">Cancelar</a>
        </div>

    </form>
</div>
@endsection