<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed=[];

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $unformatted = Http::withHeaders(config('services.igdb'))
            ->withBody("fields name,first_release_date,rating,cover.url,platforms.abbreviation,rating_count,summary,slug;
                     where platforms.id = (48,49,130,6) & (
                         first_release_date >= {$before}
                         & first_release_date < {$current}
                         & rating_count > 5
                     );
                     sort rating desc; limit 3;","text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

            $this->recentlyReviewed = $this->formatForView($unformatted);
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl'=> Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']??asset('img/game2.svg')),
                'rating'=>isset($game['rating']) ? round($game['rating']).'%' :null,
                'platforms'=> collect($game['platforms'])->pluck('abbreviation')->implode(', ')
            ]);
        })->toArray();
    }
}
