<?php

namespace App\Http\Controllers;

use App\Models\DonationReport;
use App\Http\Requests\DonationReportRequests\StoreDonationReportRequest;
use App\Services\DonationReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Throwable;

class DonationReportController extends Controller
{
    protected $donationReportService;

    /**
     * Constructor for DonationReportController.
     *
     * @param DonationReportService $donationReportService
     */
    public function __construct(DonationReportService $donationReportService)
    {
        $this->donationReportService = $donationReportService;
        $this->authorizeResource(DonationReport::class, 'donations_report');

    }

    /**
     * Display a listing of the resource (all donation reports).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $reports = $this->donationReportService->getAllDonationReports();
        return response()->json($reports);
    }

    /**
     * Store a newly created donation report in storage.
     * The request is automatically validated by StoreDonationReportRequest.
     *
     * @param  \App\Http\Requests\DonationReportRequests\StoreDonationReportRequest  $request The validated request.
     * @return JsonResponse
     */
    public function store(StoreDonationReportRequest $request): JsonResponse
    {


        try {
            $report = $this->donationReportService->createDonationReport($request);


            return response()->json([
                'message' => 'Donation report created successfully.',
                'report' => $report->load(['donor', 'generatedBy'])
            ], 201);
        } catch (Throwable $e) {

            \Log::error('Error in DonationReportController@store: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to create donation report.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified donation report.
     * Laravel's route model binding automatically resolves the DonationReport instance.
     *
     * @param  \App\Models\DonationReport  $donationReport The DonationReport model instance.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {

            $donationReport = DonationReport::with(['donor', 'generatedBy'])->find($id);

            if (!$donationReport) {
                return response()->json(['message' => 'Donation report not found.'], 404);
            }

            return response()->json($donationReport);
        } catch (Throwable $e) {
            \Log::error('Error in DonationReportController@show: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'message' => 'Failed to retrieve donation report.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Remove the specified donation report from storage.
     *
     * @param  \App\Models\DonationReport  $donationReport The DonationReport model instance to delete.
     * @return JsonResponse
     */

    public function destroy($id)
    {
        $report = DonationReport::find($id);

        if (!$report) {
            return response()->json([
                'message' => 'Donation report not found.'
            ], 404);
        }

        $report->delete();

        return response()->json([
            'message' => 'Donation report deleted successfully.'
        ], 200);
    }

}
