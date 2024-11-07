<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Todo::query()->select(DB::raw("CONCAT_WS(', ', id, name, description) AS Registro"), 'status')->get();
    }


    public function show($id){
        return Todo::query()->select(DB::raw("CONCAT_WS(', ', id, name, description) AS Registro"), 'status')->find($id);
    }

    //POST save data
    public function store(Request $request)
    {

        $data = [
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ];

        try {
            $todo = Todo::query()->create($data);
        }catch (\Exception $e){
            return response()->unprocessable('Algo salio mal', ['hubo un problema al crear el registro']);
        }

        return response()->success($todo);
    }

    public function update(Request $request, $id){
        $status  = $request->get('status');
        $registro = Todo::query()->find($id);
        $registro->update(['status' => $status]);

        return response()->success($registro);
    }

    public function destroy($id){
        $registro = Todo::withTrashed()->find($id);
        if (!$registro->deleted_at) {
            $registro->delete();
        }else{
            $registro->restore();
        }

        return response()->success(['data' => 'OKAY']);

    }
}
