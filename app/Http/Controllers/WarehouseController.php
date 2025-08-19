<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\WarehouseRequests\StoreWarehouseRequest;
use App\Http\Requests\WarehouseRequests\UpdateWarehouseRequest;
use App\Services\WarehouseService;
use Illuminate\Http\JsonResponse;
use Throwable;
use Illuminate\Support\Facades\Log;

class WarehouseController extends Controller
{
   

    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display a listing of the resource (all warehouses).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $this->authorize('viewAny', Warehouse::class);
            $warehouses = $this->warehouseService->getAllWarehouses();
            return response()->json($warehouses);
        } catch (Throwable $e) {
            Log::error('Error in WarehouseController@index: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to retrieve warehouses.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created warehouse in storage.
     *
     * @param  \App\Http\Requests\WarehouseRequests\StoreWarehouseRequest  $request
     * @return JsonResponse
     */
    public function store(StoreWarehouseRequest $request): JsonResponse
    {
        try {
            $this->authorize('create', Warehouse::class);
            $warehouse = $this->warehouseService->createWarehouse($request);

            return response()->json([
                'message' => 'Warehouse created successfully.',
                'warehouse' => $warehouse
            ], 201);
        } catch (Throwable $e) {
            Log::error('Error in WarehouseController@store: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to create warehouse.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified warehouse.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return JsonResponse
     */
    public function show(Warehouse $warehouse): JsonResponse
    {
        try {
            $this->authorize('view', $warehouse);
            return response()->json($warehouse);
        } catch (Throwable $e) {
            Log::error('Error in WarehouseController@show: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to retrieve warehouse.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified warehouse in storage.
     *
     * @param  \App\Http\Requests\WarehouseRequests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return JsonResponse
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse): JsonResponse
    {
        try {
            $this->authorize('update', $warehouse);
            $updatedWarehouse = $this->warehouseService->updateWarehouse($request, $warehouse);

            return response()->json([
                'message' => 'Warehouse updated successfully.',
                'warehouse' => $updatedWarehouse
            ]);
        } catch (Throwable $e) {
            Log::error('Error in WarehouseController@update: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to update warehouse.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified warehouse from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return JsonResponse
     */
    public function destroy(Warehouse $warehouse): JsonResponse
    {
        try {
            $this->authorize('delete', $warehouse);
            $this->warehouseService->deleteWarehouse($warehouse);

            return response()->json(['message' => 'Warehouse deleted successfully.']);
        } catch (Throwable $e) {
            Log::error('Error in WarehouseController@destroy: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to delete warehouse.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
