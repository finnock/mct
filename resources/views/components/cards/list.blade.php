<table class="table table-striped">
    <thead>
        <tr>
            @if(isset($count))
                <th></th>
            @endif
            <th class="text-center">Rarity</th>
            <th class="text-center">Number</th>
            <th>Name</th>
            <th>Type</th>
            <th>Cost</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($cards as $card)
            <tr>
                @if(isset($count))
                    <td class="text-right" style="padding-right: 0;">
                        @include('components.cardCountStack')
                    </td>
                    <!--td>
                        <strong>{{ $card->pivot->count or '' }}</strong>
                    </td-->
                @else
                    <td>
                        <img width="50" src="{{ $card->imagePath() }}">
                    </td>
                @endif
                <td  class="align-middle text-center">
                    @include('components.raritySymbol', ['setCode' => $card->setCode, 'rarity' => $card->rarity, 'options' => 'ss-2x ss-fw ss-dark'])
                </td>
                <td  class="align-middle text-center">{{ $card->number }}</td>
                <td  class="align-middle"  class="align-middle">{{ $card->name }}</td>
                <td  class="align-middle">{{ $card->type }}</td>
                <td  class="align-middle">
                    @include('components.costSymbols', ['cost' => $card->manaCost, 'options' => 'ms-cost ms-shadow'])
                </td>
                <td  class="align-middle">
                        <a class="btn btn-sm btn-default" href="/Card/{{ $card->getAttributes()['id'] }}">
                            <i class="fa fa-folder-open"></i>&nbsp;Card
                        </a>

                        <form class="form-inline" action="{{ url('/Collection/'.$card->getAttributes()['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" value="-1" name="count">
                            <button type="submit" class="btn btn-sm btn-default" role="button">
                                <i class="fa fa-minus"></i>
                            </button>
                        </form>

                        <form class="form-inline" action="{{ url('/Collection/'.$card->getAttributes()['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" value="1" name="count">
                            <button type="submit" class="btn btn-sm btn-default" role="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </form>

                        <form class="form-inline" action="{{ url('/Collection/'.$card->getAttributes()['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm btn-danger" role="button">
                                <i class="fa fa-remove"></i>
                            </button>
                        </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>