<?php


namespace App\Virtual;


/**
 * @OA\Schema(
 *      title="Store Team request",
 *      description="Store Team request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreTeamRequest
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
}
