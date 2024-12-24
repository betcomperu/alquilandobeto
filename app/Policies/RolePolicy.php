<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    protected function isAdmin(User $user)
    {
        return $user->hasRole('Administrador');
    }

    public function viewAny(User $user)
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, Role $role)
    {
        return $this->isAdmin($user);
    }

    public function create(User $user)
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, Role $role)
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, Role $role)
    {
        return $this->isAdmin($user);
    }

    public function restore(User $user, Role $role)
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, Role $role)
    {
        return $this->isAdmin($user);
    }
}
