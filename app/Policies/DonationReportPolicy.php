<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DonationReport;
use App\Enums\Permissions;
use App\Enums\Roles;
use Illuminate\Auth\Access\Response;

class DonationReportPolicy
{
    /**
     * Allow Super Administrator to bypass all authorization checks.
     *
     * @param User $user The authenticated user.
     * @param string $ability The ability being checked (e.g., 'create', 'view').
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
     * Determine whether the user can view any donation reports.
     *
     * @param User $user The authenticated user.
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::DONATIONS_VIEW_ANY);
    }

    /**
     * Determine whether the user can view a specific donation report.
     *
     * @param User $user The authenticated user.
     * @param DonationReport $donationReport The DonationReport model instance.
     * @return bool
     */
    public function view(User $user, DonationReport $donationReport): bool
    {
        return $user->hasPermissionTo(Permissions::DONATIONS_VIEW);
    }

    /**
     * Determine whether the user can create new donation reports.
     *
     * @param User $user The authenticated user.
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::DONATIONS_CREATE);
    }

    /**
     * Determine whether the user can update a specific donation report.
     *
     * @param User $user The authenticated user.
     * @param DonationReport $donationReport The DonationReport model instance.
     * @return bool
     */
    public function update(User $user, DonationReport $donationReport): bool
    {
        return $user->hasPermissionTo(Permissions::DONATIONS_UPDATE);
    }

    /**
     * Determine whether the user can delete a specific donation report.
     *
     * @param User $user The authenticated user.
     * @param DonationReport $donationReport The DonationReport model instance.
     * @return bool
     */
    public function delete(User $user, DonationReport $donationReport): bool
    {
        return $user->hasPermissionTo(Permissions::DONATIONS_DELETE);
    }

    public function restore(User $user, DonationReport $donationReport): bool
    {
        return false;
    }

    public function forceDelete(User $user, DonationReport $donationReport): bool
    {
        return false;
    }
}
