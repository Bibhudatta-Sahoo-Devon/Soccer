<?php


namespace App\Virtual\Models;


/**
 * @OA\Schema(
 *     title="Team",
 *     description="Team model",
 *     @OA\Xml(
 *         name="Team"
 *     )
 * )
 */
class Team
{

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the Team",
     *      example="unity"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="Logo",
     *      description="Logo file path of the team",
     *      example="/unity233625.jpg"
     * )
     *
     * @var string
     */
    public $logo;
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
    private $id;
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
