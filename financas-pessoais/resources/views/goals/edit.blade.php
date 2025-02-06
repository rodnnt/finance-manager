@extends('layouts.main') 

@section('title', 'Editar Objetivos Financeiros') 

@section('content') 

<div class="container my-4">
    <h1 class="fs-4 fs-md-3 fs-lg-2">Editar Objetivo</h1>

    <form action='/goals/update/{{$goal->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome:</label>
            <input type="text" class="form-control" name="name" id="name"
                value="{{$goal->name}}"
                placeholder="Informe o nome do objetivo" required>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fs-6 fs-md-5 fs-lg-4">Descrição:</label>
            <textarea class="form-control" name="description" id="description"
                placeholder="Informe a descrição do objetivo" rows="4">{{ $goal->description  ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="target_value" class="form-label fs-6 fs-md-5 fs-lg-4">Valor Desejado:</label>
            <input type="number" step="0.01" class="form-control" name="target_value"
                id="target_value" value="{{$goal->target_value}}"
                placeholder="Informe o valor do objetivo" required>
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label fs-6 fs-md-5 fs-lg-4">Data Limite:</label>
            <input type="date" class="form-control" name="deadline"
                id="deadline" value="{{$goal->deadline}}" required>
        </div>

        <div class="mb-3">
            <label for="account_id" class="form-label fs-6 fs-md-5 fs-lg-4">Conta:</label>
            <select class="form-select" id="account_id" name="account_id" required>
                @foreach($financial_accounts as $account)
                <option value="{{$account['id']}}" {{$account['id'] == $goal['account_id']? 'selected' : ''}}>
                    {{$account->account_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle-fill"></i>
                <span>Salvar</span>
            </button>
            <a href='/goals' class="btn btn-outline-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection        