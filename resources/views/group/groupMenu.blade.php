@extends('layout')

@section('content')

@if (session('message'))
   <div class="alert alert-primary">
     {{ session('message') }}
   </div>
@endif
<div class="row" style="height:30px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <h1 class="h3">グループメニュー</h1>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      *権限者はイベント登録やメンバー編集から参加申請の承認ができます。
      </div>
    <div class="row" style="height:30px"></div>
@foreach ($groups as $group)
<!----------------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        団体名称
      </div>
      <div class="col-sm-6 col-md-6 even">
        {{$group->group_name}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!---------------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        活動種目/活動内容
      </div>
      <div class="col-sm-3 col-md-3 even">
          {{$group->activity_content}}
      </div>
      <div class="col-sm-2 col-md-2 even">
        (その他、ボランティア等)
      </div>
      <div class="col-sm-3 col-md-3 even">
         @if(!empty($group->other_content))
          {{$group->other_content}}
         @endif
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!--------------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        設立
      </div>
      <div class="col-sm-2 col-md-2 odd">
          {{$group->established}}
        年(西暦)
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!-------------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        目標
      </div>
      <div class="col-sm-6 col-md-6 odd">
          {{$group->objective}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!------------------------------------------------------>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        主な活動場所
      </div>
      <div class="col-sm-3 col-md-3 even">
          {{$group->pref}}
      </div>
      <div class="col-sm-4 col-md-4 even">
          {{$group->city}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!--------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        活動時間
      </div>
      <div class="col-sm-2 col-md-2 even">
          {{$group->activity_term_st}}
        ～
          {{$group->activity_term_ed}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!-------------------------------------------------->
<!----メンバー機能要調整-------->
     <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        構成メンバー数
      </div>
      <div class="col-sm-2 col-md-2 odd">
          {{$member_num}}
      </div>
      <div class="col-sm-2 col-md-2 odd">
        人
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!------------------------------------------------>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        募集年齢
      </div>
      <div class="col-sm-3 col-md-3 even">
        {{$group->age_st}}歳
        ～
        {{$group->age_ed}}歳
      </div>
      <div class="col-sm-1 col-md-1 odd">
        平均年齢
      </div>
      <div class="col-sm-2 col-md-2 odd">
        <?php echo ($group['age_st']+$group['age_ed'])/2;?>歳
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!---------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 even">
        募集レベル
      </div>
      <div class="col-sm-2 col-md-2 even">
          {{$group->level_st}}
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-2 col-md-2 even">
          {{$group->level_ed}}
        
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!---------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        募集メッセージ
      </div>
      <div class="col-sm-8 col-md-8 odd">
          {{$group->message}}
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!---------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        連絡事項
      </div>
      <div class="col-sm-8 col-md-8 odd">
          @if(!empty($group->memo))
          {{$group->memo}}
          @endif
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
<!--------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 odd">
        ホームページ
      </div>
      <div class="col-sm-8 col-md-8 odd">
          @if(!empty($group->homepage))
          {{$group->homepage}}
          @endif
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    
    
    <br>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      @foreach($check as $row)
        @if($row['representative_status'] == 1)
        <div class="col-sm-4 col-md-4">
          <a href="/groupEdit/{{$group->id}}" class="btn btn-danger">グループ情報編集</a>
          <a href="/groupMemberEdit/{{$group->id}}" class="btn btn-danger">メンバー編集</a>
          <a href="/groupEventEntry/{{$group->id}}" class="btn btn-danger">イベント登録</a>
        </div>
        
        @endif
      @endforeach
      <div class="col-sm-5 col-md-5"><a href="/groupChat/{{$group->id}}" class="btn btn-danger">メンバー内チャット</a>
      <a href="/groupMemberList/{{$group->id}}" class="btn btn-danger">グループメンバー一覧</a>
      <a href="/groupEventList/{{$group->id}}" class="btn btn-danger">登録イベント一覧</a>
      </div>
      <div class="col-sm-2 col-md-2"><a href="/mygroup" class="btn btn-danger">戻る</a></div>
      <!--<div class="col-sm-1 col-md-1"></div>-->
    </div>


@endforeach
@endsection