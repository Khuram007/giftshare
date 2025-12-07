<div>
    <form wire:submit.prevent="save">
        <div class="mb-3">
            <input wire:model="title" class="form-control" placeholder="Title">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <textarea wire:model="description" class="form-control" rows="4" placeholder="Description"></textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="row mb-3">
            <div class="col">
                <select wire:model="category_id" class="form-select">
                    <option value="">Select category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Photos</label>
            <input wire:model="photos" type="file" multiple class="form-control" />
            @error('photos.*') <small class="text-danger">{{ $message }}</small> @enderror
            <div class="mt-2">
                @if($photos)
                    @foreach($photos as $p)
                        <img src="{{ $p->temporaryUrl() }}" style="height:80px;object-fit:cover" class="me-2 mb-2"/>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
