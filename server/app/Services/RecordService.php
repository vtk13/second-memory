<?php
namespace App\Services;

use App\Entities\Record;
use Doctrine\ORM\EntityManagerInterface;

class RecordService
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->em = $entityManager;
    }

    public function create(array $data) : Record
    {
        $record = new Record();
        $this->em->persist($this->setFields($record, $data));
        $this->em->flush();

        return $record;
    }

    public function update(Record $record, $data) : Record
    {
        $this->setFields($record, $data);
        $this->em->flush();
    }

    private function setFields(Record $record, $data)
    {
        $record->setHref($data['href']);
        $record->setText($data['text']);
        $record->setType($data['type']);

        return $record;
    }
}