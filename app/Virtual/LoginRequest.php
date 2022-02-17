<?php


namespace App\Virtual;



/**
 * @OA\Schema(
 *      title="User Login request",
 *      description="validate login request body data",
 *      type="object",
 *      required={"email","password"}
 * )
 */
class LoginRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email id of the user",
     *      example="user@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="User's Password",
     *      example="sadsa5@seew2"
     * )
     *
     * @var string
     */
    public $password;


}
