<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <title>palette</title>
    <script>
      var sliders = [ "images/team1.jpg", "images/team2.jpg", "images/team3.jpg" ];
      var msg = [ "大切な思い出造りをお手伝いします", "新しいことを初めてみませんか？", "同じ志を持った仲間と共に", "まずはアカウント作成から" ];
      var sliderNum = 0;
      var messageNum = 0;
      function startslider() {
        const slider = document.getElementById('slide');
        //const msg = document.getElementById('sliderMessage');
        if (++sliderNum >= sliders.length) sliderNum = 0;
        if (++messageNum >= msg.length) messageNum = 0;
        slider.style.backgroundImage = "url( " + sliders[sliderNum] + " )";
        slider.innerHTML = "<br><br><h1>" + msg[messageNum] + "</h1>";
        // fadein
        slider.animate([{opacity: '0'}, {opacity: '1'}], 2000)
      }
    </script>
  </head>
  <body>
    <header>
      <div class="header-content">
        <div class="logo">
          <img src="images/logo.jpg" alt="ロゴ">
        </div>
        <div class="header-bottan">
          <p><a href="#login" class = "h-link">ログイン</a></p>
          <p><a href="/entry" class = "h-link">新規登録</a></p>
        </div>
      </div>
    </header>
    
    <div id="slide" class="slide">
        <h1 id="sliderMessage"></h1>
    </div>
    
    <div class="about-contents">
      <div class="about-inner">
        <div class="about-copy">
          <h1>趣味、スポーツ、ビジネス<br>
              同じ志を持った仲間との<br>
              ヨコの繋がりを楽しむ</h1>
          <p>目的のグループを検索、参加をして<br>
             よりカジュアルなマッチングを<br>
             お楽しみいただけます。</p>
         </div>
         <div class="about-img">
            <img src="images/about.jpg"></img>
         </div>
      </div>
    </div>
    <header>
      <div class="header-content">
        <div class="logo">
          <img src="images/logo.jpg" alt="ロゴ">
        </div>
        <div class="header-bottan">
          <p><a href="#login" class = "h-link">ログイン</a></p>
          <p><a href="/entry" class = "h-link">新規登録</a></p>
        </div>
      </div>
    </header>    
    <div class="step-contents">
      <div class="step-inner">
        <div class="step-copy">
          <div class="step-img"><img src="images/step.png"></img></div>
          <h1>人生の輪を広げる<br>
          グループマッチングをあなたに</h1>
        </div>
        <div class="step-item">
          <h3>step 1</h3>
          <div class="step-img"><img src="images/step1.png"></img></div>
          <p>興味のあるグループを検索・参加<br>
          または自身でグループを作成</p>
        </div>
        <div class="step-item">
          <h3>step 2</h3>
          <div class="step-img"><img src="images/step2.png"></img></div>
          <p>グループ内でのイベントに<br>
          参加、または作成</p>
        </div>
        <div class="step-item">
          <h3>step 3</h3>
          <div class="step-img"><img src="images/step3.png"></img></div>
          <p>グループ内・個人間のチャット機能で<br>
          やりとりや情報共有もできます</p>
        </div>
        <div class="step-item">
          <h3>step 4</h3>
          <div class="step-img"><img src="images/step4.png"></img></div>
          <p>カレンダー機能で興味があるジャンルの<br>
          イベントのチェック</p>
        </div>
      </div>
    </div>
    
    <!--<div id="container_top">-->
    <!--  <div id="logo">-->
    <!--    <img src="images/logo.jpg" alt="ロゴ">-->
    <!--  </div>-->
    <!--  <div id="header_top" class="box">-->
    <!--  </div>-->
      <!--<div id="slider" class="box">-->
      <!--  <h1 id="sliderMessage"></h1>-->
      <!--</div>-->
      <div id="login">
      @if (session('message'))
            <div class="message">
                {{ session('message') }}
            </div>
      @endif
        <form action="/login" method="POST">
          {{ csrf_field() }}
          <br><label>メールアドレス:</label><br><input type="text" name="email" size="35">
          <br>@error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
          @enderror
          <br><br><label>パスワード　　:</label><br><input type="password" name="password" size="35">
          @error('password')
             <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
             </span>
          @enderror
          <br><br><input type="submit" name="login" value="ログイン">
          <br><br><br><a href="/password/reset">パスワードを忘れた</a>
          <br><br>テスト用email: test1234@icloud.com
          <br>テスト用pass:Test1234
        </form>
      </div>
      <div id="newentry">
          <br><label>まだアカウントをお持ちでない方は</label>
          <br><br><button onclick="location.href='/entry'">新規登録</button>
        </form>
      </div>
      
      <footer class="footer">
        <section class="content-wrapper">
           <div class="high">
             <h1>Palette</h1>
               <ul>
                 <li><a href="#login">ログイン</a></li>
                 <li><a href="/entry">新規登録</a></li>
                  <li><a href="#">About</a></li>
               </ul>
           </div>
           <div class="low">
              〒000-0000<span>企業住所</span><br>
              TEL:000-0000-0000
           </div>
           <p>&copy;Palette Co.,Ltd</p>
        </section>
       </footer>
      <!--<div id="news" class="box">-->
      <!--  <h3>おしらせ</h3>-->
      <!--</div>-->
      <!--<div id="description" class="box">-->
      <!--</div>-->
      <!--<div id="footer_top" class="box">-->
      <!--  <ul>-->
      <!--    <li><a href="company.php">運営会社</a></li>-->
      <!--    <li><a href="service.php">サービス内容</a></li>-->
      <!--  </ul>-->
      <!--</div>-->
    <!--</div>-->
    <script>
      startslider();
      setInterval(startslider, 8000);
    </script>
  </body>
</html>
