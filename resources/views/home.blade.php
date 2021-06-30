@extends('layouts.app')
@section('content')
<v-sheet
    tile
    height="54"
    class="d-flex"
>
    <v-btn
        icon
        class="ma-2"
        @click="$refs.calendar.prev()"
    >
        <v-icon>mdi-chevron-left</v-icon>
    </v-btn>
    <v-spacer></v-spacer>
    <h4>[[title]]</h4>
    <v-spacer></v-spacer>
    <v-btn
        icon
        class="ma-2"
        @click="$refs.calendar.next()"
    >
        <v-icon>mdi-chevron-right</v-icon>
    </v-btn>
</v-sheet>
<v-sheet height="600">
    <v-calendar
        ref="calendar"
        v-model="value"
        :weekdays="weekday"
        :type="type"
        locale="ja-jp"
        :day-format="timestamp => new Date(timestamp.date).getDate()"
        :month-format="timestamp => (new Date(timestamp.date).getMonth() + 1) + ' /'"
        @click:date="clickEvent"
    >
        <template v-slot:day="{date}">
            <div v-if="event[date]" class="text-center">
                <img class="mx-auto" style="height:50px" :src="'/img/'+event[date][0]['status']+'.jpg'">
            </div>
        </template>
    </v-calendar>
</v-sheet>

<!-- Modal -->
<div class="modal fade" id="homeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="head"></h5>
                    <input type="hidden" id="date" name="date" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h3>過去の記録</h3>
                        <table id="record">

                        </table>
                    </div>
                    <div class="container">
                        <h3>記録する</h3>
                        <label class="form-time-label">時間</label>
                        <input required class="form-time-input" type="time" id="time"  name="time" value="">
                    </div>
                    <div class="container">
                        <p>活動量</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="momentum" id="takusan" value="たくさん" checked>
                            <label class="form-check-label" for="takusan">たくさん</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="momentum" id="hutsu" value="普通" checked>
                            <label class="form-check-label" for="hutsu">普通</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="momentum" id="sukunai" value="少ない" checked>
                            <label class="form-check-label" for="sukunai">少ない</label>
                        </div>
                    </div>
                    <div class="container">
                        <p>色</p>
                        <div class="form-check">
                            <input class="form-color-input" type="color" name="color" id="color" value="#CD853F">
                            <label class="form-color-input" for="color">うんちの色</label>
                        </div>
                    </div>
                    <div class="container">
                        <p>うんちの状態</p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="dossari" value="どっさり" checked>
                                    <label class="form-check-label" for="dossari">
                                        <img style="height:200px;width:200px" src="{{asset('/img/どっさり.jpg')}}">
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="geri" value="下痢">
                                    <label class="form-check-label" for="geri">
                                        <img style="height:200px;width:200px" src="{{asset('/img/下痢.jpg')}}">
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="benpi" value="便秘">
                                    <label class="form-check-label" for="benpi">
                                        <img style="height:200px;width:200px" src="{{asset('/img/便秘.jpg')}}">
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="sukoshi" value="少し">
                                    <label class="form-check-label" for="sukoshi">
                                        <img style="height:300px;width:200px" src="{{asset('/img/少し.jpg')}}">
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="seiri" value="生理">
                                    <label class="form-check-label" for="seiri">
                                        <img style="height:300px;width:200px" src="{{asset('/img/生理.jpg')}}">
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="kaiben" value="快便">
                                    <label class="form-check-label" for="kaiben">
                                        <img style="height:200px;width:200px" src="{{asset('/img/快便.jpg')}}">
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary dark" data-dismiss="modal">閉じる</button>
                    <input type="submit" class="btn" style="background-color:#EEE000" value="体調を記録">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" id="modalButton" data-toggle="modal" data-target="#homeModal"></button>
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
            value: moment().format('YYYY-MM-DD'),
            event:{
                @foreach($events as $day=>$event)
                "{{$day}}":[
                        @foreach($event as $item)
                    {"status":"{{$item['status']}}",
                        "time":"{{$item['time']}}",
                        "color":"{{$item['color']}}"
                    },
                    @endforeach
                ],
                @endforeach
            },
        }),
        methods:{
            clickEvent:function(e){
                $("#time").val(( '00' +(new Date().getUTCHours()+9)).slice( -2 )+':'+( '00' +new Date().getUTCMinutes()).slice( -2 ));
                $("#head").text(e.date);
                $("#date").val(e.date);
                $("#record").empty();
                if (this.event[e.date]){
                    this.event[e.date].forEach(function(data){
                        $("#record").append("<tr><td>"+data["time"]+"</td><td>"+data["status"]+"</td><td>"
                        +'<input class="form-color-input" type="color" name="color" id="color" value="'+data["color"]+'">'+"</td></tr>")
                    });
                }
                $("#modalButton").click();
            },
            goChart:function(e){
                location.href='/chart';
            },
            goHome:function(e){
                location.href='/';
            }
        },
        computed: {
               title() {
             return moment(this.value).format('YYYY年 M月');  // 表示用文字列を返す
           }
      },
    })
</script>
@endsection
