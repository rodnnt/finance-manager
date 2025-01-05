<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo da Aplicação -->
    <a class="navbar-brand" href="#">Financial Manager</a>
    
    <!-- Botão para Menu Responsivo -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Navegação -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Link para Dashboard -->
        <li class="nav-item">
          <a class="nav-link @if(Route::is('dashboard')) active @endif" href="#">Dashboard</a>
        </li>
        <!-- Link para Transações -->
        <li class="nav-item">
          <a class="nav-link @if(Route::is('transactions.*')) active @endif" href="#">Transações</a>
        </li>
        <!-- Link para Categorias -->
        <li class="nav-item">
          <a class="nav-link @if(Route::is('categories.*')) active @endif" href="/categories">Categorias</a>
        </li>
        <!-- Link para Relatórios -->
        <li class="nav-item">
          <a class="nav-link @if(Route::is('reports.*')) active @endif" href="#">Relatórios</a>
        </li>
        <!-- Dropdown do Usuário -->
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endauth
        @guest
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Cadastro</a>
        </li>
        @endguest
      </ul>
      <!-- Barra de Pesquisa -->
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>