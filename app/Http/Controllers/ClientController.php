<?php

namespace App\Http\Controllers;

use App\Entities\Client;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * lista todos os clientes
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * criar cliente
     * @param Request $request
     * @return static
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * altera cliente
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        return response()->json($this->service->update($request->all(), $id));
    }

    /**
     * deleta cliente
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return response()->json($this->repository->find($id)->delete());
    }
}
