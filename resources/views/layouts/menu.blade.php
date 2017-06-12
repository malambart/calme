<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Projet Calme
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @if (Auth::guest())
            @else
                <ul class="nav navbar-nav menu">
                    <li>
                        <a data-toggle="collapse" data-target="#dossier-menu" data-parent="#menu-item" role="button">
                            Dossiers
                            <span class="caret"></span>
                        </a>
                    </li>
                    @if(Auth::user()->role == 'superadmin')
                        <li>
                            <a data-toggle="collapse" data-target="#usagers-menu" data-parent="#menu-item"
                               role="button">
                                Usagers
                                <span class="caret"></span>
                            </a>
                        </li>
                    @endif
                </ul>
        @endif

        <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        @if( Auth::check() )
            <div id="menu-item">
                <div class="panel hidden-panel">
                    <div id="dossier-menu" class="collapse collapsing-menu">
                        <a href="{{url('dossiers/create')}}" class="btn btn-default menu-bouton">
                            <span class="glyphicon glyphicon-plus"></span>
                            Ajouter
                        </a>
                        <a href="{{url('dossiers/index')}}" class="btn btn-default menu-bouton">
                            <span class="glyphicon glyphicon-list"></span>
                            Liste
                        </a>
                        <form role="form" method="POST" action="{{ url('recherche') }}">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input placeholder="Recherche par nom,  id,  etc..." id="name" type="text"
                                       class="form-control"
                                       name="recherche" value="{{ old('name') }}" autofocus>
                                <span class="input-group-btn">
                    <button class="btn btn-primary">Recherche</button>
                            </span>
                            </div>
                        </form>
                    </div>
                </div>

                @if(Auth::user()->role == 'superadmin')
                    <div class="panel hidden-panel">
                        <div id="usagers-menu" class="collapse collapsing-menu">
                            <a href="{{url('utilisateurs/ajout')}}" class="btn btn-default menu-bouton">
                                <span class="glyphicon glyphicon-plus"></span>
                                Ajouter
                            </a>
                            <a href="{{url('utilisateurs')}}" class="btn btn-default menu-bouton">
                                <span class="glyphicon glyphicon-list"></span>
                                Liste
                            </a>
                        </div>
                    </div>

                @endif
            </div>
        @endif
    </div>
</nav>

