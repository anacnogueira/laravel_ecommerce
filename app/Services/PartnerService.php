<?php

namespace App\Services;

use App\Repositories\Contracts\PartnerRepositoryInterface;
use App\Services\StoreFileService;
use App\Services\DeleteFileService;
use App\Services\ContactAddressService;
use App\Services\ContactInfoService;
use Illuminate\Support\Str;

class PartnerService
{
    protected $partnerRepository;
    protected $contactAddressService;
    protected $contactInfoService;

    public function __construct(
        PartnerRepositoryInterface $partnerRepository,
        ContactAddressService $contactAddressService,
        ContactInfoService $contactInfoService,
    )
    {
        $this->partnerRepository = $partnerRepository;
        $this->contactAddressService = $contactAddressService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * Select all partners
     * @return array
    */
    public function getAllPartners()
    {
        return $this->partnerRepository->getAllPartners();
    }

     /**
     * Create a new partner
     * @param array $data
     * @return object
    */
    public function makePartner(array $data)
    {
        //1. Cadastrar Dados Gerais e de Contato
        $partner = $this->partnerRepository->createPartner($data);

        if ($data["upload"]) {
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename);

            $partner->update([
                "image" => $pathFile,
            ]);
        }

        //2. Cadastrar Dados de Endereço
        $data["contact_id"] = $partner->id;

        $this->contactAddressService->makeContactAddress($data);

        //3. Adicionar Dados Pessoas Para Contato
        $dataContactInfos = json_decode($data["all_contact_infos"], true);

        if ($dataContactInfos) {
            foreach ($dataContactInfos as $contactInfo) {
                $contactInfo["contact_id"] =  $data["contact_id"];
                $this->contactInfoService->makeContactInfo($contactInfo);
            }
        }

        return $partner;
    }

    /**
     * Get Partner by  ID
     * @param int $id
     * @return object
    */
    public function getPartnerById(int $id)
    {
        return $this->partnerRepository->getPartnerById($id);
    }

    /**
     * Update a partner
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updatePartner(int $id, array $data)
    {
        $partner = $this->partnerRepository->getPartnerById($id);

        if (!$partner) {
            return response()->json(['message' => 'Partner Not Found'], 404);
        }

        if ( $data["upload"]) {
            $oldFile = $partner->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename, $oldFile);

            $data["image"] = $pathFile;
        }

        $this->partnerRepository->updatePartner($partner, $data);

        //Update Address
        $address = $this->contactAddressService->getAllContactAddressesByContactId($id)->first();
        $this->contactAddressService->updateContactAddress($address->id, $data);

        //Update ContactInfo
        $partner->info()->delete();

        $dataContactInfos = json_decode($data["all_contact_infos"], true);

        foreach ($dataContactInfos as $contactInfo) {
            $contactInfo["contact_id"] =  $id;
            $this->contactInfoService->makeContactInfo($contactInfo);
        }

        return response()->json(['message' => 'Partner Updated'], 200);
    }

    /**
     * Delete a Partner
     * @param int $id
     * @return json response
    */
    public function destroyPartner(int $id)
    {
        $partner = $this->partnerRepository->getPartnerById($id);

        if (!$partner) {
            return response()->json(['message' => 'Partner Not Found'], 404);
        }

        if ($partner->image) {
            DeleteFileService::delete($partner->image);
        }

        $partner->address()->delete();
        $partner->info()->delete();

        $this->partnerRepository->destroyPartner($partner);

        return response()->json(['message' => 'Partner Deleted'], 200);
    }

    private function storeImage($file, $filename, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            env('FILE_DESTINATION_PARTNERS'),
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
