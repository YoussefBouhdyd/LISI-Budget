<div class="side-bar p-relative bg-white p-20">
    <h1 class="logo text-center p-relative">LISI</h1>
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
                <a href="{{ url('/profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="fa-regular fa-user fa-fw"></i>
                    <span class="hide-mobile">Profil</span>
                </a>
            </li>
        </ul>
    </nav>
</div>