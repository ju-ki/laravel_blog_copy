<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\UpvoteDownvote as ModelsUpvoteDownvote;
use Livewire\Component;

class UpvoteDownvote extends Component
{
    public Post $post;
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $upvotes =   ModelsUpvoteDownvote::where('post_id', "=", $this->post->id)
            ->where("is_upvote", "=", true)
            ->count();

        $downvotes =   ModelsUpvoteDownvote::where('post_id', "=", $this->post->id)
            ->where("is_upvote", "=", false)
            ->count();

        $hasUpvote = null;

        $user = request()->user();

        if ($user) {
            $model = ModelsUpvoteDownvote::where("post_id", "=", $this->post->id)
                ->where("user_id", "=", $user->id)->first();
        }

        if (!empty($model)) {
            $hasUpvote = !!$model->is_upvote;
        }
        return view('livewire.upvote-downvote', compact("upvotes", "downvotes", "hasUpvote"));
    }


    public function upvoteDownVote($upvote = true)
    {
        $user = request()->user();
        if (!$user) {
            return $this->redirect("login");
        }

        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $model = ModelsUpvoteDownvote::where('post_id', "=", $this->post->id)
            ->where('user_id', "=", $user->id)
            ->first();

        if (!$model) {
            ModelsUpvoteDownvote::create([
                "is_upvote" => $upvote,
                "post_id" => $this->post->id,
                "user_id" => $user->id
            ]);
            return;
        }

        if ($upvote && $model->is_upvote || !$upvote && !$model->is_upvote) {
            $model->delete();
        } else {
            $model->is_upvote = $upvote;
            $model->save();
        }
    }
}
