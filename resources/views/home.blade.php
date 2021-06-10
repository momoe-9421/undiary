@extends('layouts.app')
@section('content')
<v-sheet height="600">
    <v-calendar
        ref="calendar"
        v-model="value"
        :weekdays="weekday"
        :type="type"
    >
        <template v-slot:day="{date}">

            <div v-if="event[date]" class="text-center">
                <img class="mx-auto" style="width:50px;height:50px" :src="event[date]">
            </div>
        </template>
    </v-calendar>
</v-sheet>
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
