<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Auth\AuthenticatorController;
use App\Services\Base\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends AuthenticatorController
{

    protected $authors;

    public function __construct(AuthorService $service)
    {
        parent::__construct(['index', 'show']);
        $this->authors = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->authors->list($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->authors->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        return $this->authors->show(\request(), $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {
        return $this->authors->update($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        return $this->authors->destroy($user);
    }
}
