<?php 

namespace App\AppError;

use Symfony\Component\HttpFoundation\JsonResponse;

class UserExceptions {

    public static function UserExceptionsJson($message, $error): JsonResponse {

        $response = new JsonResponse($message, $error);

        return $response;

    }
}

?>