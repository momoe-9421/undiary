@extends('layouts.app')
@section('content')
    <canvas id="myChart" width="400" height="400"></canvas>
@endsection
@section('javascript')
    <script>
        var ctx = document.getElementById("myChart");
        var myPieChart = new Chart(ctx,{
            type: 'pie',
            data: data,
            options: options
        });
    </script>
@endsection
