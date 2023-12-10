<!-- NAVBAR -->
<nav id="nav-dashboard" class="justify-content-between">
    <div class="toggle-sidebar p-2">
        <i class="bi bi-list"></i>
    </div>
    <div>
        <!-- <span class="divider"></span> -->
        <div class="profile">
            <div class="divider"></div>
            <img src="https://ui-avatars.com/api/?size=128&name=<?= urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) ?>&rounded=true&background=d82328&color=ffffff&bold=true" alt="" />
            <ul class="profile-link" data-bs-auto-close="true">
                <!-- <li>
                                <a href="#"><i class="icon bi bi-person-circle"></i> Profile</a>
                            </li> -->

                <li>
                    <a href="/logout"><i class="bi bi-box-arrow-left"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR -->