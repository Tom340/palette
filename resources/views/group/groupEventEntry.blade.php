@extends('group.layout')

@section('content')
<script>
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
		$("#datepicker").datepicker();
	});
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
		$("#datepicker2").datepicker();
	});
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
		$("#datepicker3").datepicker();
	});
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
		$("#datepicker4").datepicker();
	});
	
    function jumpCheck(){
      return confirm("イベントを新規作成します。よろしいですか？");
    }
    
    function category1_change() {
	  var category1 = document.getElementById("category1").value;
	  var category2 = document.getElementById("category2");
	  category2.style.display = "block";
	  for(var i = category2.length; i > 1; i--) {
  	  category2.remove(i-1);
	  }
    var ajax = new XMLHttpRequest();
    ajax.open("get", "/groupEventSearchCategory?group="+category1);
    ajax.responseType = "json";
    ajax.send(); // 通信させます。
    ajax.addEventListener("load", function(){
      var json = this.response;
      for(var i = 0; i < json.length; i++) {
        var option = document.createElement("option");
        option.text = json[i]['category_name'];
        option.value = json[i]['category_name'];
        category2.appendChild(option);
      }
    });
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
  <h1 class="h3">イベント登録</h1>
</div>
<div class="row" style="height:30px"></div>
<form action="/groupEventEntry" method="POST" enctype="multipart/form-data" onsubmit="return jumpCheck();">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        基本情報
      </div>
    </div>

<div class="border">
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント名
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="event_name" class="box" style="width: 80%;" value="{{old('event_name')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        概要
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="overview" class="box" style="width: 80%;" value="{{old('overview')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!-------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        ジャンル
      </div>
      <div class="col-sm-6 col-md-6 even">
        <select id="category1" name="genre" onchange="category1_change()" value="{{old('genre')}}">
          <option value=""}>選択してください</option>
          @foreach($group_name as $row) {
            <option value="{{$row->group_name}}">{{$row->group_name}}</option>
          @endforeach
        </select><br>
        <select id="category2" name="category2" onchange="category2_change()">
          <option value=""}>選択してください</option>
        </select>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!-------------------------------------------------->
  
     <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        イベント形態 
      </div>
      <div class="col-sm-2 col-md-2 even">
          <label><input type="radio" name="event_form" value="オフライン" checked>オフライン</label>
      </div>
      <div class="col-sm-2 col-md-2 even">
          <label><input type="radio" name="event_form" value="オンライン">オンライン</label>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        料金制度
      </div>
      <div class="col-sm-1 col-md-1 even">
          <label><input type="radio" name="paid" value="無料" checked>無料</label>
      </div>
      <div class="col-sm-1 col-md-1 even">
          <label><input type="radio" name="paid" value="有料">有料</label>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        開催日時
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="eventdate_st" class="box" id="datepicker" style="width: 80%;" value="{{old('eventdate_st')}}" placeholder="開催開始日を選択して下さい">
      </div>
      <div class="col-sm-2 col-md-2 even">
        <select name="eventtime_st">
          <option value="{{old('eventtime_st')}}">選択</option>
          <script>
            for (let i = 0; i <= 23; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>時
        <!--<input type="text" name="eventtime_st" class="box" style="width: 80%;" value="{{old('eventtime_st')}}">時-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even"></div>
    <div class="col-sm-2 col-md-2 even">から</div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="eventdate_ed" class="box" id="datepicker2" style="width: 80%;" value="{{old('eventdate_ed')}}" placeholder="開催終了日を選択して下さい">
      </div>
      <div class="col-sm-2 col-md-2 even">
        <select name="eventtime_ed">
          <option value="{{old('eventtime_ed')}}">選択</option>
          <script>
            for (let i = 0; i <= 23; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>時
        <!--<input type="text" name="eventtime_ed" class="box" style="width: 80%;" value="{{old('eventtime_ed')}}">時-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>    
<!-------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        定員
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="capacity" class="box" style="width: 80%;" value="{{old('capacity')}}">人
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <!----------------------------------------------------->
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        募集期間
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="recruitdate_st" class="box" id="datepicker3" style="width: 80%;" value="{{old('recruitdate_st')}}" placeholder="募集開始日を選択して下さい">
      </div>
      <div class="col-sm-2 col-md-2 even">
        <select name="recruittime_st">
          <option value="{{old('recruittime_st')}}">選択</option>
          <script>
            for (let i = 0; i <= 23; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>時
        <!--<input type="text" name="recruittime_st" class="box" style="width: 80%;" value="{{old('recruittime_st')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even"></div>
    <div class="col-sm-2 col-md-2 even">から</div>
    </div>
<!----------------------------------------------------->
    <div class="row" style="height:10px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="recruitdate_ed" class="box" id="datepicker4" style="width: 80%;" value="{{old('recruitdate_ed')}}" placeholder="募集終了日を選択して下さい">
      </div>
      <div class="col-sm-2 col-md-2 even">
        <select name="recruittime_ed">
          <option value="{{old('recruittime_ed')}}">選択</option>
          <script>
            for (let i = 0; i <= 23; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>時
        <!--<input type="text" name="recruittime_ed" class="box" style="width: 80%;" value="{{old('recruittime_ed')}}">-->
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div> 
    <div class="row" style="height:30px"></div>
</div><!---------ここまで基本情報----------------------->

    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント内容
      </div>
    </div>
<div class="border">
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        イベント画像
      </div>
      <div class="col-sm-1 col-md-1 odd">
          <img src="../images/person.png" width="97px" height="118px" alt="" class="box">
      </div>
      <div class="col-sm-2 col-md-2 odd">
          <input type="file" name="event_img" style="width: 100%;" value="{{old('event_img')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------------>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        イベント案内文
      </div>
      <div class="col-sm-6 col-md-6 even">
        <textarea  name="event_info" class="box" style="width: 80%;" cols = "50" rows = "10">{{old('event_info')}}</textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
</div><!---------ここまでイベント内容------------------->
    
     <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        開催場所
      </div>
    </div>
<div class="border">
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        会場名
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="place_name" class="box" style="width: 80%;" value="{{old('place_name')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        会場のURL
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="place_url" class="box" style="width: 80%;" value="{{old('place_url')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        国
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="country" class="box" style="width: 80%;" value="<?php if(empty(old('country'))) echo '日本';?>">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        都道府県
      </div>
      <div class="col-sm-1 col-md-1 even">
        <select name="pref" class="box" style="width: 80%;" value="{{old('pref')}}">
          <?php
          $prefs = array ('選択','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
          foreach($prefs as $pref){
	         print('<option value="'.$pref.'">'.$pref.'</option>');
          }
         ?>
         </select>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        市区町村・番地
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="city" class="box" style="width: 80%;" value="{{old('city')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
<!------------------------------------------------>
　　<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        ビル名・階数
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="building" class="box" style="width: 80%;" value="{{old('building')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
</div><!-----------ここまで会場----------->

    <input type="hidden" name="groupid" value="{{$id}}">
    <input type="hidden" name="userid" value="{{$user_id}}">

    <br>
    <div class="row">
      <div class="col-sm-2 col-md-8"></div>
      <div class="col-sm-1 col-md-1"><input class="btn btn-primary" type="submit" name="confirm" id="confirm" value="確認"></div>
      <div class="col-sm-1 col-md-1"><a href="/groupMenu/{{$id}}" class="btn btn-danger">戻る</a></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endsection