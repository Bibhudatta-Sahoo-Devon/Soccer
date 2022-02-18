<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Teams;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{

    private $repository;

    public function __construct(TeamRepositoryInterface $repository)
    {
       $this->repository =  $repository;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():JsonResponse
    {
        $allTeams = Teams::all();
        return new JsonResponse(['data' => $allTeams], Response::HTTP_OK);
    }

    /**
     *  @OA\Post(
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request):JsonResponse
    {
        $request->validated();
        $response =  $this->repository->store($request);
        return new JsonResponse($response, Response::HTTP_CREATED);

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
     * Update the specified resource in storage.
     *
     * @param UpdateTeamRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, $id):JsonResponse
    {
        $request->validated();
        $response = $this->repository->update($request,$id);
        return new JsonResponse($response, Response::HTTP_ACCEPTED);
    }

    /**
     *  @OA\Delete(
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
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id):JsonResponse
    {
        $this->repository->destroy($id);
        return new JsonResponse(['massage' => 'Deleted Team successfully'], Response::HTTP_NO_CONTENT);
    }
}
