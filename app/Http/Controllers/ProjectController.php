<?php

namespace App\Http\Controllers;

use App\Entities\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Http\Request;

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
        return $this->repository->with(['client', 'user'])->find($id);
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        return response()->json($this->service->update($request->all(), $id));
    }

    /**
     * 
     */
    public function destroy($id)
    {
        return response()->json($this->repository->find($id)->delete());
    }
}
