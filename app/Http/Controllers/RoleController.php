<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }


    public function show($id){
        return Role::query()->find($id);
    }

    //POST save data
    public function store(Request $request)
    {

        $data = $request->all();

        try {
            $role = Role::query()->create($data);
        }catch (\Exception $e){
            return response()->unprocessable('Algo salio mal', ['hubo un problema al crear el registro']);
        }

        return response()->success($role);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $registro = Role::query()->find($id);
        $registro->update($data);

        return response()->success($registro);
    }

    public function destroy($id){
        $registro = Role::withTrashed()->find($id);
        if (!$registro->deleted_at) {
            $registro->delete();
        }else{
            $registro->restore();
        }

        return response()->success(['data' => 'OKAY']);

    }
}
