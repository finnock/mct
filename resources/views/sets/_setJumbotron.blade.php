<div class="row mt-2">
    <div class="col-lg-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-12">
                    <h1 style="display: inline;" class="mtg-font">{{ $set->name }}</h1>
                    <div class="pull-right">
                        @include('components.raritySymbol', ['setCode' => $set->code, 'rarity' => 'white', 'options' => 'ss-10x'])
                    </div>
                </div>
            </div>
            <div class="row" style="font-size: 1.3em;">
                <div class="col-sm-4">
                    <b>Release Date:</b> <i>{{ $set->releaseDate }}</i>
                </div>
                <div class="col-sm-4">
                    <b>Block:</b> <i>{{ $set->block }}</i>
                </div>
                <div class="col-sm-4">
                    <b>Type:</b> <i>{{ $set->type }}</i>
                </div>
            </div>
        </div>
    </div>
</div>