<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        if (!$clients) {
            return response()->json('Client not found', 404);
        }
        return response()->json($clients);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());
        return response()->json([
            'message' => 'Client created successfully',
            'client' => $client
        ], 201);
    }
    /**
     * Display the specified resource.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json('Client not found', 404);
        }
        return response()->json($client);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Iluminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json('Client not found', 404);
        }
        $client->update($request->validated());
        return response()->json([
            'message' => 'Client updated successfully',
            'client' => $client
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json('Client not found', 404);
        }
        $client->delete();
        return response()->json([
            'message' => 'Client deleted successfully'
        ], 204);
    }
}
