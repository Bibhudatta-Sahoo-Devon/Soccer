<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\players;
use App\Models\Teams;
use App\Repositories\PlayerRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PlayersController extends Controller
{
    protected $repository;

    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @OA\Get (
     *      path="/team/{teams}/players",
     *      operationId="getPlayerList",
     *      tags={"Player"},
     *      summary="Get list of player for a team",
     *      description="Returns list of players",
     *      @OA\Parameter(
     *          name="teams",
     *          description="Teams id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response (
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent (ref="#/components/schemas/PlayerResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *     )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Teams $teams): JsonResponse
    {
        $allPlayers = $teams->player;
        return new JsonResponse(['data' => $allPlayers], Response::HTTP_OK);
    }

    /**
     *
     * @OA\Post(
     *      path="/player",
     *      operationId="storePlayer",
     *      tags={"Player"},
     *      summary="Store new player",
     *      description="To cerate a new player",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePlayerRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Player")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerRequest $request): JsonResponse
    {
        $request->validated();
        $response = $this->repository->store($request);
        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *      path="player/{id}",
     *      operationId="updatePlayer",
     *      tags={"Player"},
     *      summary="Update existing player",
     *      description="Update player data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Player id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePlayerRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Players updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Player")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     * @param UpdatePlayerRequest $request
     * @param $id
     * @return object
     */

    public function update(UpdatePlayerRequest $request, $id): JsonResponse
    {
        $request->validated();
        $response =  $this->repository->update($request, $id);
        return new JsonResponse($response, Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/player/{id}",
     *      operationId="deletePlayer",
     *      tags={"Player"},
     *      summary="Delete existing player",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Player id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Player deleted successfully"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        Players::destroy($id);
        return new JsonResponse(['massage' => 'Player deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
