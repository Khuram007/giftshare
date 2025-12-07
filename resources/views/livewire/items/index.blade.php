
<div>
    <div class="mb-3 d-flex gap-2">
        <input wire:model.live="search" id="lksdjf" class="form-control" placeholder="Search title or description..." >
        <select wire:model.live="category" class="form-select">
            <option value="">All categories</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}"  wire:key="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>

        <select wire:model.live="status" class="form-select">
            <option value="available">Available</option>
            <option value="gifted">Gifted</option>
            <option value="all">All</option>
        </select>

    </div>

    <div class="row">
        @forelse($items as $item)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    @if($item->photos->count())
                        <img src="{{ $item->photos->first()->url() }}" class="card-img-top" style="height:250px;object-fit:cover">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px">
                            <span class="text-muted">No photo</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('items.show', $item) }}">{{ Str::limit($item->title, 60) }}</a>
                        </h5>
                        <p class="mb-1"><small class="text-muted">{{ $item->category?->name }} • {{ $item->city }}</small></p>
                        <p class="card-text">{{ Str::limit($item->description, 120) }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                        <span class="badge bg-{{ $item->isGifted() ? 'secondary' : 'success' }}">{{ ucfirst($item->status) }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">No items found.</div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $items->links() }}
    </div>
</div>
