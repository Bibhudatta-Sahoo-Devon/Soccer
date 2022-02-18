<?php


namespace App\Virtual;


use phpDocumentor\Reflection\File;

/**
 * @OA\Schema(
 *      title="Update player request",
 *      description="Update player request body data",
 *      type="object",
 *      required={"id"}
 * )
 */
class UpdatePlayerRequest
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
     *      title="First Name",
     *      description="First Name of the player",
     *      example="Lionel"
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *      title="Last Name",
     *      description="Last Name of the player",
     *      example="Messi"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *      title="Image",
     *      description="Image file of the player",
     *      example="/playre123625.jpg"
     * )
     *
     * @var File
     */
    public $image;
}
