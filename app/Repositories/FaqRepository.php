<?php

namespace App\Repositories;

use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Models\Faq;

class FaqRepository implements FaqRepositoryInterface
{
    protected $entity;

    public function __construct(Faq $faq)
    {
        $this->entity = $faq;
    }

    /**
     * Get all Faqs
     * @return array
     */
    public function getAllFaqs()
    {
        return $this->entity->all();
    }

    /**
     * Get Active Faqs
     * @return array
     */
    public function getActiveFaqs()
    {
        return $this->entity->active();
    }

    /**
     * Select Faq by ID
     * @param int $id
     * @return object
     */
    public function getFaqById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Faq
     * @param array $data
     * @return object
     */
    public function createFaq(array $data)
    {
        return $this->entity->create($data);
    }


    /**
     * Update data of Faq
     * @param object $faq
     * @param array $data
     * @return object
    */
    public function updateFaq(Faq $faq, array $data)
    {
        return $faq->update($data);
    }

    /**
     * Delete a Faq
     * @param object $faq
     */
    public function destroyFaq(Faq $faq)
    {
        return $faq->delete();
    }
}
