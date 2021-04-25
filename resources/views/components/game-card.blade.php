<div class="mt-8 game">
        <div class="relative inline-block bg-white">
             <a href="{{ route('games.show',$game['slug']) }}" class="">
                  <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="transition duration-150 ease-in-out hover:opacity-75" />
             </a>
             @if($game['rating'])
             <div id="{{ $game['slug'] }}" class="absolute w-16 h-16 bg-gray-800 rounded-full -right-4 -bottom-4">
             </div>

               @push('js')
                    @include('partials._rating',[
                         'slug' => $game['slug'],
                         'rating' => $game['rating'],
                         'event' => null
                    ])
               @endpush
             @endif
        </div>
        <a href="{{ route('games.show',$game['slug']) }}" class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">
             {{ $game['name'] }}
        </a>
        <div class="mt-1 text-gray-400">
             {{ $game['platforms'] }}
        </div>
</div>   
