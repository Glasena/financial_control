<?php

namespace App\Controller;

use App\AppError\UserExceptions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $requestData = json_decode($request->getContent());

        //Validação se os campos obrigatórios estão pendentes
        if (!isset($requestData->login) or !isset($requestData->password)) {
            return UserExceptions::UserExceptionsJson("Request Inválida !", 400);
        }

        $hash = password_hash($requestData->password, PASSWORD_DEFAULT);

        $user = new User();
        $user->setLogin($requestData->login);
        $user->setPassword($hash);

        $entityManager->persist($user);

        $entityManager->flush();

        return $this->json($user);

    }

}
