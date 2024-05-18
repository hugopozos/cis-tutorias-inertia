<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Models\Role;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ){}

    public function update($request, $user)
    {
        $user->fill($request->validated());

        $role = Role::findByName($request->role, 'web');

        $user->syncRoles([$role]);

        $user->save();
    }

    public function destroy($user)
    {
        $user->delete();
    }

}
