<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonorRequests\UpdateDonorRequest;
use App\Models\Donor;
use App\Http\Requests\DonorRequests\StoreDonorRequest;
use App\Services\DonorService;
use Illuminate\Http\JsonResponse;
class DonorController extends Controller
{
    protected $donorService;

    /**
     * Constructor for DonorController.
     *
     * @param DonorService $donorService
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
     *
     * @param  \App\Http\Requests\DonorRequests\StoreDonorRequest  $request
     * @return JsonResponse
     */
    public function store(StoreDonorRequest $request): JsonResponse
    {
        $donor = $this->donorService->createDonor($request);

        return response()->json([
            'message' => 'Donor created successfully.',
            'donor' => $donor
        ], 201);
    }

    /**
     * Display the specified donor.

     *
     * @param  \App\Models\Donor  $donor
     * @return JsonResponse
     */
    public function show(Donor $donor): JsonResponse
    {
        $data = $this->donorService->getDonor($donor);
        return response()->json($data);
    }

    /**
     * Update the specified donor in storage.
     *
     * @param  \App\Http\Requests\DonorRequests\StoreDonorRequest  $request
     * @param  \App\Models\Donor  $donor
     * @return JsonResponse
     */
    public function update(UpdateDonorRequest $request, Donor $donor): JsonResponse
    {
        $this->donorService->updateDonor($request, $donor);

        return response()->json([
            'message' => 'Donor updated successfully.',
            'donor' => $donor
        ]);
    }

    /**
     * Remove the specified donor from storage.
     *
     * @param  \App\Models\Donor  $donor
     * @return JsonResponse
     */
    public function destroy(Donor $donor): JsonResponse
    {
        $this->donorService->deleteDonor($donor);

        return response()->json(['message' => 'Donor deleted successfully.']);
    }
}
