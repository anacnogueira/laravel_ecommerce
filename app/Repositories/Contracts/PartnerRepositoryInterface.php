<?php

namespace App\Repositories\Contracts;

use App\Models\Contact;

interface PartnerRepositoryInterface
{
    public function getAllPartners();
    public function getPartnerById($id);
    public function createPartner(array $data);
    public function updatePartner(Contact $partner, array $data);
    public function destroyPartner(Contact $partner);
}
