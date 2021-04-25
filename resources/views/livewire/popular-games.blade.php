<div wire:init="loadPopularGames" 
      class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 popular-games"
 >
    @forelse($popularGames as $game)
        <x-game-card :game=$game />
    @empty
         @for($i = 0; $i < 12; $i++)     
            <div class="ph-item">
                <div class="flex flex-col w-full ph-col-12">
                    <div class="w-full h-64 bg-gray-800 ph-picture"></div>
                    <div class="flex flex-wrap ph-row">
                        <div class="w-full h-4 mt-4 bg-gray-800 ph-col-12"></div>
                        <div class="w-1/3 h-4 mt-2 bg-gray-800 ph-col-4 ph-col-12"></div>
                    </div>
                </div>
            </div>
         @endfor
    @endforelse 
</div>

@push('js')
    @include('partials._rating',[
        'event' => 'gameWithRatingAdded'
    ])
@endpush