<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    //GET all resource
    public function index()
    {
        return 'nzkdlfnsdlkfnsd all resource o lo que quieras';
    }


    public function show($id){
        return 'visualizando el id '.$id;
    }

    //POST save data
    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'name' => 'required|string|max:100'
        ]);

        if ($validador->fails()) {
            return $validador->errors();
        }

        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');
        $status = $request->get('status');

        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];

        return response()->json($data, 201);
    }

    public function update($id){
        return 'actualizando el id '.$id;
    }

    public function destroy($id){
        return 'eliminando el id '.$id;
    }
}
