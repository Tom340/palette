@extends('layout')

@section('content')
@if(count($chat_list) == 0)
            <p>チャット履歴がありませんがありません。</p>
@else
<div class="row" style="height:30px"></div>
<div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">個人間チャットルーム一覧</h1>
</div>
@foreach ($chat_list as $row)

    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-1 col-md-1 even">
        チャット相手:
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$row->name_sei}}{{$row->name_mei}}
      </div>
      <!--<div class="col-sm-1 col-md-1 even">-->
      <!--  部屋番:-->
      <!--</div>-->
      <!--<div class="col-sm-2 col-md-2 even">-->
      <!--  {{$row->talkroomid}}-->
      <!--</div>-->
      <div class="col-sm-1 col-md-1">
        @if($row->partnerid == $user_id)
        <a href="/memberChat/{{$row->userid}}" class="btn btn-primary">詳細</a>
        @else
        <a href="/memberChat/{{$row->partnerid}}" class="btn btn-primary">詳細</a>
        @endif
      </div>
    </div>


@endforeach
@endif
@endsection