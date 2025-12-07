<?php

namespace App\Livewire\Items;

use Livewire\Component;
use App\Models\Item;
use App\Models\Vote;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $item;
    public $commentBody = '';

    protected $listeners = ['itemUpdated' => '$refresh'];

    public function mount(Item $item)
    {
        $this->item = $item;
    }

    public function vote($type)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $value = $type === 'up' ? 1 : -1;

        $vote = Vote::firstOrNew([
            'item_id' => $this->item->id,
            'user_id' => $user->id,
        ]);

        // If same vote exists -> remove (toggle)
        if ($vote->exists && $vote->vote == $value) {
            // remove vote
            $vote->delete();
            if ($value === 1) $this->item->decrement('upvotes_count');
            else $this->item->decrement('downvotes_count');
        } else {
            // switching or new vote
            // if existing opposite, adjust counts
            if ($vote->exists) {
                if ($vote->vote === 1) $this->item->decrement('upvotes_count');
                if ($vote->vote === -1) $this->item->decrement('downvotes_count');
            }
            $vote->vote = $value;
            $vote->save();

            if ($value === 1) $this->item->increment('upvotes_count');
            else $this->item->increment('downvotes_count');
        }

        // reload item
        $this->item->refresh();
    }

    public function addComment()
    {
        $this->validate(['commentBody' => 'required|min:2|max:1000']);
        $comment = Comment::create([
            'item_id' => $this->item->id,
            'user_id' => auth()->id(),
            'body' => $this->commentBody,
        ]);
        $this->commentBody = '';
        $this->item->refresh();
//        $this->emit('itemUpdated');
    }

    public function markGifted()
    {
        if (auth()->id() !== $this->item->user_id) abort(403);
        $this->item->update(['status' => 'gifted']);
        $this->item->refresh();
    }

    public function render()
    {
        $this->item->load('photos', 'comments.user', 'category', 'user');
        $userVote = null;
        if (auth()->check()) {
            $v = $this->item->votes()->where('user_id', auth()->id())->first();
            $userVote = $v ? $v->vote : null;
        }
        return view('livewire.items.show', ['userVote' => $userVote])->layout('layouts.app');
    }
}
