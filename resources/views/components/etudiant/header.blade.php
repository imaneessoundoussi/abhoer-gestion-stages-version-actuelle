<header class="top-header">

    <div class="header-title">

        <span class="badge-student">
            Espace Étudiant
        </span>

    </div>


    <div class="header-user">

        <div class="notification-icon">
            ♧
            <span>3</span>
        </div>


        <div class="user-info">

            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}
            </div>

            <div>

                <strong>
                    {{ Auth::user()->prenom }}
                    {{ Auth::user()->nom }}
                </strong>

                <small>
                    Étudiant
                </small>

            </div>

        </div>

    </div>

</header>