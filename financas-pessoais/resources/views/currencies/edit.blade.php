@extends('layouts.main') 

@section('title', 'Editar Moeda') 

@section('content') 

<div class="container my-4">
    <h1 class="fs-4 fs-md-3 fs-lg-2">Editar Moeda</h1>

    <form action='/currencies/update/{{$currency->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="code" class="form-label fs-6 fs-md-5 fs-lg-4">Código da Moeda:</label>
            <input type="text" class="form-control" name="code" id="code" value='{{$currency->code}}' 
                placeholder="Informe o código da moeda" required>
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome da Moeda:</label>
            <input type="text" class="form-control" name="name" id="name" value='{{$currency->name}}' 
                placeholder="Informe o nome da moeda" required>
        </div>

        <div class="form-group mb-3">
            <label for="symbol" class="form-label fs-6 fs-md-5 fs-lg-4">Símbolo da Moeda:</label>
            <input type="text" class="form-control" name="symbol" id="symbol" value='{{$currency->symbol}}' 
                placeholder="Informe o símbolo da moeda" required>
        </div>

        <div class="form-group mb-3">
            <label for="created_at" class="form-label fs-6 fs-md-5 fs-lg-4">Data de Criação:</label>
            <input type="text" class="form-control" name="created_at" id="created_at" value='{{$currency->created_at}}' disabled>
        </div>

        <div class="form-group mb-3">
            <label for="updated_at" class="form-label fs-6 fs-md-5 fs-lg-4">Última Atualização:</label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value='{{$currency->updated_at}}' disabled>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle-fill"></i>
                <span>Salvar</span>
            </button>
            <a href='/currencies' class="btn btn-outline-danger">Cancelar</a>
        </div>

    </form>
</div>
@endsection