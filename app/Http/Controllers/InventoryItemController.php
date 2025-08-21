<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Http\Requests\InventoryItemRequests\StoreInventoryItemRequest;
use App\Http\Requests\InventoryItemRequests\UpdateInventoryItemRequest;
use App\Services\InventoryItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
class InventoryItemController extends Controller
{
    use AuthorizesRequests;
    protected $inventoryItemService;

    /**
     * Constructor for InventoryItemController.

     * @param InventoryItemService $inventoryItemService
     */
    public function __construct(InventoryItemService $inventoryItemService)
    {
        $this->inventoryItemService = $inventoryItemService;
        $this->authorizeResource(InventoryItem::class, 'inventory_item');
    }

    /**

     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $inventoryItems = $this->inventoryItemService->getAllInventoryItems();
            return response()->json($inventoryItems);
        } catch (Throwable $e) {
            Log::error('Error in InventoryItemController@index: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to retrieve inventory items.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**

     * @param  \App\Http\Requests\InventoryItemRequests\StoreInventoryItemRequest  $request
     * @return JsonResponse
     */
    public function store(StoreInventoryItemRequest $request): JsonResponse
    {
        try {
            $inventoryItem = $this->inventoryItemService->createInventoryItem($request);

            return response()->json([
                'message' => 'Inventory item created successfully.',
                'inventory_item' => $inventoryItem->load(['warehouse', 'inKindDonation'])
            ], 201);
        } catch (Throwable $e) {
            Log::error('Error in InventoryItemController@store: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to create inventory item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**

     * @param  \App\Models\InventoryItem  $inventoryItem
     * @return JsonResponse
     */
    public function show(InventoryItem $inventoryItem): JsonResponse
    {
        try {
            $data = $this->inventoryItemService->getInventoryItem($inventoryItem);
            return response()->json($data);
        } catch (Throwable $e) {
            Log::error('Error in InventoryItemController@show: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to retrieve inventory item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param  \App\Http\Requests\InventoryItemRequests\UpdateInventoryItemRequest  $request
     * @param  \App\Models\InventoryItem  $inventoryItem
     * @return JsonResponse
     */
    public function update(UpdateInventoryItemRequest $request, InventoryItem $inventoryItem): JsonResponse
    {
        try {
            $updatedInventoryItem = $this->inventoryItemService->updateInventoryItem($request, $inventoryItem);

            return response()->json([
                'message' => 'Inventory item updated successfully.',
                'inventory_item' => $updatedInventoryItem->load(['warehouse', 'inKindDonation'])
            ]);
        } catch (Throwable $e) {
            Log::error('Error in InventoryItemController@update: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to update inventory item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**

     * @param  \App\Models\InventoryItem  $inventoryItem
     * @return JsonResponse
     */
    public function destroy(InventoryItem $inventoryItem): JsonResponse
    {
        try {
            $this->inventoryItemService->deleteInventoryItem($inventoryItem);

            return response()->json(['message' => 'Inventory item deleted successfully.']);
        } catch (Throwable $e) {
            log::error('Error in InventoryItemController@destroy: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to delete inventory item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
