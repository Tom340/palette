@extends('layout')

@section('content')
<script>
　var remove = 0;

  function radioDeselection(already, numeric) {
    if(remove == numeric) {
      already.checked = false;
      remove = 0;
    } else {
      remove = numeric;
    }
  }
  
    function jumpCheck(){
      return confirm("イベントメンバー内容を更新します。よろしいですか？");
    }
    
    function addmember(group_id){
      var mail = prompt('メールアドレスを入力して下さい。');
      if (mail) {
        location.href = "/eventMemberAdd?mail="+mail+"&eventid="+event_id;
        // var ajax = new XMLHttpRequest();
        // ajax.open("get", "groupMemberAdd/"+mail+"/"+group_id);
        // // データをリクエスト ボディに含めて送信する
        // ajax.responseType = "json";
        // ajax.addEventListener("load", function(){ // loadイベントを登録します。
        //   location.href = "/groupMemberEdit/" + group_id;
        // });
      }
    }
</script>
{{-- エラー表示 --}}
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session('message'))
   <div class="alert alert-primary">
     {{ session('message') }}
   </div>
@endif
<div class="row" style="height:30px"></div>
<div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">イベントメンバー編集</h1>
</div>
<div class="row" style="height:30px"></div>
<div class="row">
  <div class="col-sm-1 col-md-1 even"></div>
    @foreach ($events as $event)
    <div class="col-sm-3 col-md-3 even">
        イベント名称:{{$event->event_name}}
    </div>
    <div class="col-sm-5 col-md-5 even">
        予定定員:{{$event->capacity}}人
    </div>
    @endforeach
    <div class="col-sm-2 col-md-2"><button onclick="addmember({{$id}})" class="contact-show btn btn-danger">メンバー追加</button></div>
</div>
<div class="row">
  <div class="col-sm-1 col-md-1 even"></div>
  <div class="col-sm-5 col-md-5 even">
    <form action="/eventMemberEdit" method="POST" onsubmit="return jumpCheck();">
        {{ csrf_field() }}
      <table border='1' width="100%">
        <tr  class="border">
          <th class="text-dark bg-white text-center">メンバー名</th>
          <th class="border bg-white text-center">性別</th>
          <th class="border bg-white text-center">生年月日</th>
          <th class="border text-center">参加承認</th>
          <th class="border text-center">管理権限</th>
        </tr>
        @foreach ($members as $member)
        <tr class="border">
          <th class="text-dark bg-white text-center pt-3">{{$member->user_sei}}{{$member->user_mei}}</th>
          <th class="border bg-white text-center w-20"><?php if($member['sex']==0){ echo "男"; }else{ echo "女";}?></th>
          <th class="border bg-white text-center w-20">{{$member->user_birthday}}</th>
          <input type="hidden" name="entry_status[{{$member->id}}]" value="0">
          <th class="border text-center w-20"><input type="checkbox" name="entry_status[{{$member->id}}]" value="1" <?php if ($member['entry_status'] == 1) echo "checked";?>></th>
          <input type="hidden" name="representative_status[{{$member->id}}]" value="0">
          <th class="border text-center w-20"><input type="checkbox" name="representative_status[{{$member->id}}]" value="1" <?php if ($member['representative_status'] == 1) echo "checked";?>></th>
          
          <input type="hidden" name="userid[{{$member->id}}]" value='{{$member->userid}}'/>
          <input type="hidden" name="id[]" value='{{$member->id}}'/>
        </tr>
        @endforeach
      </table>
      <div class="row" style="height:30px"></div>
      <div class="row">
        <div class="col-sm-2 col-md-2">
          <input type="hidden" name="eventid" value='{{$id}}'/>
          <input type="submit" name="updated" value="確認" class="btn btn-primary">
        </div>
        <div class="col-sm-2 col-md-2"><a href="/groupEventMenu/{{$id}}" class="btn btn-danger">戻る</a></div>
      </div>
    </form>
  </div>
</div>




@endsection