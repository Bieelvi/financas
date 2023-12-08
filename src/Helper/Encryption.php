<?php 

namespace Financas\Helper;

class Encryption
{
    const PATH_KEY = __DIR__ . '/../../chave.key';
    
    public static function encryption(string $value): string
    {
        if (!file_exists(self::PATH_KEY)) {
            file_put_contents(self::PATH_KEY, sodium_crypto_kdf_keygen());
        }

        $key = file_get_contents(self::PATH_KEY);
        $iv  = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        return sodium_bin2hex($iv . sodium_crypto_secretbox($value, $iv, $key));
    }

    public static function decryption(string $input)
    {
        $input = sodium_hex2bin($input);
        $nonce = substr($input, 0,SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $cryto = substr($input, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        $key = file_get_contents(self::PATH_KEY);

        return sodium_crypto_secretbox_open($cryto, $nonce, $key);
    }
}