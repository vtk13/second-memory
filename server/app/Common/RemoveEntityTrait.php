<?php
namespace App\Common;

use Doctrine\ORM\EntityManagerInterface;

trait RemoveEntityTrait
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function removeEntity($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
