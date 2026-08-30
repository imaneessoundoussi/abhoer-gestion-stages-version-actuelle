<aside class="sidebar">

    <div class="sidebar-logo">

        <img src="{{ asset('images/logo.png') }}"
             alt="ABHOER">

        <div>
            <strong>ABHOER</strong>
            <small>
                Agence du Bassin Hydraulique
                de l'Oum Er-Rbia
            </small>
        </div>

    </div>


    <nav class="sidebar-menu">

        <a href="{{ route('etudiant.dashboard') }}"
           class="{{ request()->routeIs('etudiant.dashboard') ? 'active' : '' }}">

            <span>▦</span>
            <span>Tableau de bord</span>

        </a>


        <a href="{{ route('etudiant.demandes') }}"
           class="{{ request()->routeIs('etudiant.demandes') ? 'active' : '' }}">

            <span>▤</span>
            <span>Mes demandes</span>

        </a>


        <a href="{{ route('etudiant.demande.create') }}"
           class="{{ request()->routeIs('etudiant.demande.*') ? 'active' : '' }}">

            <span>＋</span>
            <span>Nouvelle demande</span>

        </a>


        <a href="{{ route('etudiant.documents') }}"
           class="{{ request()->routeIs('etudiant.documents') ? 'active' : '' }}">

            <span>▣</span>
            <span>Mes documents</span>

        </a>


        <a href="{{ route('etudiant.profil') }}"
           class="{{ request()->routeIs('etudiant.profil') ? 'active' : '' }}">

            <span>♙</span>
            <span>Profil</span>

        </a>


        <a href="#" class="notification-link">

            <span>♧</span>
            <span>Notifications</span>

            <span class="notification-badge">3</span>

        </a>

    </nav>


    <form method="POST"
          action="{{ route('logout') }}"
          class="logout-form">

        @csrf

        <button type="submit">

            <span>↪</span>
            Déconnexion

        </button>

    </form>

</aside>