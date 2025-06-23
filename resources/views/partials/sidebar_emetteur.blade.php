<div class="side-bar p-relative bg-white p-20">
    <h1 class="logo text-center p-relative">LISI</h1>
    <nav>
        <ul class="link">
            <li class="rad-6 tt-capital">
                <a href="{{ url('/purchase-order') }}" class="{{ request()->is('purchase-order') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-invoice fa-fw"></i>
                    <span class="hide-mobile">Bon de commande</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="{{ url('/my-budget') }}" class="{{ request()->is('my-budget') ? 'active' : '' }}">
                    <i class="fa-solid fa-wallet fa-fw"></i>
                    <span class="hide-mobile">Budget</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="{{ url('/order-tracking') }}" class="{{ request()->is('order-tracking') ? 'active' : '' }}">
                    <i class="fa-solid fa-list fa-fw"></i>
                    <span class="hide-mobile">Suivi BC</span>
                </a>
            </li>
            <li class="rad-6 tt-capital">
                <a href="{{ url('/transmitter-profile') }}" class="{{ request()->is('transmitter-profile') ? 'active' : '' }}">
                    <i class="fa-regular fa-user fa-fw"></i>
                    <span class="hide-mobile">Profil émetteur</span>
                </a>
            </li>
        </ul>
    </nav>
</div>