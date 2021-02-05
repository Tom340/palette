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
      return confirm("メンバー内容を更新します。よろしいですか？");
    }
    
    function addmember(group_id){
      var mail = prompt('メールアドレスを入力して下さい。');
      if (mail) {
        location.href = "/groupMemberAdd?mail="+mail+"&group="+group_id;
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
  <h1 class="h3">メンバー編集</h1>
</div>
<div class="row">
  <div class="col-sm-1 col-md-1"></div>
  *メンバー追加ボタンでメールアドレスを入力で直接グループメンバーに招待できます（サービス登録ユーザーに限る）
</div>
<div class="row" style="height:30px"></div>
<div class="row">
  <div class="col-sm-1 col-md-1 even"></div>
    @foreach ($groups as $group)
    <div class="col-sm-8 col-md-8 even">
        団体名称:{{$group->group_name}}
    </div>
    @endforeach
    <div class="col-sm-2 col-md-2"><button onclick="addmember({{$id}})" class="contact-show btn btn-danger">メンバー追加</button></div>
</div>
<div class="row">
  <div class="col-sm-1 col-md-1 even"></div>
  <div class="col-sm-5 col-md-5 even">
    <form action="/groupMemberEdit" method="POST" onsubmit="return jumpCheck();">
        {{ csrf_field() }}
      <table border='1' width="150%">
        <tr class="border">
          <th class="text-dark bg-white text-center">メンバー名</th>
          <th class="border text-center">代表</th>
          <th class="border text-center">参加承認</th>
          <th class="border text-center">プロフ閲覧</th>
        </tr>
        @foreach ($members as $member)
        <tr class="border">
          <th class="text-dark bg-white text-center pt-3">{{$member->user_sei}}{{$member->user_mei}}</th>
          <input type="hidden" name="representative_status[{{$member->id}}]" value="0">
          <th class="border text-center w-25"><input type="checkbox" name="representative_status[{{$member->id}}]" value="1" <?php if ($member['representative_status'] == 1) echo "checked";?> ></th>
          <input type="hidden" name="entry_status[{{$member->id}}]" value="0">
          <th class="border text-center w-20"><input type="checkbox" name="entry_status[{{$member->id}}]" value="1" <?php if ($member['entry_status'] == 1) echo "checked";?>></th>
          <input type="hidden" name="reading_status[{{$member->id}}]" value="0">
          <th class="border text-center w-20"><input type="checkbox" name="reading_status[{{$member->id}}]" value="1" <?php if ($member['reading_status'] == 1) echo "checked";?> ></th>
          <input type="hidden" name="userid[{{$member->id}}]" value='{{$member->userid}}'/>
          <input type="hidden" name="id[]" value='{{$member->id}}'/>
        </tr>
        @endforeach
      </table>
      <div class="row" style="height:30px"></div>
      <div class="row">
        <div class="col-sm-2 col-md-2">
          <input type="hidden" name="groupid" value='{{$id}}'/>
          <input type="submit" name="updated" value="確認" class="btn btn-primary">
        </div>
        <div class="col-sm-2 col-md-2"><a href="/groupMenu/{{$id}}" class="btn btn-danger">戻る</a></div>
      </div>
    </form>
  </div>
</div>




@endsection