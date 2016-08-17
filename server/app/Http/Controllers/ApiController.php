<?php
namespace App\Http\Controllers;

use Doctrine\ORM\EntityManagerInterface;

class ApiController extends Controller
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    protected function findEntity($id, $entityName)
    {
        $repository = $this->em->getRepository($entityName);
        $entity = $repository->find($id);

        if (!$entity) {
            throw new \Exception($entityName . ' id=' . $id . ' not found');
        }

        return $entity;
    }

    protected function findAll($entityName)
    {
        $repository = $this->em->getRepository($entityName);
        return $repository->findAll();
    }
}
