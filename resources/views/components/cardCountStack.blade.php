<?php
    if(!isset($width))
        $width = 50;

    if(!isset($stackWidth))
        $stackWidth = $width / 5;

    $count = $card->pivot->count;
?>

<div style="position: relative; display: inline-block; width: {{ ($width + ($count - 1)*$stackWidth) }}px; height: {{ $width/480*680 }}px;">
    @for($i = $count - 1; $i > 0; $i--)
        <img width="{{ $width }}" src="{{ $card->imagePath() }}" style="position: absolute; right: {{ $i*$stackWidth }}px;">
    @endfor
    <img width="{{ $width }}" src="{{ $card->imagePath() }}" style="position: absolute; right: 0;">
</div>