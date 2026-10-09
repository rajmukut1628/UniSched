<aside class="sidebar unisched-sidebar">
    <a class="unisched-brand" href="{{ route('admin.dashboard') }}">Uni<span>Sched</span></a>
    <nav aria-label="Main navigation">
        @include('admin.partials.navigation-links')
    </nav>
    <div class="unisched-account">
        <div>{{ auth()->user()->name }}</div>
        <div class="unisched-account-email">{{ auth()->user()->email }}</div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="unisched-logout">Logout</button>
        </form>
    </div>
</aside>
