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
            <span class="navbar-brand">Liste des ressources</span>
        </div>

    </div>
</nav>

<div class="col-md-10 col-md-offset-1">
    @if($rep == 'EN')
        <p>Il se peut que certaines questions vous fassent vivre un malaise, un inconfort ou suscitent une réflexion de votre part.</p>
        <p>Nous vous invitons à partager ces émotions avec une personne de confiance, dont :</p>
        <ul>
        <li>Un membre de votre entourage (conjoint, collègue, ami)</li>
        <li>Un professionnel d’écoute et de soutien de votre milieu de travail (p.ex. psychologue de l’école, travailleur social, psychoéducateur)</li>
        <li>Un professionnel d’écoute et de soutien du CLSC de votre région (Sherbrooke : 819-563-0144)</li>
        <li>Un professionnel d’écoute et de soutien d’une ligne téléphonique (Tel-Aide Québec 1-877-700-2433).</li>
        <li>Pour une aide à plus long terme, vous pouvez consulter le programme d’aide aux employés de votre commission scolaire (CSRS 819-822-5540).</li>
    </ul>
        <p>Pour une aide à plus long terme, vous pouvez consulter le programme d’aide aux employés de votre commission scolaire (CSRS 819-822-5540).</p>
    @elseif($rep == 'PA')
        <p>Il se peut que certaines questions vous fassent vivre un malaise, un inconfort ou suscitent une réflexion de votre part.</p>
        <p>Nous vous invitons à partager ces émotions avec une personne de confiance, dont :</p>

        <ul>
            <li>Un membre de votre entourage (conjoint, collègue, ami)</li>
            <li>Un professionnel du module CALME</li>
            <li>Un professionnel d’écoute et de soutien de votre milieu de travail (p.ex. psychologue, employé des ressources humaines)</li>
            <li>Un professionnel d’écoute et de soutien du CLSC de votre région (Sherbrooke : 819-563-0144)</li>
            <li>Un professionnel d’écoute et de soutien d’une ligne téléphonique (Tel-Aide Québec 1-877-700-2433).</li>
        </ul>
    @elseif($rep == 'JE')
        <p>
            Il se peut que certaines questions te mettent mal à l’aise, inconfortable ou te portent à réfléchir plus qu’à l’habitude.
        </p>
        <p>
            N'hésite pas à parler des émotions ou des inquiétudes que cela te fait vivre avec une personne de confiance, comme par exemple :
        </p>

        <ul>
            <li>Personne de ton entourage (tes parents, ton frère, ta sœur, un ami)</li>
            <li>Un intervenant du module CALME</li>
            <li>Un intervenant de ton école (p.ex. psychologue de l’école, travailleur social, psychoéducateur)</li>
            <li>La ligne téléphonique Tel-Jeunes (24 heures par jour, 7 jours par semaine, 1-800-263-2266).</li>
        </ul>
    @endif

    <a href="{{ $link }}" class="btn btn-primary">Reprendre le questionnaire</a>

</div>




<!-- Scripts -->
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/script.js') }}"></script>
</body>
</html>
