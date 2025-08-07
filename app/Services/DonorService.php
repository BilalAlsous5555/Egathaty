<?php

namespace App\Services;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class DonorService
{
    /**
     * Retrieve all donor records from the database.
     *
     * @return Collection A collection of Donor models.
     */
    public function getAllDonors(): Collection
    {
        return Donor::all();
    }

    /**
     * Find a single donor record by its primary key (ID).
     *
     * @param int $id The ID of the donor to find.
     * @return Donor|null The Donor model if found, otherwise null.
     */
    public function getDonorById(int $id): ?Donor
    {
        return Donor::find($id);
    }

    /**
     * Create a new donor record in the database.
     * This method expects validated data from the controller.
     *
     * @param Request $request The validated request data containing the new donor's information.
     * @return Donor The newly created Donor model instance.
     */
    public function createDonor(Request $request): Donor // Changed type hint from StoreDonorRequest to Request
    {

        return Donor::create($request->validated());
    }

    /**
     * Update an existing donor record in the database.
     * This method expects validated data from the controller.
     *
     * @param Request $request The validated request data for updating the donor. // Changed type hint from StoreDonorRequest to Request
     * @param Donor $donor The Donor model instance to be updated.
     * @return bool True if the update was successful, false otherwise.
     */
    public function updateDonor(Request $request, Donor $donor): bool
    {

        return $donor->update($request->validated());
    }

    /**
     * Delete a donor record from the database.
     *
     * @param Donor $donor The Donor model instance to be deleted.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function deleteDonor(Donor $donor): bool
    {
        
        return $donor->delete();
    }
}
