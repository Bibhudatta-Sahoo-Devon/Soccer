<?php


namespace App\Virtual;



/**
 * @OA\Schema(
 *      title="Store Player request",
 *      description="Store Player request body data",
 *      type="object",
 *      required={"first_name","last_name","image","team_id"}
 * )
 */
class StorePlayerRequest
{
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
     *      description="Image file path of the player",
     *      example="/playre123625.jpg"
     * )
     *
     * @var string
     */
    public $image;

    /**
     * @OA\Property(
     *      title="Team Id",
     *      description="Player's team ID",
     *     format="int64",
     *      example="3"
     * )
     *
     * @var integer
     */
    public $team_id;
}
