<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ListRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(
        public UserServiceInterface $userService,
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function list(ListRequest $request)
    {
        try {
            $params = $request->validated();
            $data = $this->userService->list($params);

            return $this->responseSuccess(UserResource::collection($data));
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user)
    {
        //
    }
}
