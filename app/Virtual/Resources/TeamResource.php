<?php


namespace App\Virtual\Resources;



/**
 * @OA\Schema(
 *     title="TeamResource",
 *     description="Team resource",
 *     @OA\Xml(
 *         name="TeamResource"
 *     )
 * )
 */
class TeamResource
{
    /**
     * @OA\Property(
     *     title="team Data",
     *     description="Team Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Team[]
     */
    private $data;

}
