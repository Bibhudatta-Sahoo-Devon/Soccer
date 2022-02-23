<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class APIController extends Controller
{

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Login"},
     *      summary="To login to soccer",
     *      description="To get access token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Login successfully",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResponse")
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
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request):JsonResponse
    {
        if(!Auth::attempt($request->only('email','password'))){
            return new JsonResponse([
                'message' => 'Invalid Credentials!'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user  =  Auth::user();

        if($user->role == 'A')
        $jwtToken  = $user->createToken('jwtToken',['admin'])->plainTextToken;
        else
        $jwtToken  = $user->createToken('jwtToken',['user'])->plainTextToken;

        return new JsonResponse(['token'=>$jwtToken],Response::HTTP_OK);
    }


    /**
     * @return JsonResponse
     */
    public function logout():JsonResponse
    {
        $cookie = Cookie::forget('jwt');
        return new JsonResponse(['message'=>'Logout Successfully'],Response::HTTP_OK);
    }

}
