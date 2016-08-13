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
}
