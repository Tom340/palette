@extends('group.layout')

@section('content')

<script>
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional["ja"]);
		$("#datepicker").datepicker();
	});
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

<div class="row" style="height:30px"></div>
<div class="row">
  <div class="col-sm-1 col-md-1"></div>
  <h1 class="h3">イベント検索</h1>
</div>
<div class="row" style="height:30px"></div>
<form action="/groupEventSearch" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
         イベント日付
      </div>
      <div class="col-sm-4 col-md-4 even">
        <input type="text" name="eventdate" class="box" id="datepicker" style="width: 80%;" value="{{old('eventdate')}}" placeholder="開催開始日を選択して下さい">
      </div>
    </div>
    
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
         活動種目
      </div>
      <div class="col-sm-4 col-md-4 even">
        <select id="category1" name="category1" onchange="category1_change()">
          <option value="">選択してください</option>
          @foreach($group_name as $row) {
            <option value="{{$row->group_name}}">{{$row->group_name}}</option>
          @endforeach
        </select><br>
        <select id="category2" name="category2" onchange="category2_change()">
          <option value=""}>選択してください</option>
        </select>
      </div>
    </div>
    
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
         場所
      </div>
      <div class="col-sm-4 col-md-4 even">
        <select name="pref" class="box" style="width: 80%;" value="{{old('pref')}}">
          <?php
          $prefs = array ('','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
          foreach($prefs as $pref){
	         print('<option value="'.$pref.'">'.$pref.'</option>');
          }
         ?>
         </select>
      </div>
    </div>
    
    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
         募集人数
      </div>
      <div class="col-sm-4 col-md-4 even">
        <input type="text" name="capacity" class="box" style="width: 80%;" value="{{old('capacity')}}">
      </div>
      <div class="col-sm-2 col-md-2">
          <input class="btn btn-primary" type="submit" name="search" id="search" value="検索">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
</form>

@if(!empty($events))
    <div class="row" style="height:30px"></div>
    <div class="row">
        <div class="col-sm-1 col-md-1 back" ></div>
        <div class="col-sm-2 col-md-2 even">
          イベント名称
        </div>
        <div class="col-sm-2 col-md-2 even">
          活動種目
        </div>
        <div class="col-sm-1 col-md-1 even">
          場所
        </div>
        <div class="col-sm-1 col-md-1 even">
          募集人数
        </div>
        <div class="col-sm-1 col-md-1 even">
          イベント日
        </div>
        <div class="col-sm-2 col-md-2 even">
          グループ名
        </div>
        <div class="col-sm-1 col-md-1 back" ></div>
    </div>
    <div class="row" style="height:30px"></div>
   @foreach($events as $event)
   <div class="row" style="height:15px"></div>
   <div class="row border-bottom">
        <div class="col-sm-1 col-md-1 back" ></div>
        <div class="col-sm-2 col-md-2 even">
         {{$event->event_name}}
        </div>
        <div class="col-sm-2 col-md-2 even">
         {{$event->genre}}{{$event->sub_genre}}
        </div>
        <div class="col-sm-1 col-md-1 even">
         {{$event->pref}}
        </div>
        <div class="col-sm-1 col-md-1 even">
         {{$event->capacity}}人
        </div>
        <div class="col-sm-1 col-md-1 even">
         {{$event->eventdate_st}}から{{$event->eventdate_ed}}まで
        </div>
        <div class="col-sm-2 col-md-2 even">
          {{$event->group_name}}
        </div>
        <div class="col-sm-1 col-md-1">
        <a href="/groupEventDetails/{{$event->id}}" class="btn btn-danger">詳細</a>
      </div>
        <div class="col-sm-1 col-md-1 back" ></div>
    </div>
    @endforeach
@endif

@endsection