@extends('layouts.app', [
    'title' => $card->name
])

@section('content')
    <div class="row" style="margin: 40px 0;">
        <div class="col-sm-4 ml-auto">
            <img style="width: 100%" src="{{ $card->imagePath() }}">
        </div>
        <div class="col-sm-4 mr-auto">
            <div class="row mt-3 mb-2">
                <div class="col-sm-12">
                    <h3 style="display: inline;"  class="">{{ $card->name }}</h3>
                    <div class="pull-right">
                        <span style="font-size: 1.2em;">
                            @include('components.costSymbols', ['cost' => $card->manaCost, 'options' => 'ms-cost ms-shadow'])
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    {{ $card->type }}
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-12 well">
                    @foreach($card->vueItem()->textP as $text)
                        <p>{!! $text !!}</p>
                    @endforeach
                    <p><i>{{ $card->flavor }}</i></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('components.raritySymbol', ['setCode' => $card->setCode, 'rarity' => $card->rarity, 'options' => 'ss-2x ss-fw mr-2 ss-dark'])     {{ $card->numberNumeric }}
                    @if($card->meta['types'][0] == 'Creature')
                        <div style="font-size: 1.2em;" class="pull-right font-weight-bold">
                            {{ $card->power }} / {{ $card->toughness }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h4>Laravel Object</h4>
        <div class="col-sm-8 mx-auto" id="json-col2"></div>
    </div>
    <div class="row">
        <h4>VueItem</h4>
        <div class="col-sm-8 mx-auto" id="json-col"></div>
    </div>

@endsection

@section('scripts')
    <script>
        var cardData = {!! json_encode($card->vueItem()) !!}
        var cardData2 = {!! json_encode($card->getAttributes()) !!}

        const formatter = new JSONFormatter(cardData, 0, {
                theme: 'dark',
            });

        const formatter2 = new JSONFormatter(cardData2, 0, {
            theme: 'dark',
        });

        formatter.openAtDepth(1);

        document.getElementById('json-col').appendChild(formatter.render());
        document.getElementById('json-col2').appendChild(formatter2.render());

        window.store.commit({
            type: 'setCard',
            card: cardData
        })
    </script>
@endsection