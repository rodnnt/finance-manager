<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo da Aplicação talvez colocar imagem png aqui -->
            <a class="navbar-brand" href="/">Financial Manager</a>

            <!-- Botão para Menu Responsivo -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    
                    <!-- Menu de Cadastros -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(Route::is('accounts.*') || Route::is('categories.*')) active @endif" href="#" id="cadastrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cadastrosDropdown">
                            <li><a class="dropdown-item @if(Route::is('accounts.*')) active @endif" href="/accounts">Contas</a></li>
                            <li><a class="dropdown-item @if(Route::is('categories.*')) active @endif" href="/categories">Categorias</a></li>
                            <li><a class="dropdown-item @if(Route::is('ceps.*')) active @endif" href="/coins">Moedas</a></li>
                            <li><a class="dropdown-item @if(Route::is('ceps.*')) active @endif" href="/ceps">Ceps</a></li>
                        </ul>
                    </li>

                    <!-- Menu de Programas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(Route::is('transactions.*')) active @endif" href="#" id="programasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Programas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="programasDropdown">
                            <li><a class="dropdown-item @if(Route::is('transactions.*')) active @endif" href="/transactions">Transações</a></li>
                        </ul>
                    </li>

                    <!-- Menu de Relatórios -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(Route::is('reports.*')) active @endif" href="#" id="relatoriosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Relatórios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="relatoriosDropdown">
                            <li><a class="dropdown-item @if(Route::is('reports.*')) active @endif" href="/dashboard">Dashboard</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Número" aria-label="Search">
                </form>

                <!-- Botões de Autenticação e Usuário -->
                <div class="navbar-right">
                    @guest
                    <!-- Botão de Cadastro de Usuário -->
                    <form method="GET" action="/register">
                        @csrf
                        <button type="submit" class="btn btn-secondary bi bi-person-add">
                            <span>Cadastro</span>
                        </button>
                    </form>

                    <!-- Botão de Login de Usuário -->
                    <form method="GET" action="/login">
                        @csrf
                        <button type="submit" class="btn btn-secondary bi bi-person-check">
                            <span>Login</span>
                        </button>
                    </form>                 
                    @endguest

                    @auth
                    <!--  Usuário Autenticado -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle bi bi-person-gear" data-bs-toggle="dropdown">
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item bi bi-person-lines-fill" href="/user/profile" > Editar Perfil</a>
                            <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item bi bi-person-dash"> Logout</button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>