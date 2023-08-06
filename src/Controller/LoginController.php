<?php

namespace App\Controller;

use App\AppError\UserExceptions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Firebase\JWT\JWT;
use App\Entity\User;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_user')]
    public function login(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $requestData = json_decode($request->getContent());

        //Validação se os campos obrigatórios estão pendentes
        if (!isset($requestData->login) or !isset($requestData->password)) {
            return UserExceptions::UserExceptionsJson("Request Inválida !", 400);
        }

        $repository = $entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['login' => $requestData->login]);

        if (!($user) or !(password_verify($requestData->password, $user->getPassword()))) {
            return UserExceptions::UserExceptionsJson("Usuário Inválido !", 400);
        }

        $key = $_ENV['APP_SECRET'];
            
        $payload = array(
            "iss" => "financial_control.com",  // Emissor do token
            "aud" => "financial_control.com",  // Público alvo do token (geralmente o mesmo que o emissor)
            "iat" => time(),                   // Hora em que o JWT foi emitido
            "nbf" => time(),                   // Não antes de
            "exp" => time() + (60*60),         // Expiração do token, neste caso, 1 hora
            "data" => [                        // Dados customizados que você deseja enviar no token
                "userId" => $user->getId()
            ]
        );
            
        $jwt = JWT::encode($payload, $key, 'HS256');

        return $this->json($jwt);

    }

}
