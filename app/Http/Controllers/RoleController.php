<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Services\RoleServiceInterface;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Role;

class RoleController extends Controller
{
    public function __construct(
        protected readonly RoleRepositoryInterface $roleRepository,
        protected readonly PermissionRepositoryInterface $permissionRepository,
        protected readonly RoleServiceInterface $roleService
    ){
        $this->middleware('auth:admin');
    }

    /**
     * Muestra la vista de roles.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Roles/Index', [
            'roles' => $this->roleRepository->all(),
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Roles/Create', [
            'permissions' => $this->permissionRepository->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $this->roleService->create($request);
        return Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un rol.
     */
    public function edit(Role $role)
    {
        return Inertia::render('Admin/Roles/Edit', [
            'role' => $role,
            'rolePermissions' => $role->permissions,
            'permissions' => $this->permissionRepository->getPermissionsByGuard($role->guard_name),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleService->update($request, $role);
        return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
