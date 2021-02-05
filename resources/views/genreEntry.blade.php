@extends('layout')

@section('content')

<script>
    function itemCheck() {
      var flag = false; // 選択されているか否かを判定する変数
      const elements = document.getElementsByName("mygenre[]");
      var checkCount = 0;
      
      for (var i = 0; i < elements.length; i++) {
        // i番目のチェックボックスがチェックされているかを判定
         if (elements[i].checked) {
           flag = true;
           checkCount++;
           }
          }
         if(flag){
           if(checkCount < 4){
           ret = confirm("選択したジャンルを追加しますか？");
           if (ret == true){
             return true;
           }
           }else{
             alert("選択できるをジャンルは三つまでです。");
             return false;
           }
           
         }
       
       // 何も選択されていない場合の処理   
         if (!flag) {
         alert("項目を選択して下さい。");
         return false;
         }
    }
</script>


@if (session('message'))
    <div class="alert alert-primary">
        {{ session('message') }}
    </div>
@endif

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
    <div class="row mx-3">
      <h1 class="h3">マイジャンル登録</h1>
    </div>
    <div class="row" style="height:30px"></div>
<div class="row">
      <div class="col-sm-3 col-md-3 mx-3">ご希望のイベントのジャンルを三つまで登録できます。</div>
</div>

<form action="/genreEntry" method="POST" onsubmit="return itemCheck();">
    {{ csrf_field() }}
  <?php
  $save_group="";
  foreach($categorys as $category) {
    if ($save_group != $category->group_name) {
      if ($save_group != "") {
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      $save_group = $category->group_name;
      echo '<div class="row" style="height:10px"></div>';
      echo '<div class="border mx-3 p-1">';
      echo '<div class="row mx-1">';
      echo '<div class="col-sm-2 col-md-2 even">'.$category->group_name.'</div>';
      echo '<div class="col-sm-9 col-md-9 even">';
    }
    foreach($user as $mygenre){
      if($mygenre->mygenre1 == $category->category_name){
      echo '<label><input type="checkbox" class="ml-5" name="mygenre[]" value = "'.$category->category_name.'" checked/>'.$category->category_name.'</label>';
      }elseif($mygenre->mygenre2 == $category->category_name){
      echo '<label><input type="checkbox" class="ml-5" name="mygenre[]" value = "'.$category->category_name.'" checked/>'.$category->category_name.'</label>';
      }elseif($mygenre->mygenre3 == $category->category_name){
      echo '<label><input type="checkbox" class="ml-5" name="mygenre[]" value = "'.$category->category_name.'" checked/>'.$category->category_name.'</label>'; 
      }else{  
      echo '<label><input type="checkbox" class="ml-5" name="mygenre[]" value = "'.$category->category_name.'"/>'.$category->category_name.'</label>';
      }
    }
   
  }
  ?>
  @foreach($user as $mygenre)
  {{$mygenre->mygenre1}}
  @endforeach
  </div>
  </div>
  </div>
  <input type="hidden" name="userid" value="{{$user_id}}" />
  <div class="row" style="height:30px"></div>
  <div class="row">
      <div class="col-sm-9 col-md-9"></div>
      <div class="col-sm-1 col-md-1"><input class="btn btn-primary" type="submit" name="send" id="send" value="ジャンル登録"></div>
      <div class="col-sm-1 col-md-1"><a href="/mypage" class="btn btn-danger">戻る</a></div>
  </div>
</form>
@endsection