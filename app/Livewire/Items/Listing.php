<?php

namespace App\Livewire\Items;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;


    public $search = '';
    public $status = 'all';
    public $category = '';
    public $sort = 'latest';

    protected $queryString = ['search', 'status', 'category', 'sort', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Item::destroy($id);
        $this->resetPage();
    }

    public function render()
    {
        $query = Item::where('user_id', Auth::id());

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if ($this->sort === 'latest') {
            $query->latest();
        } else {
            $query->orderBy('title');
        }

        return view('livewire.items.listing', [
            'items' => $query->paginate(10),
            'categories' => Category::orderBy('name')->get()
        ])->layout('layouts.dashboard');
    }
}
