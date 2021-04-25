<div class="flex game">
    <a href="#" class="">
         <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="w-16 transition duration-150 ease-in-out hover:opacity-75" />
    </a>
    <div class="ml-4">
         <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
         <div class="mt-1 text-sm text-gray-400">
              {{  $game['releaseDate'] }}
         </div>
    </div>
</div>