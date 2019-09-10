<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function index(Request $request)
    {
        return $this->_response(RoleResource::collection(Role::all()));
    }

    public function create()
    {

    }

    public function store(StoreRequest $storeRequest)
    {
        $role = Role::create($storeRequest->all());
        $role->refresh();

        return $this->_response(new RoleResource($role));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return $this->_response(new RoleResource($role));
    }

    public function update($id,UpdateRequest $updateRequest)
    {
        $request = $updateRequest->all();
        if(empty($request['password'])) unset($request['password']);

        $role = Role::findOrFail($id);
        $role->update($request);

        $role->refresh();

        return $this->_response(new RoleResource($role));

    }

    public function destroy()
    {

    }

    public function show($id)
    {
        $role = Role::findOrFail($id);

        return $this->_response(new RoleResource($role));
    }
}
