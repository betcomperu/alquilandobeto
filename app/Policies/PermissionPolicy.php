<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    protected function isAdmin(User $user)
    {
        return $user->hasRole('Administrador');
    }

    public function viewAny(User $user)
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, Permission $permission)
    {
        return $this->isAdmin($user);
    }

    public function create(User $user)
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, Permission $permission)
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, Permission $permission)
    {
        return $this->isAdmin($user);
    }

    public function restore(User $user, Permission $permission)
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, Permission $permission)
    {
        return $this->isAdmin($user);
    }
}
