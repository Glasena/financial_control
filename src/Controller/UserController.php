<?php

namespace App\Controller;

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

        $user = new User();
        $user->setLogin($requestData->login);
        $user->setPassword($requestData->password);

        $entityManager->persist($user);

        $entityManager->flush();

        return $this->json($user);

    }

}
