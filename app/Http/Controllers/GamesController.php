<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $body='
        // query games "PopularGames" {
        //     fields name,first_release_date,rating,cover.url,platforms.abbreviation,rating_count;
        //     where platforms.id = (48,49,130,6);
        //     sort rating desc; limit 12;
        // };

        // query games "MostAnticipated" {
        //     fields name,first_release_date,rating,cover.url,platforms.abbreviation,rating_count,summary;
        //     where platforms.id = (48,49,130,6);
        //     sort rating desc; limit 4;
        // };
        // ';

        // $client = new Client(['base_uri'=>'https://api.igdb.com/v4/']);

        // $response = $client->request('POST','multiquery',[
        //     'headers'=> config('services.igdb'),
        //     'body'=> $body
        // ]);

     
        // dd(json_decode($response->getBody()));

        return view('index');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $game= Http::withHeaders(config('services.igdb'))
        ->withBody(
            "fields *,cover.url,platforms.abbreviation,age_ratings.*,genres.name,involved_companies.company.name,videos.video_id,screenshots.*,similar_games.*,similar_games.cover.url,similar_games.platforms.*,websites.*;
             where slug=\"{$slug}\";
            ","text/plain")
        ->post('https://api.igdb.com/v4/games')
        ->json();

        // dd($this->formatGameForView($game[0]) );

        abort_if(!$game,404);

        return view('show',[
            'game'=> $this->formatGameForView($game[0]) 
        ]);
    }

    private function formatGameForView($game)
    {
        return collect($game)->merge([
            'coverImageUrl'=> Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']??asset('img/game2.svg')),
            'genres' => collect($game['genres'])->pluck('name')->implode(', '),
            'involvedCompanies' =>  $game['involved_companies'][0]['company']['name'],
            'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
            'memberRating' => array_key_exists('age_ratings',$game) ? round(($game['age_ratings'][0]['rating'] *100) / 12): 0,
            'criticRating'=>isset($game['age_ratings'][1]) ? round(($game['age_ratings'][1]['rating'] *100) / 12): 0,
            'trailer' => 'https://youtube.com/embed/'.$game['videos'][0]['video_id'],
            'screenshots' => collect($game['screenshots'])->map(function ($screenshot){
                return [
                    'huge' =>  Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                    'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']??asset('img/bg.png'))
                ];
            })->take(9),
            'similarGames' => collect($game['similar_games'])->map(function($game){
                return collect($game)->merge([
                    'coverImageUrl' => array_key_exists('cover',$game)
                    ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url'])
                    : 'https://via.placeholder.com/264x352',
                    'rating' =>  isset($game['rating'])?round($game['rating']):null,
                    'platforms' => array_key_exists('platforms',$game)
                    ? collect($game['platforms'])->pluck('abbreviation')->implode(', ')
                    : null,
                ]);
            })->take(6),
            'social'=> array_key_exists('websites',$game)
            ?[
                'website' => collect($game['websites'])->first(),
                'facebook' => collect($game['websites'])
                    ->filter(fn ($website) => Str::contains($website['url'], 'facebook'))->first(),
                'twitter' => collect($game['websites'])
                    ->filter(fn ($website) => Str::contains($website['url'], 'twitter'))->first(), 
                'instagram' => collect($game['websites'])
                    ->filter(fn ($website) => Str::contains($website['url'], 'instagram'))->first(),       
            ]
            : []
        ])->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
