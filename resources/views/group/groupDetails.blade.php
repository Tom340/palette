@extends('layout')

@section('content')
<script>
    function jumpCheck(){
      return confirm("団体に参加申請します。よろしいですか？");
    }
</script>

@if (session('message'))
 <div class="row">
   <div class="col-sm-1 col-md-1 back" ></div>
   <div class="alert alert-primary">
     {{ session('message') }}
   </div>
 </div>
@endif

@foreach ($groups as $group)

<form action="/groupDetails" method="POST" onsubmit="return jumpCheck();">
    {{ csrf_field() }}
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
    
    <input type="hidden" name="groupid" value="{{$group->id}}">
    <input type="hidden" name="userid" value="{{$user_id}}">
 　<br>
    <div class="row">
      <div class="col-sm-8 col-md-8"></div>
      @if(count($check) == 0)
        <div class="col-sm-2 col-md-2"><input class="btn btn-primary" type="submit" name="send" id="send" value="参加申請"></div>
      @else
        <div class="alert alert-primary">参加申請済の団体です</div>
      @endif
      <div class="col-sm-2 col-md-2"><a href="/groupSearch" class="btn btn-danger">戻る</a></div>
    </div>
</form>  

@endforeach
@endsection