@extends('layout')

@section('content')

<script>
    function jumpCheck(){
      return confirm("団体情報を更新します。よろしいですか？");
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
      @if (session('message'))
            <div class="alert alert-primary">
                {{ session('message') }}
            </div>
      @endif
<div class="row" style="height:30px"></div>
<div class="row">
  <div class="col-sm-1 col-md-1"></div>
  <h1 class="h3">グループ情報編集</h1>
</div>
<div class="row" style="height:30px"></div>      
@foreach ($groups as $group)
<form action="/groupEdit" method="POST" onsubmit="return jumpCheck();">
    {{ csrf_field() }}
<!----------------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        団体名称
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="group_name" class="box" style="width: 80%;" value="{{$group->group_name}}">
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
        <input type="text" name="activity_content" class="box" style="width: 80%;" value="{{$group->activity_content}}">
      </div>
      <div class="col-sm-2 col-md-2 even">
        (その他、ボランティア等)
      </div>
      <div class="col-sm-3 col-md-3 even">
        <input type="text" name="other_content" class="box" style="width: 80%;" value="<?php if(!empty($group->other_content)){ echo $group->other_content;};?>">
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
          <input type="text" name="established" class="box" style="width: 80%;" value="{{$group->established}}">
      </div>
      <div class="col-sm-2 col-md-2 odd">
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
          <input type="text" name="objective" class="box" style="width: 100%;" value="{{$group->objective}}">
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
        <input type="text" name="pref" class="box" style="width: 80%;" value="{{$group->pref}}">
      </div>
      <div class="col-sm-4 col-md-4 even">
        <input type="text" name="city" class="box" style="width: 80%;" value="{{$group->city}}">
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
        <input type="text" name="activity_term_st" class="box" style="width: 80%;" value="{{$group->activity_term_st}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="activity_term_ed" class="box" style="width: 80%;" value="{{$group->activity_term_ed}}">
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
      <div class="col-sm-1 col-md-1 even">
        <select name="age_st">
          <option value="{{$group->age_st}}">選択</option>
            <script>
            let age_st = <?php if (!empty($group['age_st'])) echo $group['age_st']; else echo "0";?>;
            for (let i = 1; i <= 80; i++) {
              if(i == age_st){
              document.write("<option value='",i,"' selected>",i,"</option>");
            } else {
            document.write("<option value='",i,"'>",i,"</option>");
            }
            }
         
          </script>
        </select>歳
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-1 col-md-1 even">
        <select name="age_ed">
          <option value="{{$group->age_ed}}">選択</option>
          <script>
            let age_ed = <?php if (!empty($group['age_ed'])) echo $group['age_ed']; else echo "0";?>;
            for (let i = 1; i <= 80; i++) {
              if(i == age_ed){
              document.write("<option value='",i,"' selected>",i,"</option>");
            } else {
            document.write("<option value='",i,"'>",i,"</option>");
            }
            }
         
          </script>
        </select>歳
      </div>
      <div class="col-sm-1 col-md-1 odd">
        平均年齢
      </div>
      <div class="col-sm-2 col-md-2 odd">
        〇〇歳
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
        <input type="text" name="level_st" class="box" style="width: 80%;" value="{{$group->level_st}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="level_ed" class="box" style="width: 80%;" value="{{$group->level_ed}}">
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
          <input type="textarea" rows="10" name="message" style="width: 100%;" value="{{$group->message}}">
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
          <input type="textarea" name="memo" style="width: 100%;" value="<?php if(!empty($group->memo)){ echo $group->memo;};?>">
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
          <input type="text" name="homepage" style="width: 100%;" value="<?php if(!empty($group->homepage)){ echo $group->homepage;};?>">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    
    <input type="hidden" name="id" value="{{$group->id}}">
    <br>
    <div class="row">
      <div class="col-sm-8 col-md-8"></div>
      <div class="col-sm-2 col-md-2"><input class="btn btn-primary" type="submit" name="complete" id="complete" value="更新"></div>
      <div class="col-sm-2 col-md-2"><a href="/groupMenu/{{$group->id}}" class="btn btn-danger">戻る</a></div>
      <!--<div class="col-sm-1 col-md-1"></div>-->
    </div>
</form>
@endforeach
@endsection
