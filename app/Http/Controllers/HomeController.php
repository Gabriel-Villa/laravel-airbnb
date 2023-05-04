<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Listing::with(['location', 'category', 'image'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('category',function($query) use($request) {
                    $query->where('name', 'like', "%" . $request->search . "%");
                });
            })
            ->paginate(30)
            ->withQueryString()
            ->through(fn ($u) => [
                'id' => $u->id,
                'name' => $u->name,
                'slug' => $u->slug,
                'price' => $u->price,
                'title' => $u->title,
                'category' => $u->category->name ?? '',
                'location' => $u->location->name ?? '',
                'image' => $u->image->url ?? '',
            ]);

        return inertia('Home', [
            'listings' => $query,

            'filters' => $request->only(['search'])
        ]);
    }
}
