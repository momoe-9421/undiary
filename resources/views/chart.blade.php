@extends('layouts.app')
@section('content')
    <canvas id="myChart" width="400" height="400"></canvas>
@endsection
@section('javascript')
    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            delimiters: ['[[', ']]'],
            data: () => ({
                drawer: false,
                group: null,
            }),
            methods:{
                goChart:function(e){
                    location.href='/chart';
                },
                goHome:function(e){
                    location.href='/';
                }
            },

        })

        var data = {
            datasets: [{
                data: [{{$dossari}}, {{$geri}}, {{$benpi}},{{$sukoshi}},{{$seiri}}],
                backgroundColor: [
                    "#BB5179",
                    "#FAFF67",
                    "#58A27C",
                    "#3c00ff",
                    "#bb20de",
                ]
            }],
            // これらのラベルは凡例とツールチップに表示されます。
            labels: [
                'どっさり',
                '下痢',
                '便秘',
                '少し',
                '生理'
            ]
        };
        var ctx = document.getElementById("myChart");
        var myPieChart = new Chart(ctx,{
            type: 'pie',
            data: data,

        });


    </script>
@endsection
