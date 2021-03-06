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
            <span class="navbar-brand">Terminer le questionnaire plus tard</span>
        </div>

    </div>
</nav>

<div class="col-md-10 col-md-offset-1">
    <p>Pour terminer le questionnaire plus tard, vous n'avez qu'à cliquer ce lien :</p>
    <p><a href="{{ $link }}">{{ $link }}</a></p>
    <p>Vous ne perdrez aucune réponse. Il s'agit du même lien qui vous a été envoyé par courriel.</p>

</div>




<!-- Scripts -->
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/script.js') }}"></script>
</body>
</html>
