<?php

namespace App\Enums;

class Roles
{
    /**
     * class is not used for creating new instances.
     */
    private function __construct() {}

    // =========================
    // Roles List
    // =========================
    public const GENERAL_SYSTEM_ADMINISTRATOR     = 'General System Administrator';
    public const DONOR_ENTITY                     = 'Donor Entity';
    public const SUPPLIES_WAREHOUSE_MANAGER       = 'Supplies & Warehouse Manager';
    public const LOGISTICS_TRANSPORT_MANAGER      = 'Logistics & Transport Manager';
    public const FIELD_DISTRIBUTION_PROGRAM_MANAGER = 'Field Distribution Program Manager';
    public const FIELD_DISTRIBUTION_TEAM          = 'Field Distribution Team';
    public const FINAL_BENEFICIARY_HEAD_HOUSEHOLD = 'Final Beneficiary / Head of Household';
    public const QUALITY_CONTROL_AUDIT_OFFICER    = 'Quality Control / Audit Officer';

    // =========================
    // All Roles
    // =========================
    public static function all()
    {
        return [
            self::GENERAL_SYSTEM_ADMINISTRATOR,
            self::DONOR_ENTITY,
            self::SUPPLIES_WAREHOUSE_MANAGER,
            self::LOGISTICS_TRANSPORT_MANAGER,
            self::FIELD_DISTRIBUTION_PROGRAM_MANAGER,
            self::FIELD_DISTRIBUTION_TEAM,
            self::FINAL_BENEFICIARY_HEAD_HOUSEHOLD,
            self::QUALITY_CONTROL_AUDIT_OFFICER,
        ];
    }
}
