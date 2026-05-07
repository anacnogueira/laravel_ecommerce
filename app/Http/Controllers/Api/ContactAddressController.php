<?php

 namespace App\Http\Controllers\Api;

 use App\Http\Controllers\Controller;

 class ContactAddressController extends Controller
 {
    public function setOrderDefaultAddress($addressId)
    {
        session()->put('contact_address_id', $addressId);
        return response()->json('OK');
    }
 }
