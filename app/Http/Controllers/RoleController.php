<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\EditRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Request $request): Response
    {
        $this->authorize('viewAny', Role::class);

        $search = $request->get('search');

        $roles = Role::query()
            ->select('id', 'name')
            ->with('permissions')
            ->when($search, fn ($q) => $q
                ->where('name', 'like', '%'.transliterator_transliterate('Latin-Cyrillic', $search).'%')
                ->orWhere('name', 'like', '%'.transliterator_transliterate('Cyrillic-Latin', $search).'%')
            )
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $permissions = Permission::all();

        return Inertia::render('Role/Index', compact('roles', 'permissions'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::all();

        return Inertia::render('Role/Create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $this->authorize('create', Role::class);

        $role = Role::query()
            ->create($request->validated());

        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);

        return redirect(route('roles.index'))->with('success', 'Успешно ја додадовте оваа улога');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Role $role): Response
    {
        $this->authorize('update', Role::class);

        $permissions = Permission::all();
        $rolePermissions = $role->permissions;

        return Inertia::render('Role/Edit', compact('permissions', 'role', 'rolePermissions'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Role $role, EditRoleRequest $request): RedirectResponse
    {
        $this->authorize('update', Role::class);

        $role->fill($request->validated());
        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);

        $role->save();

        return redirect(route('roles.index'))->with('success', 'Успешно ја изменивте оваа улога');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('delete', Role::class);
        if ($role->users()->exists()) {
            return back()->with('error', 'Оваа улога е веќе доделена на корисници');
        }
        $role->delete();

        return back()->with('success', 'Успешно ја избришавте оваа улога');
    }
}
