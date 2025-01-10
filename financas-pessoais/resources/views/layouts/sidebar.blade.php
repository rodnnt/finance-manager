<div class="sidebar-menu">
    <ul class="nav flex-column">
        <!-- Home Link -->
        <li class="nav-item">
            <a class="nav-link active" href="/">
                <i class="bi bi-house-door"></i> Início
            </a>
        </li>

        <!-- Seção: Links Principais -->
        <li class="nav-item">
            <a class="nav-link" href="/transactions">
                <i class="bi bi-bar-chart"></i> Transações
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/goals">
                <i class="bi bi-speedometer2"></i> Metas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/accounts">
                <i class="bi bi-piggy-bank"></i> Contas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/categories">
                <i class="bi bi-tags"></i> Categorias
            </a>
        </li>

        <!-- Seção: Gestão -->
        @auth
        @if(Auth::user()->type === 'Admin')
        <li class="nav-item">
            <a class="nav-link" href="/users">
                <i class="bi bi-people"></i> Usuários
            </a>
        </li>
        @endif
        
        <!-- Linha Divisória -->
        <hr>

        <!-- Logout -->
        <li class="nav-item">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </button>
            </form>
        </li>
        @endauth
    </ul>
</div>