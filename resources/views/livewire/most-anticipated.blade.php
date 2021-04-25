<div wire:init="loadMostAnticipated" class="mt-8 space-y-10 most-anticipated-container">
    @forelse ($mostAnticipated as $most)
        <x-game-card-small :game=$most />
    @empty
        @for($i = 0; $i < 4; $i++)     
            <x-game-card-skeleton-sm />
        @endfor
    @endforelse     
</div>
