<?php


namespace App\Services\V1;


use App\Http\Resources\AuthorResource;
use App\Mail\AuthorCreated;
use App\Models\Enums\Roles;
use App\Models\User;
use App\Services\Base\AuthorService;
use App\Traits\Administrator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthorManager extends AuthorService
{

    use Administrator;

    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function list(Request $request)
    {
        return AuthorResource::collection($this->getBaseQuery(['books'], ['books'])->get());
    }

    public function show(Request $request, $id)
    {
        return AuthorResource::make($this->getBaseQuery(['books'], ['books'])->findOrFail($id));
    }

    public function validateInputs(Request $request, $authorId = null)
    {
        $emailUniqueRole = Rule::unique('users', 'email');

        $emailRules = [
            'required',
            'string',
            'email',
            'max:100',
            !is_null($authorId)
                ? $emailUniqueRole->ignore($authorId)
                : $emailUniqueRole
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'family' => 'required|string|between:2,100',
            'email' => $emailRules,
            'password' => 'required|string|confirmed|min:6',
            'avatar' => 'nullable|file|mimes:jpg,png,gif,jpeg,bmp|dimensions:min_width=250,min_height=250',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function store(Request $request)
    {
        $this->validateInputs($request);

        $path = null;
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('/', $request->file('avatar'));
        }

        $author = User::create([
            'name' => $request->get('name'),
            'family' => $request->get('family'),
            'email' => $request->get('email'),
            'avatar' => $path,
            'role' => Roles::AUTHOR,
            'password' => bcrypt($request->get('password'))
        ]);

        // sending an email to admin
        Mail::to($this->getAdministrator())->send(new AuthorCreated($author));

        return response()->json([
            'message' => 'Author successfully created',
            'author' => AuthorResource::make($author)
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $author = $this->getBaseQuery()->findOrFail($id);

        $this->validateInputs($request, $author->id);

        $path = $author->avatar;
        if ($request->hasFile('avatar')) {
            // delete previous avatar image
            if (Storage::disk('public')->exists($author->avatar)) {
                Storage::disk('public')->delete($author->avatar);
            }
            // upload new image
            $path = Storage::disk('public')->put('/', $request->file('avatar'));
        }

        $author->update([
            'name' => $request->get('name'),
            'family' => $request->get('family'),
            'email' => $request->get('email'),
            'avatar' => $path,
            'password' => bcrypt($request->get('password'))
        ]);

        return response()->json([
            'message' => 'Author successfully updated',
            'author' => AuthorResource::make($author)
        ]);
    }

    public function destroy($id)
    {
        $author = $this->getBaseQuery()->findOrFail($id);
//        $author->books()->delete(); // if want to delete all author books, uncomment this line.
        if (Storage::disk('public')->exists($author->avatar)) {
            Storage::disk('public')->delete($author->avatar);
        }
        $author->delete();
        return response()->json([
            'message' => 'Author successfully deleted',
        ]);
    }
}
