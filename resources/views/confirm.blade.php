@extends('layout')

@section('content')

<form action="/complete" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        名前(ふりがな)
      </div>
      <div class="col-sm-1 col-md-1 even">
        (せい)
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$request->kana_sei}}
        <input type="hidden" name="kana_sei" value="{{$request->kana_sei}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        (めい)
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$request->kana_mei}}
        <input type="hidden" name="kana_mei" value="{{$request->kana_mei}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        名前
      </div>
      <div class="col-sm-1 col-md-1 even">
        (姓)
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$request->name_sei}}
        <input type="hidden" name="name_sei" value="{{$request->name_sei}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        (名)
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$request->name_mei}}
        <input type="hidden" name="name_mei" value="{{$request->name_mei}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        携帯電話番号
      </div>
      <div class="col-sm-4 col-md-4 odd">
          {{$request->cellular}}
          <input type="hidden" name="cellular" value="{{$request->cellular}}">
      </div>
     
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        メールアドレス
      </div>
      <div class="col-sm-6 col-md-6 odd">
          {{$request->email}}
          <input type="hidden" name="email" value="{{$request->email}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        パスワード
      </div>
      <div class="col-sm-6 col-md-6 odd">
          {{$request->password}}
          <input type="hidden" name="password" value="{{$request->password}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        プロフィール画像
      </div>
     
      <div class="col-sm-2 col-md-2 odd">
        <?php
          if ($base64) {
        ?>
          <img src="data:{{$mimetype}};base64, {{$base64}}">
        <?php
          } else {
        ?>
          <img src="images/person.png" width="97px" height="118px" alt="" class="box">
        <?php
          }          
        ?>
          <input type="hidden" name="profile" style="width: 100%;" value="{{$imageName}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        性別
      </div>
      <div class="col-sm-1 col-md-1 even">
          @if($request->sex === '0')
          男
          @else
          女
          @endif
          <input type="hidden" name="sex" value="{{$request->sex}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        生年月日
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$request->birthday_year}}年
        <input type="hidden" name="birthday_year" value="{{$request->birthday_year}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$request->birthday_month}}月
        <input type="hidden" name="birthday_month" value="{{$request->birthday_month}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$request->birthday_day}}日
        <input type="hidden" name="birthday_day" value="{{$request->birthday_day}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-2 col-md-8"></div>
      <div class="col-sm-3 col-md-2"><input class="btn btn-primary" type="submit" name="complete" id="complete" value="登録"></div>
      <div class="col-sm-3 col-md-2"><a href="entry" class="btn btn-danger">戻る</a></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endsection
