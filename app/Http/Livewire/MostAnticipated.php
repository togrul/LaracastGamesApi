<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class MostAnticipated extends Component
{
    public $mostAnticipated=[];

    public function loadMostAnticipated()
    {
        $current = Carbon::now()->timestamp;
        $after_four_month = Carbon::now()->addMonth(4)->timestamp;

        $unformatted= Http::withHeaders(config('services.igdb'))
        ->withBody("fields name,first_release_date,rating,cover.url,platforms.abbreviation,rating_count,summary,slug;
                 where platforms.id = (48,49,130,6) & (
                     first_release_date >= {$current}
                     & first_release_date < {$after_four_month}
                 );
                 sort rating desc; limit 4;","text/plain")
        ->post('https://api.igdb.com/v4/games')
        ->json(); 
        
        $this->mostAnticipated = $this->formatForView($unformatted);
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl'=> Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']??asset('img/game2.svg')),
                'releaseDate'=>Carbon::parse($game['first_release_date'])->format('M d, Y')
            ]);
        })->toArray();
    }
}
