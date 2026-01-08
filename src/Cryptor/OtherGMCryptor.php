<?php

namespace Oh86\OtherSmCryptor\Cryptor;

use Oh86\SmCryptor\AbstractCryptor;
use Oh86\SmCryptor\Cryptor;
use Oh86\SmCryptor\Exceptions\SmCryptorException;
use Oh86\OtherSmCryptor\Api\OtherGMApi;
use Oh86\OtherSmCryptor\Exceptions\ApiRequestException;
use Illuminate\Support\Facades\Log;

class OtherGMCryptor extends AbstractCryptor implements Cryptor
{
    private OtherGMApi $api;

    public function __construct(OtherGMApi $api)
    {
        $this->api = $api;
    }

    public function sm3(string $text): string
    {
        if (!$text) {
            return '';
        }

        try {
            return $this->api->sm3($text);
        } catch (ApiRequestException $e) {
            Log::error(__METHOD__, $e->errors());
            throw new SmCryptorException("sm3计算失败");
        }
    }

    public function hmacSm3(string $text): string
    {
        if (!$text) {
            return '';
        }

        try {
            return $this->api->hmacSm3($text);
        } catch (ApiRequestException $e) {
            Log::error(__METHOD__, $e->errors());
            throw new SmCryptorException("hmacSm3计算失败");
        }
    }

    public function sm4Encrypt(string $text): string
    {
        if (!$text) {
            return '';
        }

        try {
            return $this->api->sm4Encrypt($text);
        } catch (ApiRequestException $e) {
            Log::error(__METHOD__, $e->errors());
            throw new SmCryptorException("sm4加密失败");
        }
    }

    public function sm4Decrypt(string $cipherText): string
    {
        if (!$cipherText) {
            return '';
        }

        try {
            return $this->api->sm4Decrypt($cipherText);
        } catch (ApiRequestException $e) {
            Log::error(__METHOD__, $e->errors());
            throw new SmCryptorException("sm4解密失败");
        }
    }

    public function sm2GenSign(string $text): string
    {
        if (!$text) {
            return '';
        }

        try {
            return $this->api->sm2GenSign($text);
        } catch (ApiRequestException $e) {
            Log::error(__METHOD__, $e->errors());
            throw new SmCryptorException("sm2签名生成失败");
        }
    }

    public function sm2VerifySign(string $text, string $sign): bool
    {
        if (!$text) {
            return $sign == '';
        }

        try {
            return $this->api->sm2VerifySign($text, $sign);
        } catch (ApiRequestException $e) {
            Log::error(__METHOD__, $e->errors());
            throw new SmCryptorException("sm2签名验证失败");
        }
    }
}
