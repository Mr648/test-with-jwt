<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $author;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $author)
    {
        $this->author = $author;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.authors.author_created', [
            'author' => $this->author
        ]);
    }
}
