<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info  (
 *      version="1.0.0",
 *      title="Soccer Api Documentation",
 *      description="Soccer API for doing CURD operation.",
 *      @OA\Contact(
 *          email="b.sahoo@devon.nl"
 *      ),
 * )
 *
 * @OA\Server (
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Soccer API Server"
 * )

 *
 * @OA\Tag (
 *     name="Soccer",
 *     description="API Endpoints of Soccer"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
