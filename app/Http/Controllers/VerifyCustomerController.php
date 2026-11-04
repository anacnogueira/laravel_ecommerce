<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerActivationService;
use Exception;

class VerifyCustomerController extends Controller
{
    public function __construct(
        protected CustomerActivationService $customerActivationService
    ) {}

    public function verify(Request $request, int $id)
    {
        if (! $request->hasValidSignature()) {
            return response()->json(['message' => 'Link de verificação inválido ou expirado.'], 403);
        }

        try {
            $this->customerActivationService->activateCustomer($id);

            $title = "Conta ativada com sucesso";

            return view('customers.activated', compact('title'));

            //return response()->json(['message' => 'Conta ativada com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
