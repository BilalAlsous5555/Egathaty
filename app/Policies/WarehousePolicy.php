<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;
use App\Enums\Permissions;
use App\Enums\Roles;


class WarehousePolicy
{
    /**
     * Allow Super Administrator to bypass all authorization checks.
     *
     * @param User $user
     * @return bool|null
     */
    public function before(User $user): ?bool
    {
        if ($user->hasRole(Roles::GENERAL_SYSTEM_ADMINISTRATOR)) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any warehouses.
     * Requires 'view warehouses' permission.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::WAREHOUSES_VIEW_ANY);
    }

    /**
     * Determine whether the user can view a specific warehouse.
     * Requires 'view warehouses' permission.
     *
     * @param User $user
     * @param Warehouse $warehouse
     * @return bool
     */
    public function view(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo(Permissions::WAREHOUSES_VIEW);
    }

    /**
     * Determine whether the user can create new warehouses.
     * Requires 'create warehouses' permission.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::WAREHOUSES_CREATE);
    }

    /**
     * Determine whether the user can update a specific warehouse.
     * Requires 'update warehouses' permission.
     *
     * @param User $user
     * @param Warehouse $warehouse
     * @return bool
     */
    public function update(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo(Permissions::WAREHOUSES_UPDATE);
    }

    /**
     * Determine whether the user can delete a specific warehouse.
     * Requires 'delete warehouses' permission.
     *
     * @param User $user
     * @param Warehouse $warehouse
     * @return bool
     */
    public function delete(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo(Permissions::WAREHOUSES_DELETE);
    }

    /**
     * Determine whether the user can restore the model (for soft deletes).
     *
     * @param User $user
     * @param Warehouse $warehouse
     * @return bool
     */
    public function restore(User $user, Warehouse $warehouse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model (for soft deletes).
     *
     * @param User $user
     * @param Warehouse $warehouse
     * @return bool
     */
    public function forceDelete(User $user, Warehouse $warehouse): bool
    {
        return false; 
    }
}
