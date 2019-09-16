<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Http\Resources\PermissionResource;
use App\Model\Permission;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    public function index(Request $request)
    {
        return PermissionResource::collection(Permission::paginate());
    }

    public function create()
    {

    }

    public function store(StoreRequest $storeRequest)
    {
        $permission = Permission::create($storeRequest->all());
        $permission->refresh();

        return $this->_response(new PermissionResource($permission));
    }

    public function edit($id)
    {
        $Permission = Permission::findOrFail($id);

        return $this->_response(new PermissionResource($Permission));
    }

    public function update($id,UpdateRequest $updateRequest)
    {
        $request = $updateRequest->all();
        if(empty($request['password'])) unset($request['password']);

        $Permission = Permission::findOrFail($id);
        $Permission->update($request);

        $Permission->refresh();

        return $this->_response(new PermissionResource($Permission));

    }

    public function destroy()
    {

    }

    public function show($id)
    {
        $Permission = Permission::findOrFail($id);

        return $this->_response(new PermissionResource($Permission));
    }
}
