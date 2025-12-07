<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ItemController extends Controller
{

    public function index()
    {
        return view('items.listing');
    }
    public function create()
    {
        return view('items.create');
   }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
   }

   public function show(Item $item)
    {
        return view('items.show', ['item' => $item]);
   }
}
