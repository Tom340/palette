@extends('layout')

@section('content')

@if (session('message'))
   <div class="alert alert-primary">
     {{ session('message') }}
   </div>
@endif
<div class="row" style="height:30px"></div>
<div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">個人間チャットルーム</h1>
</div>
<div class="row" style="height:30px"></div>
<div class="row">
    <div class="col-sm-1 col-md-1 even"></div>
    <div class="col-sm-3 col-md-3 even border">
    <h5>チャットメンバー</h5>
    <div>・あなた</div>
    @foreach ($partner as $user)
      <div>・{{$user->name_sei}}{{$user->name_mei}}</div>
    @endforeach
    </div>
    <div class="col-sm-6 col-md-6 even">
        <div class="col-sm-12 col-md-12 border">
            <h5>受信済チャットメッセージ</h5>
            <div id="chat"></div>
            @if(count($member_chat) == 0)
            <p>投稿内容がありません。</p>
            @else
            @foreach ($member_chat as $row)
               <div class="row">
                   <div class="col-sm-2 col-md-2">
                       @if($row->posterid == $user_id)
                       あなた:
                       @else
                        @foreach ($partner as $user)
                        {{$user->name_sei}}{{$user->name_mei}}:
                        @endforeach
                       @endif
                   </div>
                   <div class="col-sm-10 col-md-10">
                       {{$row->chat}}
                   </div>
               </div>
               <div class="border-bottom border-primary">
               投稿日時：{{$row->created_at}}
               </div>
            @endforeach
            @endif
        </div>
        <div class="row" style="height:30px"></div>
        <form action="/memberChat" method="POST" onsubmit="return jumpCheck();">
                {{ csrf_field() }} 
        <div class="row">
            <div class="col-sm-10 col-md-10">
                <input type="text" name="chat" style="width: 100%;" value="{{old('group_chat')}}" placeholder="チャット内容を入力">
                <input type="hidden" name="partnerid" value="{{$id}}">
                <input type="hidden" name="userid" value="{{$user_id}}">
            </div>
            <div class="col-sm-2 col-md-2">
               <input class="btn btn-primary" type="submit" name="search" id="search" value="送信">
            </div>
        </div>
        </form>
    </div>
    
</div>



@endsection