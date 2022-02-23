<?php

namespace App\Http\Controllers\Api;


use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Repositories\PlayerRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PlayersController extends Controller
{
    protected $playeRepository;

    public function __construct(PlayerRepository $repository)
    {
        $this->playeRepository = $repository;
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
     * @param int $teamId
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function getTeamPlayers(int $teamId): JsonResponse
    {
        try {
            $allPlayers = $this->playeRepository->getTeamPlayers($teamId);
            return new JsonResponse(['data' => $allPlayers], Response::HTTP_OK);
        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @OA\Get (
     *      path="/player/{id}",
     *      operationId="getPlayer",
     *      tags={"Player"},
     *      summary="Get a player details",
     *      description="Returns list of players",
     *      @OA\Parameter(
     *          name="id",
     *          description="Player id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response (
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent (ref="#/components/schemas/Player")
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
     * Give details of the player
     *
     * @param int $id
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function getPlayer(int $id): JsonResponse
    {
        try {
            $player = $this->playeRepository->getPlayer($id);
            return new JsonResponse($player, Response::HTTP_OK);
        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
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
     * Create a player.
     *
     * @param StorePlayerRequest $request
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function createPlayer(StorePlayerRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $response = $this->playeRepository->storePlayer($request);
            return new JsonResponse($response, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
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
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */

    public function updatePlayer(UpdatePlayerRequest $request, $id): JsonResponse
    {
        try {
            $request->validated();
            $response = $this->playeRepository->updatePlayer($request, $id);
            return new JsonResponse($response, Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
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
     * Delete player
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function deletePlayer($id): JsonResponse
    {
        try {
            $this->playeRepository->deletePlayer($id);
            return new JsonResponse(['massage' => 'Player deleted successfully'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
    }
}
