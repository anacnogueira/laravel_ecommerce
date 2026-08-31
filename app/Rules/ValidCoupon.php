<?php

namespace App\Rules;

use Closure;
use App\Services\CouponService;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCoupon implements ValidationRule
{
    public function __construct(
        protected CouponService $couponService
    ) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $coupon = $this->couponService->isCouponValid($value);

        if (!$coupon) {
            $fail('O cupom informado é inválido ou não foi encontrado.');
        }
    }
}
