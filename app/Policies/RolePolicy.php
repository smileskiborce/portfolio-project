<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Role::SUPER_ADMIN->value);
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo(Role::SUPER_ADMIN->value);
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(Role::SUPER_ADMIN->value);
    }
}
