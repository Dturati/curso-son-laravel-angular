<?php

namespace App\Http\Controllers;

use App\Entities\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    private $repository;
    private $service;

    /**
     * 
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * 
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * 
     */
    public function show($id)
    {
        try {
             return $this->repository->with(['client', 'user'])->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'O Projeto não foi encontrado.'];
        }
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        try {
            return response()->json($this->service->update($request->all(), $id));
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'O Projeto não foi encontrado.'];
        }
    }

    /**
     * 
     */
    public function destroy($id)
    {
        try {
            $this->repository->find($id)->delete();
            return ['success'=>true, 'msg' => 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'msg' => 'O Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'Projeto não foi encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'msg' => 'Ocorreu algum erro ao excluir o Projeto.'];
        }
    }
}
