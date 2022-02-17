<?php


namespace App\Virtual\Resources;


/**
 * @OA\Schema(
 *     title="PlayerResource",
 *     description="Player resource",
 *     @OA\Xml(
 *         name="PlayerResource"
 *     )
 * )
 */
class PlayerResource
{
    /**
     * @OA\Property(
     *     title="Player Data",
     *     description="Player Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Player[]
     */
    private $data;
}
