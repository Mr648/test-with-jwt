<?php


namespace App\Services\V1;


use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use App\Services\Base\BookService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookManager extends BookService
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    public function validateInputs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'required|integer|exists:users,id',
            'name' => 'required|string|between:2,100',
            'pages' => 'required|integer|min:1',
            'publisher' => 'required|string|between:2,100'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }


    }

    public function store(Request $request)
    {
        $this->validateInputs($request);

        $author = User::query()->find($request->get('author'));

        $book = new Book([
            'name' => $request->get('name'),
            'pages' => $request->get('pages'),
            'publisher' => $request->get('publisher'),
        ]);

        $author->books()->save($book);

        return response()->json([
            'message' => 'Book successfully created',
            'book' => BookResource::make($book)
        ], 201);
    }

    public function destroy($id)
    {
        $book = $this->getBaseQuery()->findOrFail($id);
        $book->delete();
        return response()->json([
            'message' => 'Book successfully deleted',
        ]);
    }

    public function list(Request $request)
    {
        return BookResource::collection($this->getBaseQuery(['author'], ['author'])->get());
    }

    public function show(Request $request, $id)
    {
        return BookResource::make($this->getBaseQuery(['author'], ['author'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $book = $this->getBaseQuery()->findOrFail($id);
        $this->validateInputs($request);
        $update = [
            'name' => $request->get('name'),
            'pages' => $request->get('pages'),
            'publisher' => $request->get('publisher'),
        ];

        if ($book->author_id != $request->get('author')) {
            $update = array_merge($update, [
                'author_id' => $request->get('author')
            ]);
        }

        $book->update($update);

        return response()->json([
            'message' => 'Book successfully updated',
            'book' => BookResource::make($book)
        ]);
    }
}
