<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Inmueble;
use App\Models\User;

class InmueblePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Inmueble');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Inmueble $inmueble): bool
    {
        return $user->checkPermissionTo('view Inmueble');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Inmueble');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Inmueble $inmueble): bool
    {
        return $user->checkPermissionTo('update Inmueble');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Inmueble $inmueble): bool
    {
        return $user->checkPermissionTo('delete Inmueble');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Inmueble');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Inmueble $inmueble): bool
    {
        return $user->checkPermissionTo('restore Inmueble');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Inmueble');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Inmueble $inmueble): bool
    {
        return $user->checkPermissionTo('replicate Inmueble');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Inmueble');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Inmueble $inmueble): bool
    {
        return $user->checkPermissionTo('force-delete Inmueble');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Inmueble');
    }
}
