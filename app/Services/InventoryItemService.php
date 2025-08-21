<?php

namespace App\Services;

use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryItemService
{
    /**
     * Retrieve all inventory items.
     * Eager loads warehouse and inKindDonation relationships.
     *
     * @return Collection
     */
    public function getAllInventoryItems(): Collection
    {
        return InventoryItem::with(['warehouse', 'inKindDonation'])->get();
    }

    /**
     * Find a single inventory item by ID.
     * Eager loads warehouse and inKindDonation relationships.
     *
     * @param int $id
     * @return
     */
    public function getInventoryItem(InventoryItem $inventoryItem)
    {
        return $inventoryItem->load(['warehouse', 'inKindDonation']);
    }

    /**
     * Create a new inventory item record.
     *
     * @param Request $request
     * @return InventoryItem
     */
    public function createInventoryItem(Request $request): InventoryItem
    {

        try {
            return DB::transaction(function () use ($request) {

                $inventoryItem = InventoryItem::create($request->validated());


                return $inventoryItem;
            });
        } catch (\Exception $e) {

            Log::error('Error creating inventory item in service: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing inventory item record.
     *
     * @param Request $request
     * @param InventoryItem $inventoryItem
     * @return InventoryItem
     */
    public function updateInventoryItem(Request $request, InventoryItem $inventoryItem): InventoryItem
    {
        return DB::transaction(function () use ($request, $inventoryItem) {
            $inventoryItem->update($request->validated());
            $inventoryItem->refresh();
            return $inventoryItem;
        });
    }

    /**
     * Delete an inventory item record.
     *
     * @param InventoryItem $inventoryItem
     * @return bool
     */
    public function deleteInventoryItem(InventoryItem $inventoryItem): bool
    {
        try {
            return DB::transaction(function () use ($inventoryItem) {
                return (bool) $inventoryItem->delete();
            });
        } catch (\Exception $e) {
            Log::error('Error deleting inventory item: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return false;
        }
    }
}
