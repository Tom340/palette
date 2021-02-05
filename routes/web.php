<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| 1) User ログイン前
|--------------------------------------------------------------------------
*/
Route::get('/top', function () { return view('topimage'); });
Route::get('/', function () { return view('top'); });

// ユーザー新規登録
Route::get('/entry', [UserController::class, 'index']);
Route::post('/entry', [UserController::class, 'register']);

// ユーザー登録確認
Route::post('/confirm', [UserController::class, 'confirm']);
// ユーザー登録
Route::post('/complete', [UserController::class, 'registUser']);


/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/

Route::get('/mypage', [UserController::class, 'mypage']);
Route::post('/mypage', [UserController::class, 'mypage']);
// ユーザープロフィール編集
Route::get('/user_edit', [UserController::class, 'editUserView']);
Route::post('/user_edit', [UserController::class, 'editUser']);
// イベントカレンダー
Route::get('/event', [UserController::class, 'calendar']);
// マイジャンル登録
Route::get('/genreEntry', [UserController::class, 'genreEntryView']);
Route::post('/genreEntry', [UserController::class, 'genreEntry']);


Route::get('/logout', [UserController::class, 'logout']);




/*
|--------------------------------------------------------------------------
| 3) 団体関連
|--------------------------------------------------------------------------
*/

Route::get('/groupEntry', function () { return view('group.groupEntry')->with([
            'title' => "新規団体登録入力"]); });
Route::post('/groupEntry', [GroupController::class, 'groupEntry']);


// ------マイグループ関連------------
// 団体ページ
Route::get('/mygroup', [GroupController::class, 'mygroup']);

// 所属団体詳細
Route::get('/groupMenu/{id}', [GroupController::class, 'groupMenu']);
// Route::post('/groupMenu', [GroupController::class, 'groupMenu']);

// 団体プロフィール編集
Route::get('/groupEdit/{id}', [GroupController::class, 'groupEdit']);
Route::post('/groupEdit', [GroupController::class, 'groupUpdata']);

// 団体メンバー編集
Route::get('/groupMemberEdit/{id}', [GroupController::class, 'groupMemberView']);
Route::post('/groupMemberEdit', [GroupController::class, 'groupMemberEdit']);

// 団体メンバー追加
Route::get('/groupMemberAdd', [GroupController::class, 'groupMemberAdd']);
//Route::get('/groupMemberAdd/{mail}/{{id}}', [GroupController::class, 'groupMemberAdd']);

// 団体メンバー一覧
Route::get('/groupMemberList/{id}', [GroupController::class, 'groupMemberList']);
// グループ内チャット
Route::get('/groupChat/{id}', [GroupController::class, 'groupChatView']);
Route::get('/groupChatMessage', [GroupController::class, 'groupChatMessage']);
Route::post('/groupChat', [GroupController::class, 'groupChat']);

// 個人間チャット
Route::get('/memberChatList', [GroupController::class, 'memberChatList']);
Route::get('/memberChat/{id}', [GroupController::class, 'memberChatView']);
Route::get('/memberChatMessage', [GroupController::class, 'memberChatMessage']);
Route::post('/memberChat', [GroupController::class, 'memberChat']);


// -------団体検索関連----------------
// 団体検索
Route::get('/groupSearch', [GroupController::class, 'groupSearchView']);
Route::post('/groupSearch', [GroupController::class, 'groupSearch']);

// 検索結果詳細
Route::get('/groupDetails/{id}', [GroupController::class, 'groupDetails']);

// 参加申請
Route::post('/groupDetails', [GroupController::class, 'groupMemberEntry']);







/*
|--------------------------------------------------------------------------
| 4) イベント関連
|--------------------------------------------------------------------------
*/

// イベント登録
// Route::get('/groupEventEntry/{id}', [GroupController::class, 'groupDetails']);
Route::get('/groupEventEntry/{id}', [GroupController::class, 'groupEventEntryView']);  
Route::post('/groupEventEntry', [GroupController::class, 'groupEventEntry']); 

// イベント一覧
Route::get('/groupEventList/{id}', [GroupController::class, 'groupEventList']); 


// イベント詳細（管理者）
Route::get('/groupEventMenu/{id}', [GroupController::class, 'groupEventMenu']);  
// Route::post('/groupEventMenu', [GroupController::class, 'groupEventMenu']); 

// イベント更新
Route::get('/groupEventEdit/{id}', [GroupController::class, 'groupEventEdit']);  
Route::post('/groupEventEdit', [GroupController::class, 'groupEventUpdata']);  

// イベント検索
Route::get('/groupEventSearch', [GroupController::class, 'groupEventSearchView']);  
Route::post('/groupEventSearch', [GroupController::class, 'groupEventSearch']);
Route::get('/groupEventSearchCategory', [GroupController::class, 'groupEventSearchCategory']);

// イベント詳細(参加申請用)
Route::get('/groupEventDetails/{id}', [GroupController::class, 'groupEventDetails']); 
Route::post('/groupEventDetails', [GroupController::class, 'eventMemberEntry']); 

// イベントメンバー編集
Route::get('/eventMemberEdit/{id}', [GroupController::class, 'eventMemberView']);
Route::post('/eventMemberEdit', [GroupController::class, 'eventMemberEdit']);

// イベントメンバー追加
Route::get('/eventMemberAdd', [GroupController::class, 'groupMemberAdd']);


\URL::forceScheme('https');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
