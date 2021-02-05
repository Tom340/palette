@extends('layout')

@section('content')
<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">グループメンバー一覧</h1>
</div>
@if(count($groupmember) == 0)
            <p>所属団体がありません。</p>
@else
<div class="row" style="height:30px"></div>
     <div class="row mx-3">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        姓名
      </div>
      <div class="col-sm-2 col-md-2 even">
        ふりがな
      </div>
      <div class="col-sm-2 col-md-2 even">
        性別
      </div>
      <div class="col-sm-2 col-md-2 even">
        生年月日
      </div>
      <div class="col-sm-1 col-md-1 back" ></div>
    </div>
@foreach ($groupmember as $member)

     <div class="row" style="height:30px"></div>
     <div class="row border-bottom mx-3">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        {{$member->name_sei}}{{$member->name_mei}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$member->kana_sei}}{{$member->kana_mei}}
      </div>
      <div class="col-sm-2 col-md-2 even">
         @if($member->sex === 0)
          男
          @else
          女
          @endif
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$member->birthday}}
      </div>
      <div class="col-sm-1 col-md-1">
        <a href="/memberChat/{{$member->userid}}" class="btn btn-danger mb-1">チャット</a>
      </div>
      <div class="col-sm-1 col-md-1 back" ></div>
    </div>

@endforeach
@endif
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-10 col-md-10" ></div>
      <div class="col-sm-1 col-md-1"><a href="/groupMenu/{{$member->groupid}}" class="btn btn-danger">戻る</a></div>
    </div>
@endsection