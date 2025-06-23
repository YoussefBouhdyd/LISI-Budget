<div class="header d-flex p-20 flex-end align-c bg-white p-relative">
    <div class="profile flex-between">
        <button id="notification-btn" class="notification-btn">
            <i class="fa-regular fa-bell fa-lg mr-20 p-relative">
                <span class="notification-dot"></span>
            </i>
        </button>
        <div id="notification-box" class="notification-box">
            <div class="notification-header">
                Notifications
            </div>
            <div class="notification-content" style="padding:0;">
                <ul class="notification-list" id="notification-list">
                    <li>
                        <span class="notif-title">Nouvelle demande d'engagement</span>
                        <span class="notif-time">il y a 2 min</span>
                        <span class="notif-eye" title="Marquer comme lu">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </li>
                    <li>
                        <span class="notif-title">Budget mis à jour</span>
                        <span class="notif-time">il y a 10 min</span>
                        <span class="notif-eye" title="Marquer comme lu">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </li>
                    <li>
                        <span class="notif-title">Profil modifié avec succès</span>
                        <span class="notif-time">il y a 1 heure</span>
                        <span class="notif-eye" title="Marquer comme lu">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
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