<div class="side-bar p-relative bg-white p-20">
    <h1 class="logo txt-c p-relative">LISI</h1>
    <nav>
        <ul class="link">
            <li class="rad-6 tt-capital">
                <a href="{{ url('/admin') }}" class="{{ request()->is('admin') ? 'active' : '' }}">
                    <i class="fa-regular fa-chart-bar fa-fw"></i>
                    <span class="hide-mobile">Dashboard</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="{{ url('/admin-engagement') }}" class="{{ request()->is('admin-engagement*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-signature fa-fw"></i>
                    <span class="hide-mobile">Engagements</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="{{ url('/transmitter') }}" class="{{ request()->is('transmitter*') ? 'active' : '' }}">
                    <i class="fa-solid fa-paper-plane fa-fw"></i>
                    <span class="hide-mobile">Émetteur</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="{{ url('/budget') }}" class="{{ request()->is('budget*') ? 'active' : '' }}">
                    <i class="fa-solid fa-wallet fa-fw"></i>
                    <span class="hide-mobile">Budget</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="setting.html" class="{{ request()->is('setting') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear fa-fw"></i>
                    <span class="hide-mobile">Paramètre</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="profile.html" class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="fa-regular fa-user fa-fw"></i>
                    <span class="hide-mobile">Profil</span>
                </a>
            </li>
        </ul>
    </nav>
</div>