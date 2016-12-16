@extends('layouts.row')
@section('panel-heading')
    <h1>Tableau de bord</h1>
@endsection
@section('body')
    <div class="col-md-6">
        <p>N = {{$dossiers}}</p>
        <p>Âge moyen à la première séance : {{$ageMoyen}}</p>
    </div>
    <div class="col-md-6">
        <canvas id="myChart" width="150" height="150"></canvas>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        var ctx = document.getElementById("myChart");
        var data = {
            labels: [
                "Filles",
                "Garçons",
            ],
            datasets: [
                {
                    data: [{{$filles}}, {{$garcons}}],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                    ],
                    hoverBackgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                    ]
                }]
        };
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            /*options: options*/
        });
    </script>
@endsection