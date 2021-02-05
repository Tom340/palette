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
  <h1 class="h3">グループチャット</h1>
</div>
<div class="row" style="height:30px"></div>
<div class="row">
    <div class="col-sm-1 col-md-1 even"></div>
    <div class="col-sm-3 col-md-3 even border">
    @foreach ($groups as $group)
        <h4 class="h4">団体名称:{{$group->group_name}}</h4>
    @endforeach
    <h5 class="h5 mt-3">団体メンバー</h5>
    @foreach ($members as $member)
      <div>・{{$member->user_sei}}{{$member->user_mei}}</div>
    @endforeach
    </div>
    <div class="col-sm-7 col-md-7 even">
        <div class="col-sm-12 col-md-12 border" id="chat">
        </div>
        <div class="row" style="height:30px"></div>
        <form action="/groupChat" method="POST" onsubmit="return jumpCheck();">
                {{ csrf_field() }} 
        <div class="row">
            <div class="col-sm-10 col-md-10">
                <input type="text" name="chat" style="width: 100%;" value="{{old('group_chat')}}" placeholder="チャット内容を入力">
                <input type="hidden" name="groupid" value="{{$id}}">
                <input type="hidden" name="userid" value="{{$user_id}}">
            </div>
            <div class="col-sm-1 col-md-1">
               <input class="btn btn-primary" type="submit" name="search" id="search" value="送信">
            </div>
            <div class="col-sm-1 col-md-1"><a href="/groupMenu/{{$id}}" class="btn btn-danger">戻る</a></div>
        </div>
        </form>
    </div>
    
</div>


<script>
function showMessage(json) {
    var msg = document.getElementById("chat");
    msg.innerHTML = '<h5 class="h5">受信済チャットメッセージ</h5>';
    if (json.length==0) {
        msg.innerHTML += '<p>投稿内容がありません。</p>';
    } else {
        for(var i = 0; i < json.length; i++) {
            msg.innerHTML += '<div class="row border mx-1 mb-1">';
            msg.innerHTML += '<div class="col-sm-2 col-md-2">';
            msg.innerHTML += json[i].user_sei + json[i].user_mei;
            msg.innerHTML += '</div>';
            msg.innerHTML += '<div class="col-sm-10 col-md-10">';
            msg.innerHTML += json[i].chat;
            msg.innerHTML += '</div>';
            msg.innerHTML += '</div>';
            msg.innerHTML += '<div class="border-bottom border-primary">';
            msg.innerHTML += '投稿日時：' + json[i].created_at;
            msg.innerHTML += '</div>';
        }
    }
}

function recvAJAX() {
    fetch("/groupChatMessage?id={{$id}}", {
        method: "GET",
    }).then(response => response.json())
        .then(data  => {showMessage(data);}
    );    
}
setInterval(recvAJAX, 200);
</script>
@endsection