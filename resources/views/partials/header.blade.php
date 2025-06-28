<div class="header d-flex p-20 s-between align-c bg-white p-relative">
    @if (Auth::user()->role === 'admin')
            <h2>Admin</h3>
    @elseif (Auth::user()->role === 'user')
        <div class="p-10 fit-content bg-blue rad-6 fw-bold c-white">
            {{ Auth::user()->budget - Auth::user()->budgetProposals->sum('spend') }} MAD
        </div>
    @endif
    <div class="profile flex-between">
        <button id="profile-btn" class="profile-btn profile-btn-style pointer">
            <img src="{{ asset('/imgs/user-profile.svg') }}" alt="user profile" class="rad-half">
        </button>
        <div id="profile-box" class="profile-box profile-box-style">
            <div class="profile-box-header">
            <div class="profile-box-name">{{ Auth::user()->name }}</div>
            <div class="profile-box-email">{{ Auth::user()->email }}</div>
            </div>
            <form method="POST" action="{{ route('auth.logout') }}" class="profile-box-form">
            @csrf
            <button type="submit" class="profile-box-logout-btn">
                Se déconnecter
            </button>
            </form>
        </div>
    </div>
</div>