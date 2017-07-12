<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projet Calme</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Projet Calme</title>

    <!-- Styles -->
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <link href="{{url('/css/vendor.css')}}" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>


</head>
<body class="ls-branding">
<nav class="navbar navbar-default navbar-static-top ls-navbar">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">Questionnaire terminé</span>
        </div>

    </div>
</nav>

<div class="col-md-10 col-md-offset-1">
    <p>Vous avez terminé de remplir le questionnaire.</p>
    <p>Vous recevrez une compensation symbolique pour votre participation à ce projet de recherche.</p>
    <p>Un chèque cadeau d’un montant de 10$, échangeable chez un détaillant de la région de l’Estrie, fournissant des denrées alimentaires ou de l’essence, vous sera remis à chacune des périodes (maximum 2) où vous aurez rempli les questionnaires associés à votre participation.</p>
    <br>
    <p>Afin de vous acheminer votre chèque-cadeau par la poste, veuillez incrire ici vos coordonnées postales.</p>
    <form role="form" method="POST" action="{{ url('coordo-enseignant', $adresse->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group{{ $errors->has('no_civique') ? ' has-error' : '' }}">
            <label for="no_civique" class=" control-label">Numéro civique</label>
            <input id="no_civique" type="text" class="form-control" name="no_civique" value="{{ old('no_civique', $adresse->no_civique) }}">
            @if ($errors->has('no_civique'))
                <span class="help-block">
        		    <strong>{{ $errors->first('no_civique') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('rue') ? ' has-error' : '' }}">
            <label for="rue" class=" control-label">Rue</label>
            <input id="rue" type="text" class="form-control" name="rue" value="{{ old('rue', $adresse->rue) }}">
            @if ($errors->has('rue'))
                <span class="help-block">
        		    <strong>{{ $errors->first('rue') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}">
            <label for="cp" class=" control-label">Code postal</label>
            <input id="cp" type="text" class="form-control" name="cp" value="{{ old('cp', $adresse->cp) }}">
            @if ($errors->has('cp'))
                <span class="help-block">
        		    <strong>{{ $errors->first('cp') }}</strong>
        		</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
            <label for="ville" class=" control-label">Ville</label>
            <input id="ville" type="text" class="form-control" name="ville" value="{{ old('ville', $adresse->ville) }}">
            @if ($errors->has('ville'))
                <span class="help-block">
        		    <strong>{{ $errors->first('ville') }}</strong>
        		</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary pull-right">
            Sauvegarder
        </button>
    </form>
</div>




<!-- Scripts -->
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/script.js') }}"></script>
</body>
</html>
