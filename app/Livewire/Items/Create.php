<?php

namespace App\Livewire\Items;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Item;
use App\Models\ItemPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Create extends Component
{
    use WithFileUploads;

    public $id;
    public $item;
    public $title, $description, $category_id, $weight_kg, $dimensions, $status = 'available';
    public $photos = []; // temporary uploaded files
    public $existingPhotos = [];

    public function mount(Item $item = null)
    {
        if ($item) {
            $this->id = $item->id;
            $this->item = $item;
            $this->title = $item->title;
            $this->description = $item->description;
            $this->category_id = $item->category_id;
            $this->weight_kg = $item->weight_kg;
            $this->dimensions = $item->dimensions;
            $this->status = $item->status;
            $this->existingPhotos = $item->photos()->get()->toArray();
        }
    }

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|max:2000',
            'category_id' => 'required|exists:categories,id',
            'weight_kg' => 'nullable|numeric',
            'dimensions' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['available', 'gifted'])],
            'photos.*' => 'image|max:5120' // 5MB
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'weight_kg' => $this->weight_kg,
            'dimensions' => $this->dimensions,
            'status' => $this->status,
            'user_id' => auth()->id()
        ];

        if ($this->id) {
            $this->item->update($data);
        } else {
            $this->item = Item::create($data);
        }

        // handle uploads
        foreach ($this->photos as $index => $p) {
            $path = $p->store('items', 'public');
            ItemPhoto::create([
                'item_id' => $this->item->id,
                'path' => $path,
            ]);
        }

        // reset photo input
        $this->photos = [];
        session()->flash('message', 'Item saved.');
        return redirect()->route('items.index');
    }

    public function render()
    {
        return view('livewire.items.create', [
            'categories' => \App\Models\Category::orderBy('name')->get()
        ])->layout('layouts.app');
    }
}
