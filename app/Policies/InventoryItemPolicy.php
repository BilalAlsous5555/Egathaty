<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InventoryItem;
use App\Enums\Permissions;
use App\Enums\Roles;

class InventoryItemPolicy
{
    /**
     * Allow Super Administrator to bypass all authorization checks.
     *
     * @param User $user
     * @param string $ability
     * @return bool|null
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole(Roles::GENERAL_SYSTEM_ADMINISTRATOR)) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any inventory items.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::INVENTORY_VIEW_ANY);
    }

    /**
     * Determine whether the user can view a specific inventory item.
     *
     * @param User $user
     * @param InventoryItem $inventoryItem
     * @return bool
     */
    public function view(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->hasPermissionTo(Permissions::INVENTORY_VIEW);
    }

    /**
     * Determine whether the user can create new inventory items.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::INVENTORY_CREATE);
    }

    /**
     * Determine whether the user can update a specific inventory item.
     *
     * @param User $user
     * @param InventoryItem $inventoryItem
     * @return bool
     */
    public function update(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->hasPermissionTo(Permissions::INVENTORY_UPDATE);
    }

    /**
     * Determine whether the user can delete a specific inventory item.
     *
     * @param User $user
     * @param InventoryItem $inventoryItem
     * @return bool
     */
    public function delete(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->hasPermissionTo(Permissions::INVENTORY_DELETE);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param InventoryItem $inventoryItem
     * @return bool
     */
    public function restore(User $user, InventoryItem $inventoryItem): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param InventoryItem $inventoryItem
     * @return bool
     */
    public function forceDelete(User $user, InventoryItem $inventoryItem): bool
    {
        return false;
    }
}
