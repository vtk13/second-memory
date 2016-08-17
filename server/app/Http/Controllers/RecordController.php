<?php

namespace App\Http\Controllers;

use App\Entities\Record;
use App\Services\RecordService;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Http\Requests;

class RecordController extends ApiController
{
    protected $recordRepository;
    protected $recordService;

    public function __construct(EntityManagerInterface $entityManager, RecordService $recordService)
    {
        parent::__construct($entityManager);
        $this->recordRepository = $this->em->getRepository(Record::class);
        $this->recordService = $recordService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        /**
         * @var Record $record
         */
        foreach ($this->findAll(Record::class) as $record) {
            $data[] = [
                'text' => $record->getText(),
                'href' => $record->getHref(),
                'type' => $record->getType(),
            ];
        }
        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record =  $this->recordService->create($request->all());

        $data = [
            'text' => $record->getText(),
            'href' => $record->getHref(),
            'type' => $record->getType(),
        ];

        return response()->json(['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * @var Record $record
         */
        $record = $this->findEntity($id, Record::class);

        $data = [
            'text' => $record->getText(),
            'href' => $record->getHref(),
            'type' => $record->getType(),
        ];

        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record =  $this->recordService->update($this->findEntity($id, Record::class), $request->all());

        $data = [
            'text' => $record->getText(),
            'href' => $record->getHref(),
            'type' => $record->getType(),
        ];

        return response()->json(['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->findEntity($id, Record::class);
        $this->recordService->removeEntity($record);

        return response()->json();
    }
}
