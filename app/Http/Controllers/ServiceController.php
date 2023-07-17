<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
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
        $service = new Service;
        $service->name = $request->name;
        $service->descripcion = $request->descripcion;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'Servicio creado correctamente',
            'service' => $service
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        return response()->json($service);
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
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        
        $service->name = $request->input('name');
        $service->descripcion = $request->input('descripcion');
        $service->price = $request->input('price');
        // Asignar otras propiedades del servicio
        
        $service->save();
        
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        
        $service->delete();
        
        return response()->json(['message' => 'Servicio eliminado correctamente']);
    }




    public function clients(Request $request)
{
    $service = Service::find($request->input('service_id'));
    
    if (!$service) {
        return response()->json(['message' => 'Servicio no encontrado'], 404);
    }
    
    $clientCount = $service->clients()->count();
    
    $data = [
        'message' => 'Cantidad de clientes para el servicio obtenida exitosamente',
        'client_count' => $clientCount
    ];
    
    return response()->json($data);
}


}
