@extends('layouts.main')

@section('title', 'Cadastrar CEP')

@section('content')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href='/ceps' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>
        <h1 class="fs-4 fs-md-3 fs-lg-2">Novo CEP</h1>
    </div>

    <form action='/ceps' method='post' id="cepForm">
        @csrf

        <div class="form-group mb-3">
            <label for="cep" class="form-label fs-6 fs-md-5 fs-lg-4">CEP:</label>
            <input type="text" class="form-control" name="cep" id="cep" placeholder="Informe o CEP" required maxlength="10">
            <div id="cepError" class="text-danger" style="display: none;">O formato do CEP deve ser XXXXX-XXX</div>
        </div>

        <div class="form-group mb-3">
            <label for="street" class="form-label fs-6 fs-md-5 fs-lg-4">Rua:</label>
            <input type="text" class="form-control" name="street" id="street" placeholder="Informe a rua" required>
        </div>

        <div class="form-group mb-3">
            <label for="neighborhood" class="form-label fs-6 fs-md-5 fs-lg-4">Bairro:</label>
            <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="Informe o bairro" required>
        </div>

        <div class="form-group mb-3">
            <label for="city" class="form-label fs-6 fs-md-5 fs-lg-4">Cidade:</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Informe a cidade" required>
        </div>

        <div class="form-group mb-3">
            <label for="state" class="form-label fs-6 fs-md-5 fs-lg-4">Estado:</label>
            <select class="form-control" name="state" id="state" required>
                <option value="">Selecione o estado</option>
                @foreach($states as $sigla => $nome)
                    <option value="{{ $sigla }}">
                        {{ $nome }}
                    </option>
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

<script>
    document.getElementById('cep').addEventListener('input', function(e) {
        let cep = e.target.value.replace(/\D/g, '');
        if (cep.length > 5) {
            cep = cep.substring(0, 5) + '-' + cep.substring(5, 8);
        }
        e.target.value = cep;
    });

    document.getElementById('cepForm').addEventListener('submit', function(event) {
        let isValid = true;

        const cep = document.getElementById('cep');
        const cepError = document.getElementById('cepError');
        const cepRegex = /^\d{5}-\d{3}$/;
        if (!cepRegex.test(cep.value)) {
            cepError.style.display = 'block';
            isValid = false;
        } else {
            cepError.style.display = 'none';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
@endsection