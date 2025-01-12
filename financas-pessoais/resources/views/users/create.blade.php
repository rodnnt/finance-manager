@extends('layouts.main')

@section('title', 'Cadastrar Usuário')

@section('content')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href='/users' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>

        <h1 class="fs-4 fs-md-3 fs-lg-2">Novo Usuário</h1>

    </div>

    <form action='/users' method='post' enctype="multipart/form-data">

        @csrf

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Informe o nome do usuário" required>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label fs-6 fs-md-5 fs-lg-4">Email:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Informe o email" required>
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label fs-6 fs-md-5 fs-lg-4">Senha:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Crie uma senha" required>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label fs-6 fs-md-5 fs-lg-4">Confirme a Senha:</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repita a senha" required>
        </div>

        @if(Auth::user()->type === 'Admin')
        <div class="form-group mb-3">
            <label for="type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo de Usuário:</label>
            <select class="form-select" name="type" id="type" required>
                <option value="Admin">Admin</option>
                <option value="Cliente" selected>Cliente</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="status" class="form-label fs-6 fs-md-5 fs-lg-4">Status:</label>
            <select class="form-select" name="status" id="status" required>
                <option value="Ativo" selected>Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
        </div>
        @endif

        <div class="form-group mb-3">
            <label for="cep_id" class="form-label fs-6 fs-md-5 fs-lg-4">CEP:</label>
            <select class="form-select" name="cep_id" id="cep_id">
                <option value="" selected disabled>Selecione o CEP de seu endereço</option>
                @foreach ($ceps as $cep)
                    <option value="{{ $cep->id }}">{{ $cep->cep }} - {{ $cep->street }} - {{ $cep->city }}, {{ $cep->state }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="address_number" class="form-label fs-6 fs-md-5 fs-lg-4">Número do Endereço:</label>
            <input type="text" class="form-control" name="address_number" id="address_number"
                placeholder="Informe o número do endereço">
        </div>

        <div class="form-group mb-3">
            <label for="address_complement" class="form-label fs-6 fs-md-5 fs-lg-4">Complemento:</label>
            <input type="text" class="form-control" name="address_complement" id="address_complement"
                placeholder="Complemento do endereço (opcional)">
        </div>

        <div class="form-group mb-3">
            <label for="preferred_currency_id" class="form-label fs-6 fs-md-5 fs-lg-4">Moeda Preferida:</label>
            <select class="form-select" name="preferred_currency_id" id="preferred_currency_id">
                <option value="" selected>Nenhuma</option>
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="profile_image" class="form-label fs-6 fs-md-5 fs-lg-4">Imagem do Perfil:</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
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