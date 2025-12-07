<x-app-layout>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-3">
            <div class="list-group shadow-sm">
                <a href="/dashboard" class="list-group-item list-group-item-action active">
                    Dashboard
                </a>
                <a href="{{ route('items.create') }}" class="list-group-item list-group-item-action">
                    ➕ Add New Item
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    My Profile
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Settings
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-9">
            @yield('content')
        </div>
    </div>
</x-app-layout>
