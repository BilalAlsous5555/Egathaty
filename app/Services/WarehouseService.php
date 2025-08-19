<?php

namespace App\Services;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WarehouseService
{
    /**
     * Retrieve all warehouse records.
     *
     * @return Collection
     */
    public function getAllWarehouses(): Collection
    {
        return Warehouse::all();
    }

    /**
     * Find a single warehouse record by ID.
     *
     * @param int $id
     * @return Warehouse|null
     */
    public function getWarehouseById(int $id): ?Warehouse
    {
        return Warehouse::find($id);
    }

    /**
     * Create a new warehouse record.
     *
     * @param Request $request The validated request data.
     * @return Warehouse
     */
    public function createWarehouse(Request $request): Warehouse
    {
        return DB::transaction(function () use ($request) {
            $warehouse = Warehouse::create($request->validated());
            return $warehouse;
        });
    }

    /**
     * Update an existing warehouse record.
     *
     * @param Request $request
     * @param Warehouse $warehouse
     * @return Warehouse
     */
    public function updateWarehouse(Request $request, Warehouse $warehouse): Warehouse
    {
        return DB::transaction(function () use ($request, $warehouse) {
            $warehouse->update($request->validated());
            $warehouse->refresh();
            return $warehouse;
        });
    }

    /**
     * Delete a warehouse record.
     *
     * @param Warehouse $warehouse
     * @return bool
     */
    public function deleteWarehouse(Warehouse $warehouse): bool
    {
        try {
            return DB::transaction(function () use ($warehouse) {
                return (bool) $warehouse->delete();
            });
        } catch (\Exception $e) {
            Log::error('Error deleting warehouse: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return false;
        }
    }
}
