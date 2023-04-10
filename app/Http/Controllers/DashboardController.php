<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        return inertia('Dashboard', [
            'users' => User::query()
                ->when($request->filled('search'), function ($query) use ($request) {
                    $query->where('name', 'like', "%" . $request->search . "%");
                })
                ->paginate(30)
                ->withQueryString()
                ->through(fn ($u) => [
                    'id' => $u->id,
                    'name' => $u->name,
                ]),

            'filters' => $request->only(['search'])
        ]);
    }
}
