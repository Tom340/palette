<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Category;
use App\GroupEvent;
use App\Facades\Calendar;
use App\Services\CalendarService;
use Carbon\Carbon;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('entry')->with([
            'title' => "新規ユーザ登録入力"]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register(Request $request)
    {
        return view('home');
    }

    public function login(Request $request)
    {
        return view('mypage');
    }
    
    public function confirm(Request $request)
    {
    //   ヴァリデーション・・・漢字。カナチェックは？
       $this->validate($request, [
             'kana_mei' => 'required',
             'kana_sei' => 'required',
             'name_mei' => 'required',
             'name_sei' => 'required',
             'cellular' => 'required|digits:11',
             'email' => 'required|email',
             'password' => 'required|alpha_num',
             'sex' => 'required',
             'birthday_year' => 'required',
             'birthday_month' => 'required',
             'birthday_day' => 'required',
             ], [
             'kana_mei.required' => ':attribute を入力して下さい',
             'kana_sei.required' => ':attribute を入力して下さい',
             'name_mei.required' => ':attribute を入力して下さい',
             'name_sei.required' => ':attribute を入力して下さい',
             'cellular.required' => ':attribute を入力して下さい',
             'cellular.digits' => ':attribute は11桁の数値で入力して下さい',
             'email.required' => ':attribute を入力して下さい',
             'email.email' => ':attribute を正しく入力して下さい',
             'password.required' => ':attribute を入力して下さい',
             'password.alpha_num' => ':attribute は英数字で入力して下さい',
             'sex.required' => ':attribute を入力して下さい',
             'birthday_year.required' => ':attribute を入力して下さい',
             'birthday_month.required' => ':attribute を入力して下さい',
             'birthday_day.required' => ':attribute を入力して下さい',
             
             ], [
             'kana_mei' => 'ふりがな(めい)',
             'kana_sei' => 'ふりがな(せい)',
             'name_mei' => '名前(名)',
             'name_sei' => '名前(姓)',
             'cellular' => '電話番号',
             'email' => 'メールアドレス',
             'password' => 'パスワード',
             'sex' => '性別',
             'birthday_year' => '生年月日(年)',
             'birthday_month' => '生年月日(月)',
             'birthday_day' => '生年月日(日)',
             ]);
        $mimeType="";
        $base64="";
        $imageName="";
        // 画像の処理
        if($request->hasFile('profile')){    
            // 拡張子つきでファイル名を取得
            $imageName = $request->profile->getClientOriginalName();
            // storage/app/../../imagesに画像を一時保存(=/var/www/palette/palette/images)
            $profile = $request->profile->storeAs('images',$imageName);
    
            // 拡張子のみ
            $extension = $request->profile->getClientOriginalExtension();
    
            $mimeType = Storage::mimeType('images/'.$imageName);
            $contents = Storage::disk('images')->get($imageName);
            $base64 = base64_encode($contents);
        }
        return view('confirm',compact('request'))->with([
            'title' => "新規ユーザ登録確認",
            'mimetype' => $mimeType,
            'base64' => $base64,
            'imageName' => $imageName
        ]);
        
    }
    
    
    public function registUser(Request $request)
    {
        $birthday = $request->birthday_year."/".$request->birthday_month."/".$request->birthday_day;
        
        $user = new User();
        $user-> name_sei = $request-> name_sei;
        $user-> name_mei = $request-> name_mei;
        $user-> kana_sei = $request-> kana_sei;
        $user-> kana_mei = $request-> kana_mei;
        $user-> cellular = $request-> cellular;
        $user-> email = $request-> email;
        $user-> password = password_hash($request-> password, PASSWORD_DEFAULT);
        $user-> profile_image = $request->profile;
        $user-> sex = $request-> sex;
        $user-> birthday = $birthday;
        $user-> created_at = now();
        $user-> updated_at = now();
		$user-> save();
		
	    
        \File::cleanDirectory(public_path() . "/img");
        
	    return redirect('/')
    	->with('message','新規登録しました。')
    	;
	   
        
        
    }
    
    
    public function mypage(Request $request)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        
        $user = User::find($user_id);
        $base64="";
        $mimeType = "";
        if ($user->profile_image) {
            $mimeType = Storage::mimeType('images/'.$user->profile_image);
            $contents = Storage::disk('images')->get($user->profile_image);
            //Log::debug('Storage image realpath'.$contents);
            $base64 = base64_encode($contents);
        }
        $user = User::where('id',$user_id)->get();
        return view('mypage',['user'=> $user])
        ->with(['title' => "マイページ"])
        ->with(['mimetype' => $mimeType])
        ->with(['base64' => $base64]);
    }
    

    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect('/');
    }
    
    public function editUserView(Request $request)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        $user = User::find($user_id);
        $base64="";
        $mimeType = "";
        if ($user->profile_image) {
            $mimeType = Storage::mimeType('images/'.$user->profile_image);
            $contents = Storage::disk('images')->get($user->profile_image);
            //Log::debug('Storage image realpath'.$contents);
            $base64 = base64_encode($contents);
        }
        $user = User::where('id',$user_id)->get();
        
        return view('user_edit',['user'=> $user])
        ->with(['title' => "プロフィール変更"])
        ->with(['mimetype' => $mimeType])
        ->with(['base64' => $base64]);
    }
    
    public function editUser(Request $request)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        
         $this->validate($request, [
             'kana_mei' => 'required',
             'kana_sei' => 'required',
             'name_mei' => 'required',
             'name_sei' => 'required',
             'cellular' => 'required|digits:11',
             'email' => 'required|email',
             'sex' => 'required',
             'birthday_year' => 'required',
             'birthday_month' => 'required',
             'birthday_day' => 'required',
             ], [
             'kana_mei.required' => ':attribute を入力して下さい',
             'kana_sei.required' => ':attribute を入力して下さい',
             'name_mei.required' => ':attribute を入力して下さい',
             'name_sei.required' => ':attribute を入力して下さい',
             'cellular.required' => ':attribute を入力して下さい',
             'cellular.digits' => ':attribute は11桁の数値で入力して下さい',
             'email.required' => ':attribute を入力して下さい',
             'email.email' => ':attribute を正しく入力して下さい',
             'sex.required' => ':attribute を入力して下さい',
             'birthday_year.required' => ':attribute を入力して下さい',
             'birthday_month.required' => ':attribute を入力して下さい',
             'birthday_day.required' => ':attribute を入力して下さい',
             
             ], [
             'kana_mei' => 'ふりがな(めい)',
             'kana_sei' => 'ふりがな(せい)',
             'name_mei' => '名前(名)',
             'name_sei' => '名前(姓)',
             'cellular' => '電話番号',
             'email' => 'メールアドレス',
             'sex' => '性別',
             'birthday_year' => '生年月日(年)',
             'birthday_month' => '生年月日(月)',
             'birthday_day' => '生年月日(日)',
             ]);
             
        $birthday = $request->birthday_year."/".$request->birthday_month."/".$request->birthday_day;
        
        $user = User::findOrFail($user_id);
        $user-> name_sei = $request-> name_sei;
        $user-> name_mei = $request-> name_mei;
        $user-> kana_sei = $request-> kana_sei;
        $user-> kana_mei = $request-> kana_mei;
        $user-> cellular = $request-> cellular;
        $user-> email = $request-> email;
        if($request->hasFile('profile')){    
            // 拡張子つきでファイル名を取得
            $imageName = $request->file('profile')->getClientOriginalName();
            $profile = $request->file('profile')->storeAs('images',$imageName);
    
            // 拡張子のみ
            $extension = $request->file('profile')->getClientOriginalExtension();
            $user-> profile_image = $imageName;
        }
        $user-> sex = $request-> sex;
        $user-> birthday = $birthday;
        $user-> updated_at = now();
		$user-> save();
		
		return redirect('mypage')
    	->with('message','新規登録しました。（確認用なのでこの文は消す予定）')
    	;
    }
    
    public function genreEntryView()
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        
        $user = User::where('id',$user_id)->get();
        $category = Category::orderByRaw('group_name, id')->get();

        return view('genreEntry',['categorys'=> $category])
        ->with(['title' => "ジャンル登録"])
        ->with(['user' => $user])
        ->with(['user_id' => $user_id]);
       
    }
    
    public function genreEntry(Request $request)
    {
        $this->validate($request, [
            'mygenre' => 'required',
             
             ], [
             'mygenre.required' => '好みのジャンル を登録して下さい',
             ]);
        
        $user_id = $request ->userid;
        
        $user = User::findOrFail($user_id);
        $user-> mygenre1 = $request ->mygenre[0];
        if(!empty($request ->mygenre[1])){
            $user-> mygenre2 = $request ->mygenre[1];
        }
        if(!empty($request ->mygenre[2])){
            $user-> mygenre3 = $request ->mygenre[2];
        }
        $user-> updated_at = now();
		$user-> save();
		
		return redirect('genreEntry')
		->with(['title' => "ジャンル登録"])
    	->with('message','ジャンル登録しました。')
    	;
    }
    
// カレンダー機能
    private $service;

    public function __construct(CalendarService $service)
    {
        $this->service = $service;
    }
// カレンダー表示
    public function calendar()
    {
         $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        
        // ユーザーの登録ジャンル抽出
        $user = User::where('id',$user_id)->get();
        foreach($user as $row){
        $mygenre1 = $row->mygenre1;
        $mygenre2 = $row->mygenre2;
        $mygenre3 = $row->mygenre3;
        }
        // 登録ジャンルのイベント抽出
        $events = GroupEvent::where('sub_genre',$mygenre1)
                  ->orwhere('sub_genre',$mygenre2)
                  ->orwhere('sub_genre',$mygenre3)
                  ->get();
                  
        if(count($events)>0){
        foreach($events as $event){
            $eventstart[] = $event['eventdate_st'];
        }
        }else{
            $eventstart[] = "";
        }
        // /palette/app/Services/CalendarService.php
        
        return view('event', [
            // 'weeks'         => $this->service->getWeeks(),
            'weeks'         => Calendar::getWeeks($events,$eventstart),
            'month'         => Calendar::getMonth(),
            'prev'          => Calendar::getPrev(),
            'next'          => Calendar::getNext(),
        ])
        ->with(['mygenre1' => $mygenre1])
        ->with(['mygenre2' => $mygenre2])
        ->with(['mygenre3' => $mygenre3])
        ->with(['events' => $events])
        ->with(['eventstart' => $eventstart])
        ->with(['title' => "マイイベントカレンダー"]);
    }
    
    
}
