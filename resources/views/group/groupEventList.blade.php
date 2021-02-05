@extends('layout')

@section('content')
<div class="row" style="height:30px"></div>
<div class="row">
  <div class="col-sm-1 col-md-1"></div>
  <h1 class="h3">グループイベント一覧</h1>
</div>
<div class="row" style="height:30px"></div>
@if(count($events) == 0)
            <p>登録イベントがありません。</p>
@else
@foreach ($groups as $group)
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        グループ名:{{$group->group_name}}
      </div>
    </div>
@endforeach
@foreach ($events as $event)
    
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント名:
        {{$event->event_name}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        活動内容:{{$event->overview}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        ジャンル：{{$event->genre}}/<?php if(!empty($event['sub_genre'])) echo $event['sub_genre']; ?>
      </div>
      <div class="col-sm-2 col-md-2 even">
        開催日:{{$event->eventdate_st}}
      </div>
      <div class="col-sm-1 col-md-1">
        
      </div>
      <div class="col-sm-1 col-md-1">
        <a href="/groupEventMenu/{{$event->id}}" class="btn btn-primary">詳細</a>
      </div>
    </div>


@endforeach
@endif
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-10 col-md-10" ></div>
      <div class="col-sm-1 col-md-1"><a href="/groupMenu/{{$id}}" class="btn btn-danger">戻る</a></div>
    </div>
@endsection