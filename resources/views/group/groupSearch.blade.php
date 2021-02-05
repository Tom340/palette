@extends('layout')

@section('content')
<div class="row" style="height:30px"></div>
<div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">グループ・個人検索</h1>
</div>
<div class="row" style="height:30px"></div>
<form action="/groupSearch" method="POST" onsubmit="return jumpCheck();">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
          <label><input type="radio" name="case" value="group" checked>「団体」</label>
          <label><input type="radio" name="case" value="member">「個人」　</label>の検索
      </div>
      <div class="col-sm-4 col-md-4 even">
        <input type="text" name="word" class="box" style="width: 80%;" value="{{old('group_name')}}">
      </div>
      <div class="col-sm-2 col-md-2">
          <input class="btn btn-primary" type="submit" name="search" id="search" value="検索">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
</form>

@if(!empty($groups))
    <div class="row" style="height:30px"></div>
     <div class="row mx-3">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        団体名称
      </div>
      <div class="col-sm-2 col-md-2 even">
        活動種目/活動内容
      </div>
      <div class="col-sm-2 col-md-2 even">
        主な活動場所
      </div>
      <div class="col-sm-2 col-md-2 even">
        活動時間
      </div>
      <div class="col-sm-1 col-md-1 even">
        募集レベル
      </div>
      <div class="col-sm-1 col-md-1 back" ></div>
    </div>
  @foreach ($groups as $group)
    <div class="row" style="height:30px"></div>
     <div class="row border-bottom mx-3">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        {{$group->group_name}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$group->activity_content}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$group->pref}}{{$group->city}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$group->activity_term_st}}～{{$group->activity_term_ed}}
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$group->level_st}}～{{$group->level_ed}}
      </div>
      <div class="col-sm-1 col-md-1">
        <a href="/groupDetails/{{$group->id}}" class="btn btn-primary">詳細</a>
      </div>
      <div class="col-sm-1 col-md-1 back" ></div>
    </div>
    
  @endforeach
@endif

@if(!empty($members))
  <div class="row" style="height:30px"></div>
     <div class="row mx-3">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        姓名
      </div>
      <div class="col-sm-2 col-md-2 even">
        ふりがな
      </div>
      <div class="col-sm-2 col-md-2 even">
        性別
      </div>
      <div class="col-sm-2 col-md-2 even">
        生年月日
      </div>
      <div class="col-sm-1 col-md-1 back" ></div>
    </div>
　  @foreach ($members as $member)
    <div class="row" style="height:30px"></div>
     <div class="row border-bottom mx-3">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        {{$member->name_sei}}{{$member->name_mei}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$member->kana_sei}}{{$member->kana_mei}}
      </div>
      <div class="col-sm-2 col-md-2 even">
         @if($member->sex === 0)
          男
          @else
          女
          @endif
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$member->birthday}}
      </div>
      <div class="col-sm-1 col-md-1">
        <a href="/memberChat/{{$member->id}}" class="btn btn-danger mb-1">チャット</a>
      </div>
      <div class="col-sm-1 col-md-1 back" ></div>
    </div>
    
  @endforeach
@endif

@endsection