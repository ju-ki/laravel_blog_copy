<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use App\Models\UpvoteDownvote;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    protected int | string | array $columnSpan = 3;


    public ?Model $record = null;

    protected function getViewData(): array
    {
        if (!is_null($this->record)) {
            return [
                'viewCount' => PostView::where('post_id', '=', $this->record->id)->count(),
                'upVotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 1)->count(),
                'downVotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 0)->count(),
            ];
        }
        return ['viewCount' => 0, 'upVotes' => 0, 'downVotes' => 0];
    }
    protected static string $view = 'filament.widgets.post-overview';
}
