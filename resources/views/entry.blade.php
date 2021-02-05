@extends('layout_before')

@section('content')

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

<form action="/confirm" method="POST" enctype="multipart/form-data">
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
        <input type="text" name="kana_sei" class="box" style="width: 80%;" value="{{old('kana_sei')}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        (めい)
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="kana_mei" class="box" style="width: 80%;" value="{{old('kana_mei')}}">
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
        <input type="text" name="name_sei" class="box" style="width: 80%;" value="{{old('name_sei')}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        (名)
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="name_mei" class="box" style="width: 80%;" value="{{old('name_mei')}}">
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
          <input type="text" name="cellular" class="box" style="width: 100%;" value="{{old('cellular')}}">
      </div>
      <div class="col-sm-2 col-md-2 odd">
        ハイフンなし
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
          <input type="text" name="email" class="box" style="width: 100%;" value="{{old('email')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
     <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        パスワード
      </div>
      <div class="col-sm-4 col-md-4 odd">
          <input type="password" name="password" class="box" style="width: 100%;" value="{{old('cellular')}}">
      </div>
      <div class="col-sm-2 col-md-2 odd">
        英数字
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        プロフィール画像
      </div>
      <div class="col-sm-1 col-md-1 odd">
          <img src="images/person.png" width="97px" height="118px" alt="" class="box">
      </div>
      <div class="col-sm-2 col-md-2 odd">
          <input type="file" name="profile" style="width: 100%;" value="{{old('profile')}}">
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
          <label><input type="radio" name="sex" value="0">男性</label>
      </div>
      <div class="col-sm-1 col-md-1 even">
          <label><input type="radio" name="sex" value="1">女性</label>
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
        <select name="birthday_year">
          <option value="{{old('birthday_year')}}">選択</option>
          <script>
            let today = new Date();
            for (let i = 120; i >= 0; i--) {
              let tmp = today.getFullYear()-i;
              document.write("<option value='",tmp,"'>",tmp,"</option>");
            }
          </script>
        </select>年
      </div>
      <div class="col-sm-1 col-md-1 even">
        <select name="birthday_month">
          <option value="{{old('birthday_month')}}">選択</option>
          <script>
            for (let i = 1; i <= 12; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>月
      </div>
      <div class="col-sm-1 col-md-1 even">
        <select name="birthday_day">
          <option value="{{old('birthday_day')}}">選択</option>
          <script>
            for (let i = 1; i <= 31; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>日
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-2 col-md-8"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="confirm" id="confirm" value="確認"></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endsection
