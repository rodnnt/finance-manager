<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Logo OutBuyCenter -->        
        <div id="logo-menu-obc" class="col-xs-12 col-sm-3 col-md-2 col-lg-2" style="text-align: center;">
            <a class="logo" href="https://adami.outbuycenter.com.br/obc/index.php"><img src="https://adami.outbuycenter.com.br/assets/img/outbuycenter.png"></a>    
            <div id="versao-obc">24.12.09.013
            </div>
        </div>

        <!-- Menu Principal-->
        <div class="menu-obc-botao-hide-menu" style="display:none;"><a onclick="mostraMenu();"><span class="glyphicon glyphicon-tasks"></span></a></div>
        <div id="menu-obc-main" class="menu-obc-main">
            
        </div>

        <!-- Pesquisa -->   
        <div class="navbar-right box-direita-topo">
            <!-- Box de pesquisa de SDCV -->
            <div class="box-pesquisa navbar-left">     
                <form class="navbar-left" id="form_busca" onkeypress="return SomenteNumero(event)" target="main" name="form_busca" onsubmit="event.preventDefault(); return busca_rapida(1, '/obc/')" action="#" method="post">
                    <div class="input-group">

                        <input id="vfCodigo" class="form-control busca-topo" type="text" maxlength="15" value="" name="vfCodigo" placeholder="Pesquisar Número">

                    </div>  
                </form>
            </div>

            <!-- Botão de Logs -->  
            <div class="navbar-left">
                <div class="btn-group btn-logs">
                    <button type="button" class="btn btn-primary btn-log dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-clock"></i>
                            </button>
                            
                </div>  
            </div>

            <div class="navbar-left" style="margin-left:-3px; ">
                <div class="">
                    <ul class="nav navbar-nav navbar-left menu-principal"><li>
                            <button type="button" class="btn btn-primary btn-config dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                </div>
            </div>

            <div class="navbar-left" style="margin-left:-3px; ">
                <div class="">
                    <ul class="nav navbar-nav navbar-left menu-principal"><li>
                        <button type="button" class="btn btn-primary btn-config dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-robot"></i>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                </div>
            </div>

            <div class="navbar-left">
                <div class="btn-group btn-logs">
                       <a href="https://adami.outbuycenter.com.br/obc/../treinamento/?modulo=Sistema&amp;video=1#Sistema_1" target="main" class="btn btn-primary dropdown-toggle" style="margin-top:3px;" alt="Como criar SDCVs">
                       <i class="fas fa-video fa-sm"></i>
                   </a>
                </div>
            </div>

            <div class="navbar-left">
                <div class="btn-group">
                    
                </div>
            </div>

            <!-- Box com os dados do usuário -->
            <div class="box-usuario">  
                <ul class="nav navbar-nav navbar-left menu-principal menu-avatar"> <li align="left">
                    <a href="#" target="" class="dropdown-toggle" data-toggle="dropdown"> 
                        <div class="avatar"><img src="https://adami.outbuycenter.com.br/anexos/adami/images/avatares/242/avatar_min_242.jpg?63257"></div>
                         <div class="avatar-nome">RODRIGO NONATO.<br>Administrador</div>
                        <div class="avatar-flexa"><b class="caret"></b></div>
                    </a> 
                 </li>                 
                 <ul class=" dropdown-menu dropdown-menu dpm-avatar">
                     <li> 
                       <a href="https://adami.outbuycenter.com.br/obc/lgpd/avisoPrivacidade/avisoPrivacidade.php" target="main" class="dropdown-submenu">
                          <i class="fas fa-shield-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Politica de privacidade
                       </a>
                    </li>
                    <li> 
                       <a href="https://adami.outbuycenter.com.br/obc/cadastro/meus_dados.php" target="main" class="dropdown-submenu">
                          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Meus Dados
                       </a>
                    </li>
                    <li role="menuitem" class="divider"></li>
                    <li>
                       <a href="https://adami.outbuycenter.com.br/obc/logout.php">
                           <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Sair
                       </a>
                    </li>
                 </ul>
                 </ul>
            </div>
        </div>

        <div id="menu-obc-main-responsivo" class="menu-obc-main-responsivo menu-obc-main-responsivo-hide">
            <ul class="nav navbar-nav navbar-left menu-principal">
        </div>

        </div>