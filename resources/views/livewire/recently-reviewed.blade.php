<div wire:init="loadRecentlyReviewed" class="mt-8 space-y-12 recently-reviewed-container">
    @forelse ($recentlyReviewed as $recent)
          <div class="flex px-6 py-6 bg-gray-800 rounded-lg shadow-md game">
              <div class="relative flex-none bg-white">
                   <a href="#" class="">
                        <img src="{{ $recent['coverImageUrl'] }}" alt="game cover" class="w-48 transition duration-150 ease-in-out hover:opacity-75" />
                   </a>
                   <div class="absolute w-16 h-16 bg-gray-900 rounded-full -right-4 -bottom-4">
                        <div class="flex items-center justify-center h-full text-sm font-semibold">
                             {{ $recent['rating']}}
                        </div>
                   </div>
              </div>
              <div class="ml-12">
                   <a href="#" class="block mt-4 text-lg font-semibold leading-tight hover:text-gray-400">
                        {{ $recent['name'] }}
                   </a>
                   <div class="mt-1 text-gray-400">
                        {{ $recent['platforms'] }}
                   </div>
                   <p class="hidden mt-6 text-gray-400 lg:block">
                        {{ $recent['summary'] }}
                   </p>
              </div>

         </div>
         @empty
         @for($i = 0; $i < 3; $i++)     
         <div class="ph-item">
            <div class="flex flex-row w-full space-x-8 ph-col-12">
                <div class="flex-none w-64 h-64 bg-gray-800 ph-picture"></div>
                <div class="flex flex-col flex-wrap w-full ph-row">
                    <div class="w-1/3 h-6 bg-gray-800"></div>
                    <div class="w-1/4 h-4 mt-2 bg-gray-800"></div>
                    <div class="w-full h-32 mt-4 bg-gray-800"></div>
                </div>
            </div>
        </div>
         @endfor
    @endforelse     
</div>
