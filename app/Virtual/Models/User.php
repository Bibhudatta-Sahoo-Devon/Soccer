<?php


namespace App\Virtual\Models;


/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the user",
     *      example="User1"
     * )
     *
     * @var string
     */
    public $name;

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

    /**
     * @OA\Property(
     *      title="Role",
     *      description="Role of the user",
     *      example="user"
     * )
     *
     * @var string
     */
    public $role;


    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2022-02-15 15:55:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2022-02-15 15:55:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

}
