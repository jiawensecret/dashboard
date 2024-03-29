<?php

namespace App\Http\Controllers\Api;

use App\Model\OauthClient;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return $this->_response(AdminResource::collection(Admin::all()));
    }

    public function create()
    {

    }

    public function store(StoreRequest $storeRequest)
    {
        $admin = Admin::create($storeRequest->all());
        $admin->refresh();

        return $this->_response(new AdminResource($admin));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return $this->_response(new AdminResource($admin));
    }

    public function update($id,UpdateRequest $updateRequest)
    {
        $request = $updateRequest->all();
        if(empty($request['password'])) unset($request['password']);

        $admin = Admin::findOrFail($id);
        $admin->update($request);

        $admin->refresh();

        return $this->_response(new AdminResource($admin));

    }

    public function destroy()
    {

    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);

        return $this->_response(new AdminResource($admin));
    }

    public function login(LoginRequest $loginRequest)
    {
        $oauth = OauthClient::find(1);

        $http = new Client();

        $response = $http->post(url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oauth->id,
                'client_secret' => $oauth->secret,
                'username' => $loginRequest->post('username',''),
                'password' => $loginRequest->post('password',''),
                'scope' => '*',
            ],
        ]);

        return response()->json(json_decode($response->getBody(),true));
    }

    public function logout()
    {

    }

    public function info()
    {
        $admin = Auth::guard('api')->user();

        return $this->_response(new AdminResource($admin));
    }
}
