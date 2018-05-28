<div class="d-flex flex-wrap justify-content-between" style="width: 100%;">
    @foreach($cards->take(5) as $card)
        <?php
        if (!$card->users->isEmpty())
            $count = $card->users->where('id', Auth::id())
                ->first()->pivot->count;
        else
            $count = false;
        ?>
        <div class="mct-card">
            {{ print_r($card->toArray()) }}
            <img class="mct-image {{ (!$count) ? 'fade-out' : '' }}" src="{{ $card->imagePath() }}"
                 alt="Card image of {{ $card->name }}">
        </div>
    @endforeach
    @for($i=0; $i < 10; $i++)
        <div style="width: 200px; height: 0; margin: 5px 3px;"></div>
    @endfor
</div>