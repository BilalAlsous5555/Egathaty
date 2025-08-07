<?php

namespace App\Services;

use App\Http\Requests\DonationReportRequests\StoreDonationReportRequest;
use App\Models\DonationReport;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;

class DonationReportService
{
    /**
     * Retrieve all donation reports.
     *
     * @return Collection
     */
    public function getAllDonationReports(): Collection
    {
        return DonationReport::with(['donor', 'generatedBy'])->get();
    }

    /**
     * Find a single donation report by ID.
     *
     * @param int $id
     * @return DonationReport|null
     */
    public function getDonationReportById(int $id): ?DonationReport
    {
        return DonationReport::with(['donor', 'generatedBy'])->find($id);
    }

    /**
     * Create a new donation report.
     *
     * @param Request $request The validated request data.
     * @return DonationReport
     */
    public function createDonationReport(StoreDonationReportRequest $request): DonationReport
    {


        try {
            return DB::transaction(function () use ($request) {


                $reportFilePath = $this->handleReportFile($request);


                $donationReport = DonationReport::create([
                    'donor_id' => $request->donor_id,
                    'report_period_start' => $request->report_period_start,
                    'report_period_end' => $request->report_period_end,
                    'report_file_path' => $reportFilePath,
                    'generated_by_user_id' => $request->generated_by_user_id ?? auth()->id(),
                ]);



                return $donationReport;
            });
        } catch (\Exception $e) {
            Log::error('Error creating donation report in service: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }



    /**
     * Delete a donation report.
     *
     * @param DonationReport $donationReport The DonationReport model instance to delete.
     * @return bool
     */

    public function deleteDonationReport(DonationReport $donationReport)
    {
        try {
            return DB::transaction(function () use ($donationReport) {
                if ($donationReport->report_file_path && Storage::disk('public')->exists($donationReport->report_file_path)) {
                    Storage::disk('public')->delete($donationReport->report_file_path);
                }

                $recordDeleted = $donationReport->delete();

                return $recordDeleted;
            });
        } catch (\Exception $e) {
            Log::error('Error deleting donation report: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return false;
        }
    }

    /**
     * Handles the upload and storage of the report file.
     *
     * @param Request $request
     * @return string|null The path to the stored file, or null if no file.
     */
    protected function handleReportFile(Request $request): ?string
    {
        if ($request->hasFile('report_file')) {
            return $request->file('report_file')->store('donation_reports', 'public');
        }
        return null;
    }
}
