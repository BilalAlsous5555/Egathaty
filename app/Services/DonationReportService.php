<?php

namespace App\Services;

use App\Http\Requests\DonationReportRequests\StoreDonationReportRequest;
use App\Models\DonationReport;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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
                    'generated_by_user_id' => $request->generated_by_user_id ?? Auth::id(),
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
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteDonationReport(int $id): bool
    {
        $report = DonationReport::find($id);

        if (!$report) {
            return false;
        }

        if ($report->report_file_path && Storage::exists($report->report_file_path)) {
            Storage::delete($report->report_file_path);
        }

        return (bool) $report->delete();
    }




    /**
     * Handles the upload and storage of the report file.
     *
     * @param Request $request
     * @return string|null
     */
    protected function handleReportFile(Request $request): ?string
    {
        if ($request->hasFile('report_file')) {
            return $request->file('report_file')->store('donation_reports', 'public');
        }
        return null;
    }
}
