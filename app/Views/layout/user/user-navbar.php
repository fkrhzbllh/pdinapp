<!-- Topbar -->
<nav class="navbar navbar-expand bg-white topbar mb-4 static-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
        <i class="bi bi-list"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ms-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="me-2 d-none d-lg-inline small"><?= auth()->user()->first_name . " " .  auth()->user()->last_name ?></span>
                <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?size=128&name=<?= urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) ?>&rounded=true&background=d82328&color=ffffff&bold=true">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/atur-profil">
                    <i class="icon bi bi-person-circle me-2 text-gray-400"></i>
                    Atur Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">
                    <i class="bi bi-box-arrow-left me-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->