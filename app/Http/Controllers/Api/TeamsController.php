<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{

    private $teamRepository;

    public function __construct(TeamRepositoryInterface $repository)
    {
        $this->teamRepository = $repository;
    }

    /**
     * @OA\Get (
     *      path="/teams",
     *      operationId="getTeamList",
     *      tags={"Team"},
     *      summary="Get list of teams",
     *      description="Returns list of teams",
     *      @OA\Response (
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent (ref="#/components/schemas/TeamResource")
     *       ),
     *    @OA\Response(
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
     * Get all teams
     *
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function getAllTeams(): JsonResponse
    {
        try {
            $allTeams = $this->teamRepository->getAllTeams();

            return new JsonResponse(['data' => $allTeams], Response::HTTP_OK);

        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * @OA\Get (
     *      path="/team/{id}",
     *      operationId="getTeam",
     *      tags={"Team"},
     *      summary="Get team details",
     *      description="Returns details of the team",
     *      @OA\Response (
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent (ref="#/components/schemas/Team")
     *       ),
     *    @OA\Response(
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
     * Get team details
     *
     * @param int $id
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function getTeam(int $id): JsonResponse
    {
        try {
            $team = $this->teamRepository->getTeam($id);

            return new JsonResponse($team, Response::HTTP_OK);

        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * @OA\Post(
     *      path="/team",
     *      operationId="storeTeam",
     *      tags={"Team"},
     *      summary="Store new Team",
     *      description="To cerate a new team",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTeamRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Team")
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
     * Create a new team
     *
     * @param StoreTeamRequest $request
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function createTeam(StoreTeamRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $response = $this->teamRepository->storeTeam($request);

            return new JsonResponse($response, Response::HTTP_CREATED);

        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }

    }


    /**
     * @OA\Put(
     *      path="team/{id}",
     *      operationId="updateTeam",
     *      tags={"Team"},
     *      summary="Update existing Team",
     *      description="Update Team data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Team id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateTeamRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Players updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Team")
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
     * Update the team details.
     *
     * @param UpdateTeamRequest $request
     * @param $id
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function updateTeam(UpdateTeamRequest $request, $id): JsonResponse
    {
        try {
            $request->validated();
            $response = $this->teamRepository->updateTeam($request, $id);

            return new JsonResponse($response, Response::HTTP_ACCEPTED);

        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @OA\Delete(
     *      path="/team/{id}",
     *      operationId="deleteTeam",
     *      tags={"Team"},
     *      summary="Delete existing team",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Team id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Team deleted successfully",
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
     * Remove the specified team from storage.
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiExceptionHandler
     */
    public function deleteTeam($id): JsonResponse
    {
        try {
            $this->teamRepository->deleteTeam($id);

            return new JsonResponse(['massage' => 'Deleted Team successfully'], Response::HTTP_NO_CONTENT);

        } catch (\Exception $exception) {
            throw new ApiExceptionHandler($exception->getMessage(), $exception->getCode());
        }
    }
}
