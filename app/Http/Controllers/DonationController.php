<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequests\StoreDonation;
use App\Http\Requests\DonationRequests\UpdateDonation;
use App\Models\Donation;
use App\Services\DonationServices;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    protected $donationServ ; 

    public function __construct(DonationServices $donationServ)
    {
        $this->donationServ = $donationServ ; 
    }
    public function index()
    {
        return $this->success(
            [
                'all_donations' => $this->donationServ->getDonationsList() 
            ]
        );
    }

    public function store(StoreDonation $request)
    {
        $donation = $this->donationServ->createDonation($request->validated());
        return $this->success(
            [
                'created_donation' => $donation->load(['cashDonation', 'inKindDonation'])
            ]
        );
    }

    public function show(Donation $donation)
    {
        return $this->success(
            [
                'donation_found' => $donation->load(['donor' , 'recordedBy' , 'cashDonation' , 'inKindDonation' ,'attachments']) 
            ]
        );
    }


    public function update(UpdateDonation $request, Donation $donation)
    {
        $donation = $this->donationServ->updateDonation($donation, $request->validated());

        return $this->success([
            'updated_donation' => $donation->load(['cashDonation', 'inKindDonation']),
        ]);
    }


public function destroy(Donation $donation)
{
    $deleted = $this->donationServ->deleteDonation($donation);

    if ($deleted) {
        return $this->success(['message' => 'Donation deleted successfully.']);
    }

    return $this->error([],'Unable to delete donation.', 500);
}

}
