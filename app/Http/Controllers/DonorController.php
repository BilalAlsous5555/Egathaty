<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonorRequests\UpdateDonorRequest;
use App\Models\Donor;
use App\Http\Requests\DonorRequests\StoreDonorRequest;
use App\Services\DonorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class DonorController extends Controller
{
    protected $donorService;

    /**
     * Constructor for DonorController.
     * Laravel's service container will automatically inject an instance of DonorService.
     *
     * @param DonorService $donorService The service layer for donor-related operations.
     */
    public function __construct(DonorService $donorService)
    {
        $this->donorService = $donorService;



        $this->authorizeResource(Donor::class, 'donor');

    }

    /**
     * Display a listing of the resource.
     * Fetches all donors using the DonorService and returns them as JSON.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $donors = $this->donorService->getAllDonors();
        return response()->json($donors);
    }

    /**
     * Store a newly created donor in storage.
     * The request is automatically validated by StoreDonorRequest before reaching this method.
     * Returns the created donor as JSON with a 201 Created status.
     *
     * @param  \App\Http\Requests\DonorRequests\StoreDonorRequest  $request The validated request.
     * @return JsonResponse
     */
    public function store(StoreDonorRequest $request): JsonResponse
    {
        $donor = $this->donorService->createDonor($request);

        return response()->json([
            'message' => 'Donor created successfully.',
            'donor' => $donor
        ], 201); // 201 Created status
    }

    /**
     * Display the specified donor.
     * Laravel's route model binding automatically resolves the Donor instance.
     * Returns the specified donor as JSON.
     *
     * @param  \App\Models\Donor  $donor The Donor model instance.
     * @return JsonResponse
     */
    public function show(Donor $donor): JsonResponse
    {
        return response()->json($donor);
    }

    /**
     * Update the specified donor in storage.
     * The request is automatically validated by StoreDonorRequest before reaching this method.
     * Returns the updated donor as JSON.
     *
     * @param  \App\Http\Requests\DonorRequests\StoreDonorRequest  $request The validated request.
     * @param  \App\Models\Donor  $donor The Donor model instance to update.
     * @return JsonResponse
     */
    public function update(UpdateDonorRequest $request, Donor $donor): JsonResponse
    {
        $this->donorService->updateDonor($request, $donor);

        return response()->json([
            'message' => 'Donor updated successfully.',
            'donor' => $donor // Return the updated donor
        ]);
    }

    /**
     * Remove the specified donor from storage.
     * Laravel's route model binding automatically resolves the Donor instance.
     * Returns a success message as JSON.
     *
     * @param  \App\Models\Donor  $donor The Donor model instance to delete.
     * @return JsonResponse
     */
    public function destroy(Donor $donor): JsonResponse
    {
        $this->donorService->deleteDonor($donor);

        return response()->json(['message' => 'Donor deleted successfully.']);
    }
}