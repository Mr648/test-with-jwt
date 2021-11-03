<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Auth\AuthenticatorController;
use App\Models\Book;
use App\Services\Base\BookService;
use Illuminate\Http\Request;

class BookController extends AuthenticatorController
{

    protected $books;

    public function __construct(BookService $service)
    {
        parent::__construct();
        $this->books = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->books->list($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->books->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $book)
    {
        return $this->books->show($request,$book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        return $this->books->update($request,$book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        return $this->books->destroy($book);
    }
}
