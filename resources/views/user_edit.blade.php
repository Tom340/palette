@extends('layout')

@section('content')

<script>
    function jumpCheck(){
      ret = confirm("プロフィールを更新します。よろしいですか？");
      if (ret == true){
      return true;
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
        
<div class="row" style="height:30px"></div>
<div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">プロフィール編集</h1>
</div>
<div class="row" style="height:30px"></div>
@foreach ($user as $row)
<form action="/user_edit" method="POST" enctype="multipart/form-data" onsubmit="return jumpCheck();">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2">
        名前(ふりがな)
      </div>
      <div class="col-sm-1 col-md-1">
        (せい)
      </div>
      <div class="col-sm-2 col-md-2">
        <input type="text" name="kana_sei" class="box" style="width: 80%;" value="{{$row->kana_sei}}">
      </div>
      <div class="col-sm-1 col-md-1">
        (めい)
      </div>
      <div class="col-sm-2 col-md-2">
        <input type="text" name="kana_mei" class="box" style="width: 80%;" value="{{$row->kana_mei}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">
        名前
      </div>
      <div class="col-sm-1 col-md-1">
        (姓)
      </div>
      <div class="col-sm-2 col-md-2">
        <input type="text" name="name_sei" class="box" style="width: 80%;" value="{{$row->name_sei}}">
      </div>
      <div class="col-sm-1 col-md-1">
        (名)
      </div>
      <div class="col-sm-2 col-md-2">
        <input type="text" name="name_mei" class="box" style="width: 80%;" value="{{$row->name_mei}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">
        携帯電話番号
      </div>
      <div class="col-sm-4 col-md-4">
          <input type="text" name="cellular" class="box" style="width: 100%;" value="{{$row->cellular}}">
      </div>
      <div class="col-sm-2 col-md-2">
        ハイフンなし
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">
        メールアドレス
      </div>
      <div class="col-sm-6 col-md-6">
          <input type="text" name="email" class="box" style="width: 100%;" value="{{$row->email}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
     
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">
        プロフィール画像
      </div>
      <div class="col-sm-3 col-md-3">
        <?php
          if ($base64) {
        ?>
          <img src="data:{{$mimetype}};base64, {{$base64}}" class="w-75">
        <?php
          } else {
        ?>
          <img src="images/person.png" width="97px" height="118px" alt="" class="box">
        <?php
          }
        ?>
      </div>
      <div class="col-sm-2 col-md-2">
          <input type="file" name="profile" style="width: 100%;" value="{{old('profile')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">
        性別
      </div>
      <div class="col-sm-1 col-md-1">
          <label><input type="radio" name="sex" value="0" <?php if($row['sex']==0) echo "checked"; ?>>男性</label>
      </div>
      <div class="col-sm-1 col-md-1">
          <label><input type="radio" name="sex" value="1" <?php if($row['sex']==1) echo "checked"; ?>>女性</label>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">
        生年月日
      </div>
      <div class="col-sm-1 col-md-1">
        <select name="birthday_year">
          <option value="{{old('birthday_year')}}">選択</option>
          <script>
            let today = new Date();
            let year = <?php if (!empty(date('Y', strtotime($row['birthday'])))) echo date('Y', strtotime($row['birthday'])); else echo "0";?>;
            for (let i = 120; i >= 0; i--) {
              let tmp = today.getFullYear()-i;
              if(tmp == year){
                document.write("<option value='",tmp,"' selected>",tmp,"</option>");
              } else {
              document.write("<option value='",tmp,"'>",tmp,"</option>");
            }
            }
          </script>
        </select>年
      </div>
      <div class="col-sm-1 col-md-1">
        <select name="birthday_month">
          <option value="{{old('birthday_month')}}">選択</option>
          <script>
            let month = <?php if (!empty(date('n', strtotime($row['birthday'])))) echo date('n', strtotime($row['birthday'])); else echo "0";?>;
            for (let i = 1; i <= 12; i++) {
              if(i == month){
              document.write("<option value='",i,"' selected>",i,"</option>");
            } else {
            document.write("<option value='",i,"'>",i,"</option>");
            }
            }
          </script>
        </select>月
      </div>
      <div class="col-sm-1 col-md-1">
        <select name="birthday_day">
          <option value="{{old('birthday_day')}}">選択</option>
          <script>
            let day = <?php if (!empty(date('j', strtotime($row['birthday'])))) echo date('j', strtotime($row['birthday'])); else echo "0";?>;
            for (let i = 1; i <= 31; i++) {
              if(i == day){
              document.write("<option value='",i,"'selected>",i,"</option>");
            } else {
            document.write("<option value='",i,"'>",i,"</option>");
            }
            }
          </script>
        </select>日
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-2 col-md-8"></div>
      <div class="col-sm-3 col-md-2"><input class="btn btn-primary" type="submit" name="confirm" id="confirm" value="更新"></div>
      <div class="col-sm-3 col-md-2"><a href="mypage" class="btn btn-danger">戻る</a></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endforeach
@endsection
