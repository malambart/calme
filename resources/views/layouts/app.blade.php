<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<body>
@include('layouts/menu')
@yield('content')

<!-- Scripts -->
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/script.js') }}"></script>
@yield('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#app").css("visibility", "visible");
    });
</script>
</body>
</html>
