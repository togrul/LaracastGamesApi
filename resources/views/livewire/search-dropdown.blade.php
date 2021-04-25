<div 
        class="relative" 
        x-data="{isVisible:true}"
        @click.away="isVisible = false"
>
    <input 
        wire:model.debounce.300ms="search" 
        type="text" class="w-64 px-3 py-1 pl-8 text-sm bg-gray-800 rounded-full focus:outline-none focus:shadow-outline" 
        placeholder="Search (Press '/' to focus)"
        x-ref="search"
        @focus="isVisible = true"
        @keydown.escape.window="isVisible=false"
        @keydown="isVisible=true"
        @keydown.shift.tab="isVisible = false"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
    >
    <div class="absolute top-0 flex items-center h-full ml-2">
         <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>

    <div wire:loading class="absolute top-0 right-0 mt-1">
        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <div class="absolute z-50 w-64 mt-2 text-xs bg-gray-800 rounded" x-show.transition.opacity.duration.1000="isVisible">
        <ul>
            @forelse ($searchResults as $game)
            <li class="border-b border-gray-700">
                <a 
                    href="{{ route('games.show',$game['slug']) }}" 
                    class="flex items-center px-3 py-3 transition duration-150 ease-in-out hover:bg-gray-700"
                    @if($loop->last) @keydown.tab="isVisible = false" @endif
                >
                    @if(isset($game['cover']))
                        <img class="w-10" src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}" alt="">
                    @else
                        <img src="https://via.placeholder.com/264x352" alt='game cover' class="w-10" />    
                    @endif
                    <span class="ml-4">{{ $game['name'] }}</span>
                </a>
            </li>
            @empty
            <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endforelse
           
        </ul>
    </div>
</div>