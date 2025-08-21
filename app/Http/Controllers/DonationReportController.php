<?php

namespace App\Http\Controllers;

use App\Models\DonationReport;
use App\Http\Requests\DonationReportRequests\StoreDonationReportRequest;
use App\Services\DonationReportService;
use Illuminate\Http\JsonResponse;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DonationReportController extends Controller
{
    use AuthorizesRequests;

    protected $donationReportService;

    /**
     * Constructor for DonationReportController.
     *
     * @param DonationReportService $donationReportService
     */
    public function __construct(DonationReportService $donationReportService)
    {
        $this->donationReportService = $donationReportService;
    }

    /**
     * Display a listing of the resource (all donation reports).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $this->authorize('viewAny', DonationReport::class);

            $reports = $this->donationReportService->getAllDonationReports();
            return response()->json($reports);
        } catch (Throwable $e) {
            Log::error('Error in DonationReportController@index: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to retrieve donation reports.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created donation report in storage.
     *
     * @param  \App\Http\Requests\DonationReportRequests\StoreDonationReportRequest  $request
     * @return JsonResponse
     */
    public function store(StoreDonationReportRequest $request): JsonResponse
    {
        try {
            $this->authorize('create', DonationReport::class);

            $report = $this->donationReportService->createDonationReport($request);

            return response()->json([
                'message' => 'Donation report created successfully.',
                'report' => $report->load(['donor', 'generatedBy'])
            ], 201);
        } catch (Throwable $e) {
            Log::error('Error in DonationReportController@store: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to create donation report.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified donation report from storage.
     *
     * @param  \App\Models\DonationReport  $donationReport
     * @return JsonResponse
     */
     public function destroy(int $id): JsonResponse
    {
        $deleted = $this->donationReportService->deleteDonationReport($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Failed to delete donation report.'
            ], 404);
        }

        return response()->json([
            'message' => 'Donation report deleted successfully.'
        ], 200);
    }
}
