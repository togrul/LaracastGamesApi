<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ComingSoon extends Component
{
    public $comingSoon=[];

    public function loadComingSoon()
    {
        $current = Carbon::now()->timestamp;

        $unformatted= Http::withHeaders(config('services.igdb'))
            ->withBody("fields name,first_release_date,rating,cover.url,platforms.abbreviation,rating_count,summary,slug;
                     where platforms.id = (48,49,130,6) & (
                         first_release_date >= {$current}
                     );
                     sort first_release_date asc; limit 4;","text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();      

            $this->comingSoon = $this->formatForView($unformatted);
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl'=> Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']??asset('img/game2.svg')),
                'releaseDate'=>Carbon::parse($game['first_release_date'])->format('M d, Y'),
            ]);
        })->toArray();
    }
}
