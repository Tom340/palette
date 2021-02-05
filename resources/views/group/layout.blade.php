<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <title>{{$title}}</title>
    </head>
    <body>
      <div class="container-fluid">
        <div class="row" style="background-color: white">
          <div class="col-sm-1 col-md-1"></div>
          <div class="col-sm-1 col-md-1"><a href="/"><img src="/images/small_logo.jpg" width="133px" height="100px" alt="logo"></a></div>
          <div class="col-sm-2 col-md-2"></div>
          <div class="col-sm-8 col-md-8 mt-4">
            <a href="/mypage" class="btn btn-danger">マイページ</a>
            <a href="/groupEntry" class="btn btn-danger">グループ作成</a>
            <a href="/groupSearch" class="btn btn-danger">グループ・個人検索</a>
            <a href="/groupEventSearch" class="btn btn-danger">イベント検索</a>
            <a href="/event" class="btn btn-danger">カレンダー</a>
          </div>
        </div>
        <hr>
        @yield('content')
        <hr>
      <footer class="footer">
        <section class="content-wrapper">
           <div class="high">
             <h1>Palette</h1>
               <ul>
                 <li><a href="/">TOP</a></li>
                 <li><a href="/entry">新規登録</a></li>
                  <li><a href="/logout">ログアウト</a></li>
               </ul>
           </div>
           <div class="low">
              〒000-0000<span>企業住所</span><br>
              TEL:000-0000-0000
           </div>
           <p>&copy;Palette Co.,Ltd</p>
        </section>
       </footer>

        
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <script type="text/javascript" src="jquery-3.2.1.js"></script>
    </body>
</html>
