<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(Request::input('perPage') ?: 5)
            ->withQueryString();
    }

    public function getFilters()
    {
        Return Request::only('search');
    }

    public function findById($request)
    {
        return User::findOrFail($request);
    }


}
