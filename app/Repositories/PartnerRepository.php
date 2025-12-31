<?php

namespace App\Repositories;

use App\Repositories\Contracts\PartnerRepositoryInterface;
use App\Models\Contact;

class PartnerRepository implements PartnerRepositoryInterface
{
    protected $entity;

    public function __construct(Contact $partner)
    {
        $this->entity = $partner;
    }

    /**
     * Get all Partners
     * @return array
     */
    public function getAllPartners()
    {
        return $this->entity->partners()->get();
    }

    /**
     * Get all Partners
     * @return array
     */
    public function getActivePartners()
    {
        return $this->entity->show();
    }

    /**
     * Select Partner by ID
     * @param int $id
     * @return object
     */
    public function getPartnerById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Partner
     * @param array $data
     * @return object
     */
    public function createPartner(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Partner
     * @param object $contact
     * @param array $data
     * @return object
     */
    public function updatePartner(Contact $partner, array $data)
    {
        return $partner->update($data);
    }

    /**
     * Delete a Partner
     * @param object $contact
     */
    public function destroyPartner(Contact $partner)
    {
        return $partner->delete();
    }
}
