<?php
namespace App\Entities\Columns;

use Doctrine\ORM\Mapping AS ORM;

trait Id
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id ;

    public function getId()
    {
        return $this->id;
    }
}
