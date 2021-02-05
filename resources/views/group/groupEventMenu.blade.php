@extends('group.layout')

@section('content')

@if (session('message'))
    <div class="alert alert-primary">
        {{ session('message') }}
    </div>
@endif

@foreach($events as $event)
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        基本情報
      </div>
    </div>

<div class="border">
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント名
      </div>
      <div class="col-sm-6 col-md-6 even">
        {{$event->event_name}}
        <!--<input type="text" name="event_name" class="box" style="width: 80%;" value="{{old('event_name')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        概要
      </div>
      <div class="col-sm-6 col-md-6 even">
        {{$event->overview}}
        <!--<input type="text" name="overview" class="box" style="width: 80%;" value="{{old('overview')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!-------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        ジャンル
      </div>
      <div class="col-sm-6 col-md-6 even">
        {{$event->genre}}
        <!--<input type="text" name="genre" class="box" style="width: 80%;" value="{{old('genre')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!-------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        
      </div>
      <div class="col-sm-6 col-md-6 even">
        {{$event->sub_genre}}
        <!--<input type="text" name="sub_genre" class="box" style="width: 80%;" value="{{old('sub_genre')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!--------------------------------------------------->
     <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        イベント形態 
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->event_form}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        料金制度
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$event->paid}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        開催日時
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->eventdate_st}}
        <!--<input type="text" name="eventdate_st" class="box" id="datepicker" style="width: 80%;" value="{{old('eventdate_st')}}" placeholder="開催開始日を選択して下さい">-->
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->eventtime_st}}時
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even"></div>
    <div class="col-sm-2 col-md-2 even">から</div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->eventdate_ed}}
        <!--<input type="text" name="eventdate_ed" class="box" id="datepicker2" style="width: 80%;" value="{{old('eventdate_ed')}}" placeholder="開催終了日を選択して下さい">-->
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->eventtime_ed}}時
        <!--<input type="text" name="eventtime_ed" class="box" style="width: 80%;" value="{{old('eventtime_ed')}}">時-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>    
<!-------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        定員
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->capacity}}人
      </div>
      <div class="col-sm-2 col-md-2 even">
        現在参加数
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$member_num}}人
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <!----------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        募集期間
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->recruitdate_st}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$event->recruittime_st}}時
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even"></div>
    <div class="col-sm-2 col-md-2 even">から</div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
      </div>
      <div class="col-sm-2 col-md-2 even">
         {{$event->recruitdate_ed}}
      </div>
      <div class="col-sm-2 col-md-2 even">
          {{$event->recruittime_ed}}時
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div> 
    <div class="row" style="height:30px"></div>
</div><!---------ここまで基本情報----------------------->

    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント内容
      </div>
    </div>
<div class="border">
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        イベント画像
      </div>
      <div class="col-sm-4 col-md-4 odd">
       <?php
          if ($base64) {
        ?>
          <img src="data:{{$mimetype}};base64, {{$base64}}" class="w-75">
        <?php
          } else {
        ?>
          <img src="../images/person.png" width="97px" height="118px" alt="" class="box">
        <?php
          }          
        ?>
      </div>
      <div class="col-sm-2 col-md-2 odd">
          <!--<input type="file" name="event_img" style="width: 100%;" value="{{old('event_img')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------------>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント案内文
      </div>
      <div class="col-sm-6 col-md-6 even">
         {{$event->event_info}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
</div><!---------ここまでイベント内容------------------->
    
     <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        開催場所
      </div>
    </div>
<div class="border">
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        会場名
      </div>
      <div class="col-sm-6 col-md-6 even">
         {{$event->place_name}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        会場のURL
      </div>
      <div class="col-sm-6 col-md-6 even">
         {{$event->place_url}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        国
      </div>
      <div class="col-sm-2 col-md-2 even">
         {{$event->country}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        都道府県
      </div>
      <div class="col-sm-1 col-md-1 even">
         {{$event->pref}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        市区町村・番地
      </div>
      <div class="col-sm-6 col-md-6 even">
         {{$event->city}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        ビル名・階数
      </div>
      <div class="col-sm-6 col-md-6 even">
         {{$event->building}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
</div><!-----------ここまで会場----------->


    <br>
    <div class="row">
      <div class="col-sm-4 col-md-4"></div>
      <div class="col-sm-2 col-md-2">
      @if(count($check) == 0)
       <form action="/groupEventDetails" method="POST" onsubmit="return jumpCheck();">
          {{ csrf_field() }}
          <input type="hidden" name="eventid" value="{{$event->id}}">
          <input type="hidden" name="groupid" value="{{$event->groupid}}">
          <input type="hidden" name="userid" value="{{$user_id}}">
          <input class="btn btn-primary" type="submit" name="send" id="send" value="参加申請">
        </form>
      @else
        <div class="alert alert-primary">参加申請済の団体です</div>
      @endif
      </div>
      <div class="col-sm-4 col-md-4">
     
        <a href="/groupEventEdit/{{$event->id}}" class="btn btn-primary">イベント内容編集</a>
        <a href="/eventMemberEdit/{{$event->id}}" class="btn btn-primary">イベントメンバー編集</a>
        
        <a href="/groupEventList/{{$event->groupid}}" class="btn btn-primary">戻る</a>
      </div>
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>

@endforeach
@endsection