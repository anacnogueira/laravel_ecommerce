<?php

namespace App\Hashing;

use Illuminate\Contracts\Hashing\Hasher;

class CakeSHA1Hasher implements Hasher
{
    public function getAlgorithm()
    {
        return 'sha1_cake';
    }

    public function make($value, array $options = [])
    {
        return hash('sha1', $value);
    }

    /**
     * @param string $value A senha em texto puro.
     * @param string $hashedValue O hash armazenado no banco de dados.
     * @param array $options Opções de hash.
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        $hashedInput = hash('sha1', $value);

        // Compara o hash gerado com o hash armazenado no DB.
        return hash_equals($hashedValue, $hashedInput);
    }

    /**
     *
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return true;
    }

    /**
     * @param string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return [
            'algo' => 'sha1_cake',
            'options' => [
                'salt_configured' => $this->cakeSalt !== 'SUA_SALT_SECRETA_DO_CAKEPHP2',
                'warning' => 'This is a legacy SHA1 hash. Needs rehash to modern algorithm.',
            ],
        ];
    }
}
