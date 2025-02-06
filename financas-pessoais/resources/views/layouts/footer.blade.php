<footer class="bg-secondary py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="fw-bold mb-3 text-white">Finance Manager</h5>
                <p class="small text-white">
                    Uma aplicação simples e eficiente para gerenciar suas finanças pessoais e empresariais. Controle suas despesas, receitas e organize seu futuro financeiro.
                </p>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-3 text-white">Links Rápidos</h5>
                <ul class="list-unstyled small">
                    <li><a href="/" class="text-decoration-none text-light">Dashboard</a></li>
                    <li><a href="/transactions" class="text-decoration-none text-light">Transações</a></li>
                    <li><a href="/categories" class="text-decoration-none text-light">Categorias</a></li>
                    <li><a href="/accounts" class="text-decoration-none text-light">Contas</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-3 text-white">Contato</h5>
                <p class="small mb-1 text-white">
                    <i class="fas fa-envelope me-2"></i> suporte@gestaofinanceira.com
                </p>
                <p class="small mb-1 text-white">
                    <i class="fas fa-phone me-2"></i> +55 (49) 1234-5678
                </p>
                <p class="small text-white">
                    <i class="fas fa-map-marker-alt me-2"></i> Rua Financeira, 123 - Caçador, SC
                </p>
            </div>

            <div>
                @if (view()->hasSection('floating-button-href'))
                    <a href="@yield('floating-button-href')" type="button" class="btn btn-primary btn-floating fs-6 fs-md-5 fs-lg-4">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="text-center mt-4 border-top pt-3 small text-white">
            &copy; <script>
                document.write(new Date().getFullYear());
            </script> Finance Manager. Todos os direitos reservados.
        </div>
    </div>
</footer>