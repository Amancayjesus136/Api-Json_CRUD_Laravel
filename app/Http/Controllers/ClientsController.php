<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Service;



class ClientsController extends Controller
{
    /**
     * Para devolver los clientes y servicios (todos)
     */
    public function index()
{
    $clients = Clients::all();
    $array = [];
    foreach ($clients as $client) {
        $services = $client->services()->get();
        $serviceArray = [];
        foreach ($services as $service) {
            $serviceArray[] = [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
            ];
        }
        $array[] = [
            'id' => $client->id,
            'name' => $client->name,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'services' => $serviceArray,
        ];
    }
    return response()->json($array);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $clients = new Clients;
        $clients->name = $request->name;
        $clients->email = $request->email;
        $clients->phone = $request->phone;
        $clients->address = $request->address;
        $clients->save();
        $data = [
            'message' => 'Client created successfully',
            'clients' => $clients
        ];
        return response()->json($data);
    }

    /**
     * Aca mapeamos clientes y servicios
     */
    public function show(string $id)
    {
        $client = Clients::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        
        $data = [
            'message' => 'Cliente encontrado exitosamente',
            'client' => $client,
            'services' => $client->services
        ];
        
        return response()->json($data);
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Clients::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        
        $client->name = $request->input('name');
        // Asignar otras propiedades del cliente
        
        $client->save();
        
        return response()->json($client);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Clients::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        
        $client->delete();
        
        return response()->json(['message' => 'Cliente eliminado correctamente']);
    }



    // agregar servicio de cliente


    public function attach(Request $request)
    {
        $client_id = $request->input('client_id');
        $service_id = $request->input('service_id');
        
        $client = Clients::find($client_id);
        if (!$client) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        
        $client->services()->attach($service_id);
        
        $data = [
            'message' => 'Servicio agregado correctamente al cliente',
            'client' => $client
        ];
        
        return response()->json($data);
    }



    // eliminar servicio de cliente

    public function detach(Request $request)
    {
        $client_id = $request->input('client_id');
        $service_id = $request->input('service_id');
        
        $client = Clients::find($client_id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        
        $client->services()->detach($service_id);
        
        $data = [
            'message' => 'Servicio removido correctamente del cliente',
            'client' => $client
        ];
        
        return response()->json($data);
    }





}
