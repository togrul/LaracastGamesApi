<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PopularGames extends Component
{
    public $popularGames=[];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $after = Carbon::now()->addMonth(2)->timestamp;

        $popularGamesUnformatted = Cache::remember('popular-games',14, function () use ($before, $after) {
            return Http::withHeaders(config('services.igdb'))
            ->withBody("fields name,first_release_date,rating,cover.url,platforms.abbreviation,rating_count,slug;
                     where platforms.id = (48,49,130,6) & (
                         first_release_date >= {$before}
                         & first_release_date < {$after}
                     );
                     sort rating desc; limit 12;","text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();
        });

        $this->popularGames=$this->formatForView($popularGamesUnformatted);
        
        collect($this->popularGames)->filter(function($game){
            return $game['rating'];
        })->each(function($game){
            $this->emit('gameWithRatingAdded',[
                'slug'=>$game['slug'],
                'rating'=>$game['rating'] / 100
            ]);
        });
    }

    public function render()
    {
        return view('livewire.popular-games');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl'=> Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']??asset('img/game2.svg')),
                'rating'=>isset($game['rating']) ? round($game['rating']) :0,
                'platforms'=> collect($game['platforms'])->pluck('abbreviation')->implode(', ')
            ]);
        })->toArray();
    }
}
