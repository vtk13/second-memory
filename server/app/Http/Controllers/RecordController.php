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
        return $this->recordRepository->findAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->recordService->create($request->all());
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
        $record = $this->recordRepository->find($id);

        $data = [
            'text' => $record->getText(),
            'href' => $record->getHref(),
            'type' => $record->getType(),
        ];

        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
