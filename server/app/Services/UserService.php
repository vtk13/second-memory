<?php
namespace App\Services;

use App\Entities\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->em = $entityManager;
    }

    public function create(array $data) : User
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}