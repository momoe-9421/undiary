@extends('layouts.app')
@section('content')
aboutページです。
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
            type: 'month',
            mode: 'stack',
            weekday: [0, 1, 2, 3, 4, 5, 6],
            value: '',
            event: {
                '2021-05-30':"{{asset('/img/下痢.jpg')}}",
            },
        }),
    })
</script>
@endsection
