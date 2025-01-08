<div class="sidebar-menu">
    <ul class="nav flex-column">
        <!-- Home Link -->
        <li class="nav-item">
            <a class="nav-link active" href="/home">
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
            <a class="nav-link" href="/dashboard">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/settings">
                <i class="bi bi-gear"></i> Configurações
            </a>
        </li>

        <!-- Seção: Gestão -->
        <li class="nav-item">
            <a class="nav-link" href="/users">
                <i class="bi bi-people"></i> Usuários
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/products">
                <i class="bi bi-box"></i> Produtos
            </a>
        </li>
        
        @auth
        <!-- Linha Divisória -->
        <hr class="my-2">

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