<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Donor;
use App\Enums\Permissions;
use App\Enums\Roles;

class DonorPolicy
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
     * Determine whether the user can view any donors.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::DONORS_VIEW_ANY);
    }

    /**
     * Determine whether the user can view a specific donor.
     *
     * @param User $user .
     * @param Donor $donor
     * @return bool
     */
    public function view(User $user, Donor $donor): bool
    {
        return $user->hasPermissionTo(Permissions::DONORS_VIEW);
    }

    /**
     * Determine whether the user can create new donors.
     *
     * @param User $user The authenticated user.
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::DONORS_CREATE);
    }

    /**
     * Determine whether the user can update a specific donor.
     *
     * @param User $user The authenticated user.
     * @param Donor $donor The Donor model instance.
     * @return bool
     */
    public function update(User $user, Donor $donor): bool
    {
        return $user->hasPermissionTo(Permissions::DONORS_UPDATE);
    }

    /**
     * Determine whether the user can delete a specific donor.
     *
     * @param User $user The authenticated user.
     * @param Donor $donor The Donor model instance.
     * @return bool
     */
    public function delete(User $user, Donor $donor): bool
    {
        return $user->hasPermissionTo(Permissions::DONORS_DELETE);
    }

    public function restore(User $user, Donor $donor): bool
    {
        return false;
    }

    public function forceDelete(User $user, Donor $donor): bool
    {
        return false;
    }
}
