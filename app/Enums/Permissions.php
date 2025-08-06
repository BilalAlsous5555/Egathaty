<?php

namespace App\Enums;

class Permissions
{
    /**
     * class is not used for creating new instances.
     */
    private function __construct() {}

    // =========================
    // Users & Roles Management
    // =========================
    public const USERS_CREATE        = 'users.create';
    public const USERS_UPDATE        = 'users.update';
    public const USERS_DELETE        = 'users.delete';
    public const USERS_VIEW          = 'users.view';
    public const USERS_VIEW_ANY      = 'users.viewAny';

    public const ROLES_CREATE        = 'roles.create';
    public const ROLES_UPDATE        = 'roles.update';
    public const ROLES_DELETE        = 'roles.delete';
    public const ROLES_VIEW          = 'roles.view';
    public const ROLES_VIEW_ANY      = 'roles.viewAny';

    // =========================
    // Donations Management
    // =========================
    // Donations
    public const DONATIONS_CREATE            = 'donations.create';
    public const DONATIONS_UPDATE            = 'donations.update';
    public const DONATIONS_DELETE            = 'donations.delete';
    public const DONATIONS_VIEW              = 'donations.view';
    public const DONATIONS_VIEW_ANY          = 'donations.viewAny';
    public const DONATIONS_VIEW_DOCUMENTS    = 'donations.viewDocuments';

    // Donors
    public const DONORS_CREATE       = 'donors.create';
    public const DONORS_UPDATE       = 'donors.update';
    public const DONORS_DELETE       = 'donors.delete';
    public const DONORS_VIEW         = 'donors.view';
    public const DONORS_VIEW_ANY     = 'donors.viewAny';

    // =========================
    // Inventory & Warehouse
    // =========================
    // Warehouses
    public const WAREHOUSES_CREATE   = 'warehouses.create';
    public const WAREHOUSES_UPDATE   = 'warehouses.update';
    public const WAREHOUSES_DELETE   = 'warehouses.delete';
    public const WAREHOUSES_VIEW     = 'warehouses.view';
    public const WAREHOUSES_VIEW_ANY = 'warehouses.viewAny';

    // Goods In/Out (Transactions)
    public const TRANSACTIONS_CREATE         = 'transactions.create';
    public const TRANSACTIONS_UPDATE         = 'transactions.update';
    public const TRANSACTIONS_DELETE         = 'transactions.delete';
    public const TRANSACTIONS_VIEW           = 'transactions.view';
    public const TRANSACTIONS_VIEW_ANY       = 'transactions.viewAny';
    public const TRANSACTIONS_DECIDE         = 'transactions.decide'; // accept/reject

    // =========================
    // Grouped Collections
    // =========================
    private array $users = [
        self::USERS_CREATE,
        self::USERS_UPDATE,
        self::USERS_DELETE,
        self::USERS_VIEW,
        self::USERS_VIEW_ANY,
    ];

    private array $roles = [
        self::ROLES_CREATE,
        self::ROLES_UPDATE,
        self::ROLES_DELETE,
        self::ROLES_VIEW,
        self::ROLES_VIEW_ANY,
    ];

    private array $donations = [
        self::DONATIONS_CREATE,
        self::DONATIONS_UPDATE,
        self::DONATIONS_DELETE,
        self::DONATIONS_VIEW,
        self::DONATIONS_VIEW_ANY,
        self::DONATIONS_VIEW_DOCUMENTS,
    ];

    private array $donors = [
        self::DONORS_CREATE,
        self::DONORS_UPDATE,
        self::DONORS_DELETE,
        self::DONORS_VIEW,
        self::DONORS_VIEW_ANY,
    ];

    private array $warehouses = [
        self::WAREHOUSES_CREATE,
        self::WAREHOUSES_UPDATE,
        self::WAREHOUSES_DELETE,
        self::WAREHOUSES_VIEW,
        self::WAREHOUSES_VIEW_ANY,
    ];

    private array $transactions = [
        self::TRANSACTIONS_CREATE,
        self::TRANSACTIONS_UPDATE,
        self::TRANSACTIONS_DELETE,
        self::TRANSACTIONS_VIEW,
        self::TRANSACTIONS_VIEW_ANY,
        self::TRANSACTIONS_DECIDE,
    ];

    // All permissions (for seeding)
    public static function all(): array
    {
        return array_values(array_unique(array_merge(
            self::$users,
            self::$roles,
            self::$donations,
            self::$donors,
            self::$warehouses,
            self::$transactions
        )));
    }
}
