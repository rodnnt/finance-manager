@extends('layouts.main') 

@section('title', 'Editar Usuário') 

@section('content') 

<div class="container my-4">
    <h1 class="fs-4 fs-md-3 fs-lg-2">Editar Usuário</h1>

    <!-- Exibir erros gerais -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/users/update/{{$user->id}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" 
                placeholder="Informe o nome do usuário" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label fs-6 fs-md-5 fs-lg-4">E-mail:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" 
                placeholder="Informe o e-mail do usuário" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if(Auth::user()->type === 'Admin')
        <div class="form-group mb-3">
            <label for="type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo:</label>
            <select class="form-select @error('type') is-invalid @enderror" name="type" id="type" required>
                <option value="Admin" {{ old('type', $user->type) == 'Admin' ? 'selected' : '' }}>Administrador</option>
                <option value="Cliente" {{ old('type', $user->type) == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="Outro" {{ old('type', $user->type) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status" class="form-label fs-6 fs-md-5 fs-lg-4">Status:</label>
            <select class="form-select" name="status" id="status" required>
                <option value="Ativo" {{ old('status', $user->status) == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="Inativo" {{ old('status', $user->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>
        @endif

        <div class="form-group mb-3">
            <label for="cep_id" class="form-label fs-6 fs-md-5 fs-lg-4">CEP:</label>
            <select class="form-select @error('cep_id') is-invalid @enderror" name="cep_id" id="cep_id">
                <option value="" selected disabled>Selecione o CEP de seu endereço</option>
                @foreach ($ceps as $cep)
                    <option value="{{ $cep->id }}" {{ old('cep_id', $user->cep_id) == $cep->id ? 'selected' : '' }}>
                        {{ $cep->cep }} - {{ $cep->street }}
                    </option>
                @endforeach
            </select>
            @error('cep_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="street" class="form-label fs-6 fs-md-5 fs-lg-4">Endereço:</label>
            <input type="text" class="form-control" id="street" 
                value="{{ old('street', optional($user->cep)->street) }}" disabled>
        </div>

        <div class="form-group mb-3">
            <label for="address_number" class="form-label fs-6 fs-md-5 fs-lg-4">Número do Endereço:</label>
            <input type="text" class="form-control" name="address_number" id="address_number" 
                value="{{ old('address_number', $user->address_number) }}" placeholder="Informe o número do endereço">
        </div>

        <div class="form-group mb-3">
            <label for="neighborhood" class="form-label fs-6 fs-md-5 fs-lg-4">Bairro:</label>
            <input type="text" class="form-control" id="neighborhood"
                value="{{ old('neighborhood', optional($user->cep)->neighborhood) }}" disabled>
        </div>

        <div class="form-group mb-3">
            <label for="city" class="form-label fs-6 fs-md-5 fs-lg-4">Cidade:</label>
            <input type="text" class="form-control" id="city"
                value="{{ old('city', optional($user->cep)->city) }}" disabled>
        </div>

        <div class="form-group mb-3">
            <label for="state" class="form-label fs-6 fs-md-5 fs-lg-4">Estado:</label>
            <input type="text" class="form-control" id="state"
                value="{{ old('state', optional($user->cep)->state) }}" disabled>
        </div>

        <div class="form-group mb-3">
            <label for="preferred_currency_id" class="form-label fs-6 fs-md-5 fs-lg-4">Moeda Preferida:</label>
            <select class="form-select" name="preferred_currency_id" id="preferred_currency_id">
                <option value="">Não definida</option>
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ old('preferred_currency_id', $user->preferred_currency_id) == $currency->id ? 'selected' : '' }}>
                        {{ $currency->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle-fill"></i>
                <span>Salvar</span>
            </button>
            <a href="/users" class="btn btn-outline-danger">
                <i class="bi bi-x-circle"></i>
                <span>Cancelar</span>
            </a>
        </div>

    </form>
</div>
@endsection