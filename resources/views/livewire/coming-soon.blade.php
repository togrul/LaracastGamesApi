<div wire:init="loadComingSoon" class="mt-8 space-y-10 coming-soon-container">
    @forelse ($comingSoon as $soon)
        <x-game-card-small :game=$soon />
    @empty
    @for($i = 0; $i < 4; $i++)     
        <x-game-card-skeleton-sm />
    @endfor
    @endforelse     
</div>