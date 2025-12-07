<div>
    <div class="row">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>{{ $item->title }}</h3>
                    <p class="text-muted">{{ $item->category?->name }} • {{ $item->city }}</p>
                    <p>{{ $item->description }}</p>

                    <div class="mb-3 d-flex gap-2">
                        <button wire:click="vote('up')" class="btn btn-outline-success" @if($userVote === 1) disabled @endif>
                            👍 {{ $item->upvotes_count }}
                        </button>
                        <button wire:click="vote('down')" class="btn btn-outline-danger" @if($userVote === -1) disabled @endif>
                            👎 {{ $item->downvotes_count }}
                        </button>

                        @if(auth()->id() && auth()->id() === $item->user_id && $item->status !== 'gifted')
                            <button wire:click="markGifted" class="btn btn-secondary ms-2">Mark as gifted</button>
                        @endif

                        <span class="badge bg-{{ $item->isGifted() ? 'secondary' : 'success' }} ms-auto">{{ ucfirst($item->status) }}</span>
                    </div>

                    <div class="mb-3">
                        @foreach($item->photos as $photo)
                            <img src="{{ $photo->url() }}" style="max-width:120px; max-height:120px; object-fit:cover;" class="me-2 mb-2">
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Comments ({{ $item->comments->count() }})</div>
                <div class="card-body">
                    @auth
                        <div class="mb-2">
                            <textarea wire:model.defer="commentBody" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                            <div class="mt-2 text-end">
                                <button wire:click="addComment" class="btn btn-primary btn-sm">Comment</button>
                            </div>
                        </div>
                    @else
                        <p><a href="{{ route('login') }}">Login</a> to comment</p>
                    @endauth

                    @foreach($item->comments as $comment)
                        <div class="border rounded p-2 mb-2">
                            <strong>{{ $comment->user->name }}</strong> <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            <div>{{ $comment->body }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="col-md-5">
            <div class="card p-3">
                <p><strong>Posted by:</strong> {{ $item->user->name }}</p>
                <p><strong>Category:</strong> {{ $item->category?->name }}</p>
                <p><strong>City:</strong> {{ $item->city }}</p>
                <p><strong>Weight:</strong> {{ $item->weight_kg ?? 'N/A' }}</p>
                <p><strong>Dimensions:</strong> {{ $item->dimensions ?? 'N/A' }}</p>
            </div>

            @can('update', $item)
                <div class="mt-3">
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-primary w-100">Edit item</a>
                </div>
            @endcan
        </div>
    </div>
</div>
