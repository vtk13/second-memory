<?php
namespace App\Services;

use App\Common\ValidatorTrait;
use App\Entities\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    use ValidatorTrait;

    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->em = $entityManager;
    }

    public function create(array $data): User
    {
        $this->validate($data, $this->getValidateRules());

        $user = new User();
        $this->em->persist($this->setFields($user, $data));
        $this->em->flush();

        return $user;
    }

    private function setFields(User $user, array $data): User
    {
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setPassword($data['password']);

        return $user;
    }

    private function getValidateRules()
    {
        return [
            'email' => 'required',
            'name'  => 'required',
            'password' => 'required'
        ];
    }

}
