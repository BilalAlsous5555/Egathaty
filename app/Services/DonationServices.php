<?php

namespace App\Services;

use App\Models\Donation;

class DonationServices
{
    public function getDonationsList()
    {
        $donation = Donation::with(['donor' , 'recordedBy' , 'cashDonation' , 'inKindDonation' ,'attachments'])->get();
        return $donation;
    }
public function createDonation(array $validatedData)
    {
        // حفظ التبرع الأساسي
        $donation = Donation::create([
            'donor_id' => $validatedData['donor_id'],
            'type' => $validatedData['type'],
            'date_received' => $validatedData['date_received'] ?? now()->toDateString(),
        ]);

        // التبرع النقدي
        if ($donation->type === 'cash' && isset($validatedData['cash'])) {
            $donation->cashDonation()->create([
                'amount' => $validatedData['cash']['amount'],
                'currency' => $validatedData['cash']['currency'],
            ]);
            return $donation;
        }

        // التبرع العيني
        if ($donation->type === 'in_kind' && isset($validatedData['in_kind'])) {
            $donation->inKindDonation()->create([
            'item_name'      => $validatedData['in_kind']['item_name'],
            'quantity'       => $validatedData['in_kind']['quantity'],
            'description'    => $validatedData['in_kind']['description'] ?? null,
            'expiry_date'    => $validatedData['in_kind']['expiry_date'] ?? null,
        ]);
            return $donation;
        }
    }
    public function updateDonation($donation, array $validatedData)
{

    // تحديث التبرع الأساسي فقط إن وُجدت قيم جديدة
    $donation->update([
        'donor_id'      => $validatedData['donor_id']      ?? $donation->donor_id,
        'type'          => $validatedData['type']          ?? $donation->type,
        'date_received' => $validatedData['date_received'] ?? $donation->date_received,
    ]);

    // تحديث البيانات حسب النوع
    if ($donation->type === 'cash' && isset($validatedData['cash'])) {
        $cash = $donation->cashDonation;
        if ($cash) {
            $cash->update([
                'amount'   => $validatedData['cash']['amount'],
                'currency' => $validatedData['cash']['currency'],
            ]);
        } else {
            $donation->cashDonation()->create($validatedData['cash']);
        }
    }

    if ($donation->type === 'in_kind' && isset($validatedData['in_kind'])) {
        $inKind = $donation->inKindDonation;
        if ($inKind) {
            $inKind->update([
                'item_name'      => $validatedData['in_kind']['item_name'],
                'quantity'       => $validatedData['in_kind']['quantity'],
                'unit'           => $validatedData['in_kind']['unit'],
                'description'    => $validatedData['in_kind']['description'] ?? null,
                'expiration_date'=> $validatedData['in_kind']['expiration_date'] ?? null,
            ]);
        } else {
            $donation->inKindDonation()->create($validatedData['in_kind']);
        }
    }

    return $donation;
}
public function deleteDonation($donation): bool
{

    // حذف التبرع المرتبط حسب النوع
    if ($donation->type === 'cash') {
        $donation->cashDonation()->delete();
    }

    if ($donation->type === 'in_kind') {
        $donation->inKindDonation()->delete();
    }

    // حذف التبرع الأساسي
    return $donation->delete();
}


}
