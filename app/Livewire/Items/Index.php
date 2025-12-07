<?php

namespace App\Livewire\Items;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\Category;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = null;
    public $status = 'available'; // available or gifted or all

    protected $queryString = ['search', 'category', 'city', 'status', 'sort', 'page'];

    public function updatedSearch($value)
    {
        $this->resetPage();
    }

    public function updatedCategory($value)
    {
        $this->resetPage();
    }

    public function updatingStatus($value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Item::with('photos', 'user', 'category');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->category) $query->where('category_id', $this->category);
        if ($this->status && $this->status !== 'all') $query->where('status', $this->status);

        $items = $query->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('livewire.items.index', compact('items', 'categories'));
    }
}
