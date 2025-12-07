<div class="row">
    <!-- Sidebar -->
    <div class="col-3">
        <div class="list-group shadow-sm">
            <li class="list-group-item list-group-item-action active">
                <a class="nav-link" href="{{ route('items.index') }}">Items</a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a class="nav-link" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>


        </div>
    </div>

    <!-- Main Content -->
    <div class="col-9">

        <div class="d-flex justify-content-between mb-3">
            <h4>My Items</h4>
            <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">
                ➕ Add New
            </a>
        </div>

        <!-- Filters -->
        <div class="card p-3 mb-3 shadow-sm">
            <div class="row g-2">

                <div class="col-md-3">
                    <input wire:model.live="search"
                           class="form-control"
                           placeholder="Search items...">
                </div>

                <div class="col-md-3">
                    <select wire:model.live="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select wire:model.live="status" class="form-select">
                        <option value="all">All Status</option>
                        <option value="available">Available</option>
                        <option value="gifted">Gifted</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Table -->
        <div class="card shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th width="80">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status=='gifted'?'secondary':'success' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>
                            <a href="#" wire:click="delete('{{$item->id}}')" class="btn btn-sm btn-outline-danger mt-2">
                                Delete
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            No items found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="p-3">
                {{ $items->links() }}
            </div>
        </div>

    </div>
</div>
