@extends('layouts.main')

@section('title', 'Editar CEP')

@section('content')

<div class="container my-4">
    <h1 class="fs-4 fs-md-3 fs-lg-2">Editar CEP</h1>

    <form action='/ceps/update/{{$cep->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="cep" class="form-label fs-6 fs-md-5 fs-lg-4">CEP:</label>
            <input type="text" class="form-control" name="cep" id="cep" value='{{$cep->cep}}' 
                placeholder="Informe o CEP" required maxlength="10">
            <div id="cepError" class="text-danger" style="display: none;">O formato do CEP deve ser XXXXX-XXX</div>
        </div>

        <div class="form-group mb-3">
            <label for="street" class="form-label fs-6 fs-md-5 fs-lg-4">Rua:</label>
            <input type="text" class="form-control" name="street" id="street" value='{{$cep->street}}' 
                placeholder="Informe a rua" required>
        </div>

        <div class="form-group mb-3">
            <label for="neighborhood" class="form-label fs-6 fs-md-5 fs-lg-4">Bairro:</label>
            <input type="text" class="form-control" name="neighborhood" id="neighborhood" value='{{$cep->neighborhood}}' 
                placeholder="Informe o bairro" required>
        </div>

        <div class="form-group mb-3">
            <label for="city" class="form-label fs-6 fs-md-5 fs-lg-4">Cidade:</label>
            <input type="text" class="form-control" name="city" id="city" value='{{$cep->city}}' 
                placeholder="Informe a cidade" required>
        </div>

        <div class="form-group mb-3">
            <label for="state" class="form-label fs-6 fs-md-5 fs-lg-4">Estado:</label>
            <select class="form-control" name="state" id="state" required>
                <option value="">Selecione o estado</option>
                @foreach($states as $sigla => $nome)
                    <option value="{{ $sigla }}" {{ $cep->state == $sigla ? 'selected' : '' }}>
                        {{ $nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle-fill"></i>
                <span>Salvar</span>
            </button>
            <a href='/ceps' class="btn btn-outline-danger">Cancelar</a>
        </div>

    </form>
</div>
@endsection