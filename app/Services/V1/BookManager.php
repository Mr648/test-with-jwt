<?php


namespace App\Services\V1;


use App\Models\Book;
use App\Services\Base\BookService;
use Illuminate\Http\Request;

class BookManager extends BookService
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }

    public function show(Request $request, $id)
    {
        // TODO: Implement show() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }
}
