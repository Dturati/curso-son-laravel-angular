<?php

namespace App\Http\Controllers;

use App\Entities\Client;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

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
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'Cliente não encontrado.'];
        }
    }

    /**
     * altera cliente
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            return response()->json($this->service->update($request->all(), $id));
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'Cliente não encontrado.'];
        }
    }

    /**
     * deleta cliente
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $this->repository->find($id)->delete();
            return ['success'=>true, 'msg' => 'Cliente deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'msg' => 'Cliente não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'Cliente não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'msg' => 'Ocorreu algum erro ao excluir o cliente.'];
        }
    }
}
