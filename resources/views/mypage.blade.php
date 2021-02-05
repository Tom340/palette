@extends('layout')

@section('content')

@foreach ($user as $row)

    
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">マイページ</h1>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        名前
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$row->name_sei}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$row->name_mei}}
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
          {{$row->cellular}}
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
          {{$row->email}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        プロフィール画像
      </div>
      <div class="col-sm-4 col-md-4">
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
      <div class="col-sm-2 col-md-2 odd">
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
          @if($row->sex === 0)
          男
          @else
          女
          @endif
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        生年月日
      </div>
      <div class="col-sm-1 col-md-4 even">
        {{date('Y年 m月 d日',  strtotime($row->birthday))}}
        
      </div>
      
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        マイジャンル1
      </div>
      <div class="col-sm-1 col-md-4 even">
        @if(!empty($row->mygenre1))
        {{$row->mygenre1}}
        @endif
      </div>
      
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        マイジャンル2
      </div>
      <div class="col-sm-1 col-md-4 even">
        @if(!empty($row->mygenre2))
        {{$row->mygenre2}}
        @endif
      </div>
      
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        マイジャンル3
      </div>
      <div class="col-sm-1 col-md-4 even">
        @if(!empty($row->mygenre3))
        {{$row->mygenre3}}
        @endif
        
      </div>
      
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-4 col-md-4"></div>
      <div class="col-sm-6 col-md-6">
        <a href="/mygroup" class="btn btn-danger">マイグループ一覧</a>
        <a href="/memberChatList" class="btn btn-danger">マイチャットルーム一覧</a>
        <a href="/genreEntry" class="btn btn-danger">マイジャンル登録</a>
        <a href="/user_edit" class="btn btn-danger">プロフィール変更</a>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
@endforeach
@endsection
