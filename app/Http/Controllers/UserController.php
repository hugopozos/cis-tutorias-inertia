<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Repositories\UniversityCareerRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserServiceInterface $userService,
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly UniversityCareerRepositoryInterface $universityCareerRepository,
        protected readonly RoleRepositoryInterface $roleRepository,

    ){
        $this->middleware('auth:admin');
    }

    /**
     * Muestra la vista de usuarios.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Users/Index', [
            'users' => $this->userRepository->all(),
            'filters' => $this->userRepository->getFilters(),
        ]);
    }

    /**
     * Muestra la vista de creación de usuarios.
     */
    public function create()
    {
        //
    }

    /**
     * Almacena un usuario en la base de datos.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra la vista de edición de usuarios.
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'careers' => $this->universityCareerRepository->all(),
            'roles' => $this->roleRepository->getUserRoles(),
        ]);
    }

    /**
     * Actualiza un usuario en la base de datos.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($request, $user);
        return Redirect::route('users.index');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return Redirect::route('users.index');
    }
}
