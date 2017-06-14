@extends('layouts.row')
@section('panel-heading')
    @if($mesure->temps===1)
        Date prévue de la première séance de traitement
    @elseif($mesure->temps===2)
        Date prévue du bilan final
    @endif
@endsection
@section('body')
    <form role="form" method="POST" action="{{ url('/mesures/storedate',$mesure->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH')}}
        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
            <input id="date" type="date" class="form-control" name="date"
                   value="{{ old('date') }}" autofocus>
            @if ($errors->has('date'))
                <span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary pull-right">
            Valider
        </button>
    </form>
@endsection
@section('script')

    <script type="text/javascript">
    </script>
@endsection