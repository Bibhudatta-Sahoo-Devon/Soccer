<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User Login response",
 *      description="Provide token on successful login ",
 *      type="object",
 * )
 */
class LoginResponse
{
    /**
     * @OA\Property(
     *      title="Token",
     *      description="JWT token",
     *      example="3%7CiolYwg2yPhKGmU4Ivl0pwYzsuW1isf3HlN7iJTdW"
     * )
     *
     * @var string
     */
    public $token;

}
