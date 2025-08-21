<?php

namespace App\Policies;

use App\Models\User; // Assuming your User model uses Spatie's HasRoles trait
use App\Models\DonationReport;
use App\Enums\Permissions; // Import Permissions enum-like class
use App\Enums\Roles;      // Import Roles enum-like class
use Illuminate\Support\Facades\Log; // تأكد من استيراد Log facade هنا
use Illuminate\Auth\Access\Response;

class DonationReportPolicy
{
    /**
     * Allow Super Administrator to bypass all authorization checks.
     * This method is automatically called before any other policy method.
     *
     * @param User $user The authenticated user.
     * @param string $ability The ability being checked (e.g., 'create', 'view').
     * @return bool|null
     */
    public function before(User $user, string $ability)
    {
        // Log Point A: Check user details and roles before any specific permission check
        Log::debug('DonationReportPolicy BEFORE method triggered:', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_roles' => $user->getRoleNames()->toArray(), // Get roles from Spatie
            'ability_being_checked' => $ability,
            'is_super_admin_by_role' => $user->hasRole(Roles::GENERAL_SYSTEM_ADMINISTRATOR),
            'all_user_permissions' => $user->getAllPermissions()->pluck('name')->toArray() // Get all permissions user has
        ]);

        if ($user->hasRole(Roles::GENERAL_SYSTEM_ADMINISTRATOR)) {
            Log::debug('DonationReportPolicy: Super Admin bypass granted.');
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
        Log::debug('DonationReportPolicy VIEW_ANY method triggered:', [
            'user_id' => $user->id,
            'has_permission' => $user->hasPermissionTo(Permissions::DONATIONS_VIEW_ANY)
        ]);
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
        // Log Point B: Check user details and permission specifically for 'view'
        Log::debug('DonationReportPolicy VIEW method triggered:', [
            'user_id' => $user->id,
            'report_id' => $donationReport->id,
            'has_permission' => $user->hasPermissionTo(Permissions::DONATIONS_VIEW)
        ]);
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
        Log::debug('DonationReportPolicy CREATE method triggered:', [
            'user_id' => $user->id,
            'has_permission' => $user->hasPermissionTo(Permissions::DONATIONS_CREATE)
        ]);
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
        Log::debug('DonationReportPolicy UPDATE method triggered:', [
            'user_id' => $user->id,
            'report_id' => $donationReport->id,
            'has_permission' => $user->hasPermissionTo(Permissions::DONATIONS_UPDATE)
        ]);
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
        // Log Point C: Check user details and permission specifically for 'delete'
        Log::debug('DonationReportPolicy DELETE method triggered:', [
            'user_id' => $user->id,
            'report_id' => $donationReport->id,
            'has_permission' => $user->hasPermissionTo(Permissions::DONATIONS_DELETE)
        ]);
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
