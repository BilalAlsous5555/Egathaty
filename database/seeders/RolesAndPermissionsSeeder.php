<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\Permissions;
use App\Enums\Roles;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $guardName = 'web';

        // 1. Define all Permissions
        $allPermissions = [
                // Users & Roles Management
            Permissions::USERS_CREATE,
            Permissions::USERS_UPDATE,
            Permissions::USERS_DELETE,
            Permissions::USERS_VIEW,
            Permissions::USERS_VIEW_ANY,
            Permissions::ROLES_CREATE,
            Permissions::ROLES_UPDATE,
            Permissions::ROLES_DELETE,
            Permissions::ROLES_VIEW,
            Permissions::ROLES_VIEW_ANY,

                // Donations Management
            Permissions::DONATIONS_CREATE,
            Permissions::DONATIONS_UPDATE,
            Permissions::DONATIONS_DELETE,
            Permissions::DONATIONS_VIEW,
            Permissions::DONATIONS_VIEW_ANY,
            Permissions::DONATIONS_VIEW_DOCUMENTS,
            Permissions::DONORS_CREATE,
            Permissions::DONORS_UPDATE,
            Permissions::DONORS_DELETE,
            Permissions::DONORS_VIEW,
            Permissions::DONORS_VIEW_ANY,

                // Inventory & Warehouse
            Permissions::WAREHOUSES_CREATE,
            Permissions::WAREHOUSES_UPDATE,
            Permissions::WAREHOUSES_DELETE,
            Permissions::WAREHOUSES_VIEW,
            Permissions::WAREHOUSES_VIEW_ANY,
            Permissions::TRANSACTIONS_CREATE,
            Permissions::TRANSACTIONS_UPDATE,
            Permissions::TRANSACTIONS_DELETE,
            Permissions::TRANSACTIONS_VIEW,
            Permissions::TRANSACTIONS_VIEW_ANY,
            Permissions::TRANSACTIONS_DECIDE,

                // Inventory Items Permissions (Specific)
            Permissions::INVENTORY_CREATE,
            Permissions::INVENTORY_UPDATE,
            Permissions::INVENTORY_DELETE,
            Permissions::INVENTORY_VIEW,
            Permissions::INVENTORY_VIEW_ANY,

                // General / Other Modules Permissions (now all from Enums)
            Permissions::DISTRIBUTIONS_VIEW,
            Permissions::DISTRIBUTIONS_MANAGE,
            Permissions::BENEFICIARIES_VIEW,
            Permissions::BENEFICIARIES_MANAGE,
            Permissions::AUDIT_LOGS_VIEW,
            Permissions::QUALITY_CONTROL_MANAGE,
        ];

        foreach ($allPermissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => $guardName]);
        }

        $superAdminRole = Role::firstOrCreate(['name' => Roles::GENERAL_SYSTEM_ADMINISTRATOR, 'guard_name' => $guardName]);
        $donorRole = Role::firstOrCreate(['name' => Roles::DONOR_ENTITY, 'guard_name' => $guardName]);
        $supplyManagerRole = Role::firstOrCreate(['name' => Roles::SUPPLIES_WAREHOUSE_MANAGER, 'guard_name' => $guardName]);
        $logisticsManagerRole = Role::firstOrCreate(['name' => Roles::LOGISTICS_TRANSPORT_MANAGER, 'guard_name' => $guardName]);
        $fieldProgramManagerRole = Role::firstOrCreate(['name' => Roles::FIELD_DISTRIBUTION_PROGRAM_MANAGER, 'guard_name' => $guardName]);
        $fieldTeamRole = Role::firstOrCreate(['name' => Roles::FIELD_DISTRIBUTION_TEAM, 'guard_name' => $guardName]);
        $finalBeneficiaryRole = Role::firstOrCreate(['name' => Roles::FINAL_BENEFICIARY_HEAD_HOUSEHOLD, 'guard_name' => $guardName]);
        $qualityMonitorRole = Role::firstOrCreate(['name' => Roles::QUALITY_CONTROL_AUDIT_OFFICER, 'guard_name' => $guardName]);



        $superAdminRole->givePermissionTo(Permission::all());

        $donorRole->givePermissionTo(Permissions::DONATIONS_VIEW_ANY);

        $supplyManagerRole->givePermissionTo([
            Permissions::DONORS_VIEW_ANY,
            Permissions::DONORS_CREATE,
            Permissions::DONORS_UPDATE,
            Permissions::DONATIONS_VIEW_ANY,
            Permissions::WAREHOUSES_VIEW_ANY,
            Permissions::WAREHOUSES_CREATE,
            Permissions::WAREHOUSES_UPDATE,
            Permissions::WAREHOUSES_DELETE,
            Permissions::TRANSACTIONS_VIEW_ANY,
            Permissions::TRANSACTIONS_CREATE,
            Permissions::TRANSACTIONS_UPDATE,
            Permissions::TRANSACTIONS_DELETE,
            Permissions::INVENTORY_VIEW_ANY,
            Permissions::INVENTORY_CREATE,
            Permissions::INVENTORY_UPDATE,
            Permissions::INVENTORY_DELETE,
        ]);

        $logisticsManagerRole->givePermissionTo([
            Permissions::DONORS_VIEW_ANY,
            Permissions::DONATIONS_VIEW_ANY,
            Permissions::WAREHOUSES_VIEW_ANY,
            Permissions::TRANSACTIONS_VIEW_ANY,
            Permissions::TRANSACTIONS_DECIDE,
            Permissions::INVENTORY_VIEW_ANY,
            Permissions::DISTRIBUTIONS_VIEW,
            Permissions::DISTRIBUTIONS_MANAGE,
        ]);

        $fieldProgramManagerRole->givePermissionTo([
            Permissions::DONORS_VIEW_ANY,
            Permissions::DONATIONS_VIEW_ANY,
            Permissions::WAREHOUSES_VIEW_ANY,
            Permissions::TRANSACTIONS_VIEW_ANY,
            Permissions::INVENTORY_VIEW_ANY,
            Permissions::DISTRIBUTIONS_VIEW,
            Permissions::DISTRIBUTIONS_MANAGE,
            Permissions::BENEFICIARIES_VIEW,
        ]);

        $fieldTeamRole->givePermissionTo([
            Permissions::DONORS_VIEW_ANY,
            Permissions::DONATIONS_VIEW_ANY,
            Permissions::INVENTORY_VIEW_ANY,
            Permissions::BENEFICIARIES_VIEW,
            Permissions::BENEFICIARIES_MANAGE,
            Permissions::DISTRIBUTIONS_VIEW,
        ]);

        $finalBeneficiaryRole->givePermissionTo([
        ]);

        $qualityMonitorRole->givePermissionTo([
            Permissions::DONORS_VIEW_ANY,
            Permissions::DONATIONS_VIEW_ANY,
            Permissions::WAREHOUSES_VIEW_ANY,
            Permissions::TRANSACTIONS_VIEW_ANY,
            Permissions::INVENTORY_VIEW_ANY,
            Permissions::DISTRIBUTIONS_VIEW,
            Permissions::BENEFICIARIES_VIEW,
            Permissions::AUDIT_LOGS_VIEW,
            Permissions::QUALITY_CONTROL_MANAGE,
        ]);



    }
}
