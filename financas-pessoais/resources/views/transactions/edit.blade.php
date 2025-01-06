@extends('layouts.main') 

@section('title', 'Editar Transação') 

@section('content') 

<div class="container my-4">
    <h1>Editar Transação</h1>

    <form action='/transactions/update/{{$transaction->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Data:</label>
            <input type="date" class="form-control" name="transaction_date"
                id="transaction_date" value="{{$transaction->transaction_date}}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Transação:</label>
            <input type="text" class="form-control" name="name"
                id="name" value="{{$transaction->name}}"
                placeholder="Informe um título para a transação" required>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Tipo:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="Despesa"{{$transaction->type == 'Despesa' ? 'selected' : '' }}>Despesa</option>
                <option value="Receita"{{$transaction->type == 'Receita' ? 'selected' : '' }}>Receita</option>
                <option value="Transferencia" disabled {{$transaction->type == 'Transferencia' ? 'selected' : '' }}>Transferência</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria:</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{$category['id']}}" {{$category['id'] == $transaction['category_id']? 'selected' : ''}}>
                {{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Valor:</label>
            <input type="number" step="0.01" class="form-control" name="value"
                id="value" value="{{$transaction->value}}"
                placeholder="Informe o valor da transação" required>
        </div>

        <div class="mb-3">
            <label for="account_id" class="form-label">Categoria:</label>
            <select class="form-select" id="account_id" name="account_id" required>
                @foreach($bankAccounts as $account)
                <option value="{{$account['id']}}" {{$account['id'] == $transaction['account_id']? 'selected' : ''}}>
                    {{$account->account_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3"> 
            <label for="description">Descrição:</label>
            <textarea class="form-control" name="description" id="description" 
                placeholder="Informe a descrição da transação" rows="4">{{ $transaction->description ?? ''  }}</textarea>
        </div>


        <div class="mb-3 d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href='/transactions' class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection