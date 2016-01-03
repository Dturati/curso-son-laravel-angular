<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * lista todos os clientes
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * criar cliente
     * @param Request $request
     * @return static
     */
    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Client::find($id);
    }

    /**
     * altera cliente
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        return Client::find($id)->update($request->all());
    }

    /**
     * deleta cliente
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return Client::find($id)->delete();
    }
}
