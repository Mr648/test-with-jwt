<?php


namespace App\Services\V1;


use App\Models\User;
use App\Services\Base\AuthorService;
use Illuminate\Http\Request;

class AuthorManager extends AuthorService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }

    public function show(Request $request, $id)
    {
        // TODO: Implement show() method.
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
