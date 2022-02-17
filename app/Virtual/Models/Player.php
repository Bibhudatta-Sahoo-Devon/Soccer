<?php


namespace App\Virtual\Models;


/**
 * @OA\Schema(
 *     title="Player",
 *     description="Player model",
 *     @OA\Xml(
 *         name="Player"
 *     )
 * )
 */
class Player
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
