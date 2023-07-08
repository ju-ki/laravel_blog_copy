<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Comments extends Component
{
    public Collection $comments;
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh'
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }


    public function render()
    {
        $comments = $this->comments = $this->selectComments();
        return view('livewire.comments', compact('comments'));
    }

    public function commentCreated(int $id)
    {
        $comment = Comment::where('id', '=', $id)->first();
        if (!$comment->parent_id) {
            $this->comments = $this->comments->prepend($comment);
        }
    }


    public function commentDeleted(int $id)
    {
        $comment = Comment::where('id', '=', $id)->first();
        $this->comments = $this->comments->reject(function ($comment)  use ($id) {
            return $comment->id == $id;
        });
    }


    public function selectComments()
    {
        return Comment::where('post_id', '=', $this->post->id)
            ->with(['post', 'user'])
            ->orderByDesc('created_at')
            ->get();
    }
}
