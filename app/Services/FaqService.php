<?php

namespace App\Services;

use App\Repositories\Contracts\FaqRepositoryInterface;

class FaqService
{
    protected $faqRepository;

    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Select all faqds
     * @return array
    */
    public function getAllFaqs()
    {
        return $this->faqRepository->getAllFaqs();
    }

     /**
     * Create a new faqd
     * @param array $data
     * @return object 
    */
    public function makeFaq(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        
        $faq = $this->faqRepository->createFaq($data);        

        return $faq;
    }

    /**
     * Get Faqd by  ID
     * @param int $id
     * @return object
    */
    public function getFaqById(int $id)
    {
        return $this->faqRepository->getFaqById($id);
    }

    /**
     * Update a faqd
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateFaq(int $id, array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $faq = $this->faqRepository->getFaqById($id);

        if (!$faq) {
            return response()->json(['message' => 'FAQ Not Found'], 404);
        }

        $this->faqRepository->updateFaq($faq, $data);
        return response()->json(['message' => 'FAQ Updated'], 200);
    }

    /**
     * Delete a faqd
     * @param int $id
     * @return json response
    */
    public function destroyFaq(int $id)
    {
        $faq = $this->faqRepository->getFaqById($id);

        if (!$faq) {
            return response()->json(['message' => 'FAQ Not Found'], 404);
        }

        $this->faqRepository->destroyFaq($faq);

        return response()->json(['message' => 'FAQ Deleted'], 200);
    }
}