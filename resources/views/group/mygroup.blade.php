@extends('layout')

@section('content')
<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">所属グループ一覧</h1>
</div>
@if(count($mygroup) == 0)
            <p>所属団体がありません。</p>
@else
@foreach ($mygroup as $group)

    <div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-1 col-md-1 even">
        団体名:
      </div>
      <div class="col-sm-1 col-md-1 even">
        {{$group->group_name}}
      </div>
      <div class="col-sm-1 col-md-1 even">
        活動内容:
      </div>
      <div class="col-sm-2 col-md-2 even">
        {{$group->activity_content}}
      </div>
      <div class="col-sm-1 col-md-1 even">
        管理者:
      </div>
      <div class="col-sm-1 col-md-1">
        @if($group->created_userid === $user_id)
          あなた
        @else
          その他
        @endif
      </div>
      <div class="col-sm-1 col-md-1">
        <a href="/groupMenu/{{$group->groupid}}" class="btn btn-primary">詳細</a>
      </div>
    </div>


@endforeach
@endif
@endsection