@extends('layout')

@section('content')

<script>
    function jumpCheck(){
      return confirm("団体を新規作成します。よろしいですか？");
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
      <h1 class="h3">グループ作成</h1>
</div>
<div class="row" style="height:30px"></div>
<form action="/groupEntry" method="POST" onsubmit="return jumpCheck();">
    {{ csrf_field() }}
<!----------------------------------------------------------->
    <div class="row">
      <div class="col-sm-1 col-md-1 back" ></div>
      <div class="col-sm-2 col-md-2 even">
        団体名称
      </div>
      <div class="col-sm-6 col-md-6 even">
        <input type="text" name="group_name" class="box" style="width: 80%;" value="{{old('group_name')}}">
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
        <input type="text" name="activity_content" class="box" style="width: 80%;" value="{{old('activity_content')}}">
      </div>
      <div class="col-sm-2 col-md-2 even">
        (その他、ボランティア等)
      </div>
      <div class="col-sm-3 col-md-3 even">
        <input type="text" name="other_content" class="box" style="width: 80%;" value="{{old('other_content')}}">
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
          <input type="text" name="established" class="box" style="width: 80%;" value="{{old('established')}}">
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
          <input type="text" name="objective" class="box" style="width: 100%;" value="{{old('objective')}}">
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
        <input type="text" name="pref" class="box" style="width: 80%;" value="{{old('pref')}}">
      </div>
      <div class="col-sm-4 col-md-4 even">
        <input type="text" name="city" class="box" style="width: 80%;" value="{{old('city')}}">
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
        <input type="text" name="activity_term_st" class="box" style="width: 80%;" value="{{old('activity_term_st')}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="activity_term_ed" class="box" style="width: 80%;" value="{{old('activity_term_ed')}}">
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
          <option value="{{old('age_st')}}">選択</option>
          <script>
            for (let i = 1; i <= 80; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
            }
          </script>
        </select>歳
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-1 col-md-1 even">
        <select name="age_ed">
          <option value="{{old('age_ed')}}">選択</option>
          <script>
            for (let i = 1; i <= 80; i++) {
              document.write("<option value='",i,"'>",i,"</option>");
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
        <input type="text" name="level_st" class="box" style="width: 80%;" value="{{old('level_st')}}">
      </div>
      <div class="col-sm-1 col-md-1 even">
        ～
      </div>
      <div class="col-sm-2 col-md-2 even">
        <input type="text" name="level_ed" class="box" style="width: 80%;" value="{{old('level_ed')}}">
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
          <input type="textarea" rows="10" name="message" style="width: 100%;" value="{{old('message')}}">
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
          <input type="textarea" name="memo" style="width: 100%;" value="{{old('memo')}}">
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
          <input type="text" name="homepage" style="width: 100%;" value="{{old('profile')}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="height:30px"></div>
    
    
    <br>
    <div class="row">
      <div class="col-sm-8 col-md-8"></div>
      <div class="col-sm-2 col-md-2"><input class="btn btn-primary" type="submit" name="complete" id="complete" value="作成"></div>
      <div class="col-sm-2 col-md-2"><a href="/mypage" class="btn btn-danger">戻る</a></div>
      <!--<div class="col-sm-1 col-md-1"></div>-->
    </div>
</form>
@endsection
