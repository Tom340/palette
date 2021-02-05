<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Groups;
use App\Members;
use App\GroupChat;
use App\MemberChat;
use App\GroupEvent;
use App\EventMember;
use App\Category;
use DB;
use Log;

class GroupController extends Controller
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
    
//----- 団体作成-------
    public function groupEntry(Request $request)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $created_userid = $login_user -> id;
        // $group_name = $request-> group_name;
        
        $this->validate($request, [
             'group_name' => 'required',
             'activity_content' => 'required',
             'established' => 'required|numeric',
             'objective' => 'required',
             'pref' => 'required',
             'city' => 'required',
             'activity_term_st' => 'required',
             'activity_term_ed' => 'required',
             'age_st' => 'required',
             'age_ed' => 'required',
             'level_st' => 'required',
             'level_ed' => 'required',
             'message' => 'required',
             'homepage' => 'url'
             ], [
             'group_name.required' => '団体名を入力して下さい',
             'activity_content.required' => '活動内容を入力して下さい',
             'established.required' => '設立年を入力して下さい',
             'established.numeric' => ':設立年は数値で入力して下さい',
             'objective.required' => '目標を入力して下さい',
             'pref.required' => '活動場所（都道府県）を入力して下さい',
             'city.required' => '活動場所（市区町）を入力して下さい',
             'activity_term_st.required' => '開始時間を入力して下さい',
             'activity_term_ed.required' => '終了時間を入力して下さい',
             'age_st.required' => '年齢を入力して下さい',
             'age_ed.required' => '年齢を入力して下さい',
             'level_st.required' => '募集レベルを入力して下さい',
             'level_ed.required' => '募集レベルを入力して下さい',
             'message.required' => ':募集メッセージを入力して下さい',
             'homepage.url' => '正しいURLを入力して下さい',
             
             ]);
             
        $groups = new Groups;
        $groups-> group_name = $request-> group_name;
        $groups-> activity_content = $request-> activity_content;
        if(!empty($request-> other_content)){
            $groups-> other_content = $request-> other_content;
        }else{
            $groups-> other_content = "";
        };
        $groups-> established = $request-> established;
        $groups-> objective = $request-> objective;
        $groups-> pref = $request-> pref;
        $groups-> city = $request-> city;
        $groups-> activity_term_st = $request-> activity_term_st;
        $groups-> activity_term_ed = $request-> activity_term_ed;
        $groups-> age_st = $request-> age_st;
        $groups-> age_ed = $request-> age_ed;
        $groups-> level_st = $request-> level_st;
        $groups-> level_ed = $request-> level_ed;
        $groups-> message = $request-> message;
        $groups-> memo = $request-> memo;
        $groups-> homepage = $request-> homepage;
        $groups-> created_userid = $created_userid;
		$groups-> save();
        
        // 団体作成と同時に代表者としてメンバー登録
        $id = $groups->id;
        
        $members = new Members;
        $members-> groupid = $id;
        $members-> userid = $created_userid;
        $members-> entry_status = 1;
        $members-> representative_status = 1;
        $members-> reading_status = 1;
		$members-> save();
        
        return redirect('/groupEntry')
        ->with('message','新規団体登録しました。');
    }
    
// ----所属団体ページ（複数表示）------
    public function mygroup(Request $request)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        
        $mygroup = Members::leftJoin('palette_groups', 'palette_group_members.groupid', '=', 'palette_groups.id')
                   ->select('palette_groups.group_name as group_name', 'palette_groups.activity_content as activity_content', 'palette_groups.created_userid as created_userid','groupid')
                   ->where('userid',$user_id)
                   ->where('entry_status',1)
                   ->get();
        return view('group.mygroup',['mygroup'=> $mygroup])
        ->with(['title' => "団体ページ"])
        ->with(['user_id' => $user_id,]);
    }
   
// ----所属団体ページ（詳細表示)------
    public function groupMenu($id)
    {
        $login_user = \Auth::user();
        
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        
        $groups = Groups::where('id',$id)->get();
        
        $member_num = Members::where('groupid',$id)
                   ->where('entry_status',1)
                   ->count();
                   
        $check = "";
        $check = Members::where('groupid',$id)
                 ->where('userid',$user_id)
                 ->get();
        return view('group.groupMenu',['groups'=> $groups])
        ->with(['member_num' => $member_num])
        ->with(['check' => $check])
        ->with(['user_id' => $user_id])
        ->with(['title' => "団体プロフィール"]);
        // ->with(['user_id' => $user_id,]);
    }

// ----所属団体ページ（複数表示）------
    public function groupMemberList($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $user_id = $login_user -> id;
        
        $groupmember = Members::leftJoin('palette_user', 'palette_group_members.userid', '=', 'palette_user.id')
                   ->select('name_sei', 'name_mei','kana_sei','kana_mei','sex','birthday','groupid','entry_status','palette_group_members.userid as userid')
                   ->where('groupid',$id)
                   ->where('entry_status',1)
                   ->get();
        return view('group.groupMemberList',['groupmember'=> $groupmember])
        ->with(['title' => "グループメンバー一覧"])
        ->with(['user_id' => $user_id,]);
    }

    
// ----所属団体プロフィール編集画面表示-----
    public function groupEdit($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        $groups = Groups::where('id',$id)->get();
        return view('group.groupEdit',['groups'=> $groups])
        ->with(['login_user' => $login_user])
        ->with(['title' => "団体プロフィール編集"]);
    }
    
// ----所属団体プロフィール編集-------
    public function groupUpdata(Request $request)
    {
        $group_id = $request->id;
        
        $this->validate($request, [
             'group_name' => 'required',
             'activity_content' => 'required',
             'established' => 'required|numeric',
             'objective' => 'required',
             'pref' => 'required',
             'city' => 'required',
             'activity_term_st' => 'required',
             'activity_term_ed' => 'required',
             'age_st' => 'required',
             'age_ed' => 'required',
             'level_st' => 'required',
             'level_ed' => 'required',
             'message' => 'required',
             'homepage' => 'url'
             ], [
             'group_name.required' => '団体名を入力して下さい',
             'activity_content.required' => '活動内容を入力して下さい',
             'established.required' => '設立年を入力して下さい',
             'established.numeric' => ':設立年は数値で入力して下さい',
             'objective.required' => '目標を入力して下さい',
             'pref.required' => '活動場所（都道府県）を入力して下さい',
             'city.required' => '活動場所（市区町）を入力して下さい',
             'activity_term_st.required' => '開始時間を入力して下さい',
             'activity_term_ed.required' => '終了時間を入力して下さい',
             'age_st.required' => '年齢を入力して下さい',
             'age_ed.required' => '年齢を入力して下さい',
             'level_st.required' => '募集レベルを入力して下さい',
             'level_ed.required' => '募集レベルを入力して下さい',
             'message.required' => ':募集メッセージを入力して下さい',
             'homepage.url' => '正しいURLを入力して下さい',
             
             ]);
             
        $groups = Groups::findOrFail($group_id);
        $groups-> group_name = $request-> group_name;
        $groups-> activity_content = $request-> activity_content;
        if(!empty($request-> other_content)){
            $groups-> other_content = $request-> other_content;
        }else{
            $groups-> other_content = "";
        };
        $groups-> established = $request-> established;
        $groups-> objective = $request-> objective;
        $groups-> pref = $request-> pref;
        $groups-> city = $request-> city;
        $groups-> activity_term_st = $request-> activity_term_st;
        $groups-> activity_term_ed = $request-> activity_term_ed;
        $groups-> age_st = $request-> age_st;
        $groups-> age_ed = $request-> age_ed;
        $groups-> level_st = $request-> level_st;
        $groups-> level_ed = $request-> level_ed;
        $groups-> message = $request-> message;
        $groups-> memo = $request-> memo;
        $groups-> homepage = $request-> homepage;
		$groups-> save();
		
		return redirect('/groupMenu/'.$group_id)
		->with(['group_id' => $group_id,])
    	->with('message','更新しました。');
    }

/*
|--------------------------------------------------------------------------
| 2) 団体メンバー関連
|--------------------------------------------------------------------------
*/

// ----団体メンバー編集画面表示---- 
     public function groupMemberView($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        $members = Members::leftJoin('palette_user', 'palette_group_members.userid', '=', 'palette_user.id')
                  ->select('palette_group_members.id as id','groupid','userid','palette_user.name_sei as user_sei','palette_user.name_mei as user_mei','entry_status','representative_status','reading_status')
                  ->where('groupid',$id)
                  ->get();
        
        $groups = Groups::where('id',$id)->get();
        
        return view('group.groupMemberEdit',['members'=> $members])
        ->with(['id'=> $id])
        ->with(['groups'=> $groups])
        ->with(['title' => "団体メンバー編集"]);
    }

// ----団体メンバー権限編集----
     public function groupMemberEdit(Request $request)
    {
       $i = 0;
       foreach($request->id as $id){
           $members = Members::findOrFail($id);
           $members-> entry_status = $request-> entry_status[$id];
           $members-> representative_status = $request-> representative_status[$id];
           $members-> reading_status = $request-> reading_status[$id];
           $members-> updated_at = now();
           $members-> save();
       }
       $group_id = $request->groupid;
       return redirect('/groupMemberEdit/'.$group_id)
        ->with(['group_id' => $group_id,])
        ->with('message','メンバー情報を更新しました。');
       
    }

// ----団体メンバー追加-----
  public function groupMemberAdd(Request $request)
    {
        $this->validate($request, [
            'mail' => 'required|email',
            ],[
             'mail.required' => 'メールアドレスを入力して下さい',
             'mail.email' => 'メールアドレスを正しく入力して下さい',
            ]);
            
        $id = $request->group;
        $mail = $request->mail;
        
        $user = User::where('email',$mail)->get();
        
        if(count($user) == 0){
            return redirect('/groupMemberEdit/'.$id)
            ->with(['id'=> $id])
            ->with(['title' => "団体メンバー編集"])
            ->with('message','このアドレスで登録しているユーザーはいません。');
        }else{
            foreach($user as $row){
            $userid = $row-> id;
            }
            $check = Members::where('userid',$userid)
                     ->where('groupid',$id)
                     ->get();
            
            if(count($check) == 0){
               $members = new Members;
               $members-> groupid = $id;
               $members-> userid = $userid;
               $members-> entry_status = 1;
               $members-> reading_status = 1;
	     	   $members-> save();
        
               return redirect('/groupMemberEdit/'.$id)
               ->with(['id'=> $id])
               ->with(['title' => "団体メンバー編集"])
               ->with('message','メンバー追加完了。');
            }else{
               return redirect('/groupMemberEdit/'.$id)
               ->with(['id'=> $id])
               ->with(['title' => "団体メンバー編集"])
               ->with('message','このアドレスは既に追加されています。');
            }
        }
    }

/*
|--------------------------------------------------------------------------
| 3) チャット関連
|--------------------------------------------------------------------------
*/

// ----グループ内チャット画面表示-----
    public function groupChatView($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        
        $members = Members::leftJoin('palette_user', 'palette_group_members.userid', '=', 'palette_user.id')
                  ->select('palette_group_members.id as id','groupid','userid','palette_user.name_sei as user_sei','palette_user.name_mei as user_mei','entry_status','representative_status','reading_status')
                  ->where('groupid',$id)
                  ->where('entry_status',1)
                  ->get();
        
        $groups = Groups::where('id',$id)->get();
        
        $group_chat = GroupChat::leftJoin('palette_user', 'palette_group_chat.userid', '=', 'palette_user.id')
                  ->select('groupid','userid','palette_user.name_sei as user_sei','palette_user.name_mei as user_mei','chat','palette_group_chat.created_at as created_at')
                  ->where('groupid',$id)
                  ->get(); 
        
        return view('group.groupChat',['members'=> $members])
        ->with(['id'=> $id])
        ->with(['user_id'=> $user_id])
        ->with(['group_chat'=> $group_chat])
        ->with(['groups'=> $groups])
        ->with(['title' => "団体メンバーチャット"]);
    }
    


// ----AJAXグループチャット表示
    public function groupChatMessage(Request $request)
    {
       $group_id = $request->id;
       $group_chat = GroupChat::leftJoin('palette_user', 'palette_group_chat.userid', '=', 'palette_user.id')
                  ->select('groupid','userid','palette_user.name_sei as user_sei','palette_user.name_mei as user_mei','chat','palette_group_chat.created_at as created_at')
                  ->where('groupid',$group_id)
                  ->get();
                  
       return response()->json($group_chat);
    }


// ----グループ内チャット登録----
    public function groupChat(Request $request)
    {
        $group_chat = new GroupChat;
        $group_chat-> groupid = $request-> groupid;
        $group_chat-> userid = $request-> userid;
        $group_chat-> chat  = $request-> chat;
		$group_chat-> save();
        
        $group_id = $request->groupid;
        
        return redirect('/groupChat/'.$group_id)
        ->with(['group_id' => $group_id,]);
    }


// ----メンバーチャット画面表示(自分発信)-----
// ----トークルームIDは被る数字になっているので要検討
    public function memberChatView($id)
    {
        $login_user = \Auth::user();

        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        $partner_id = $id;
        $talkroomid = $user_id + $id;
        
        $partner = User::where('id',$id)->get();
        
       
        // 自分発信
        $member_chat = MemberChat::where('talkroomid',$talkroomid)
                  ->Where(function ($query) {
                      $login_user = \Auth::user();
                      $user_id = $login_user-> id;
                      $query->where('userid',$user_id)
                            ->orwhere('partnerid',$user_id);
                    })
                  ->get(); 
        
        
        
        
        return view('group.memberChat',['partner'=> $partner])
        ->with(['id'=> $id])
        ->with(['user_id'=> $user_id])
        ->with(['member_chat'=> $member_chat])
        ->with(['title' => "メンバーチャット"]);
    }
    
// ----メンバーチャットリスト(自分発信分のみ表示)-----

    public function memberChatList()
    {
        $login_user = \Auth::user();
        
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        
        $partner = MemberChat::leftJoin('palette_user', 'palette_member_chat.userid', '=', 'palette_user.id')
                  ->select('talkroomid','userid','name_sei','name_mei')
                  ->where('partnerid',$user_id);
        
        $chat_list = MemberChat::leftJoin('palette_user', 'palette_member_chat.partnerid', '=', 'palette_user.id')
                  ->select('talkroomid','partnerid','name_sei','name_mei')
                  ->where('userid',$user_id)
                  ->union($partner)
                  ->distinct()
                  ->get();
                  
        return view('group.memberChatList',['chat_list'=> $chat_list])
        ->with(['user_id'=> $user_id])
        ->with(['title' => "個人間チャットリスト"]);
    }
    


// ----メンバーAJAXチャット表示

    public function memberChatMessage(Request $request)
    {
       $login_user = \Auth::user();
       $user_id = $login_user-> id;
       $partner_id = $request->id;
       $talkroomid = $user_id + $partner_id;
       
       $member_chat = MemberChat::leftJoin('palette_user', 'palette_group_chat.userid', '=', 'palette_user.id')
                  ->select('groupid','userid','palette_user.name_sei as user_sei','palette_user.name_mei as user_mei','chat','palette_group_chat.created_at as created_at')
                  ->where('talkroomid',$talkroomid)
                  ->get();
                  
       return response()->json($member_chat);
    }


// ----メンバーチャット登録----

    public function memberChat(Request $request)
    {
        $member_chat = new MemberChat;
        $member_chat-> talkroomid = $request-> partnerid + $request-> userid;
        $member_chat-> partnerid = $request-> partnerid;
        $member_chat-> userid = $request-> userid;
        $member_chat-> posterid = $request-> userid;
        $member_chat-> chat  = $request-> chat;
		$member_chat-> save();
        
        $id = $request->partnerid;
        
        return redirect('/memberChat/'.$id)
        ->with(['id' => $id,]);
    }


/*
|--------------------------------------------------------------------------
| 4) 検索・参加申請関連
|--------------------------------------------------------------------------
*/

    
// ----団体検索画面表示----
    public function groupSearchView()
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        
        return view('group.groupSearch')
        ->with(['title' => "団体・個人検索"]);
    }
    
// ----団体・個人検索----
    public function groupSearch(Request $request)
    {
        $word = $request-> word;
        if(!empty($request->case == "member")){
            
            $members = User::whereRaw('CONCAT(name_sei, "", name_mei,kana_sei, "", kana_mei) LIKE ? ', '%' . $word . '%')->get();
            return view('group.groupSearch',['members'=> $members])
            ->with(['title' => "個人検索結果"]);
            
        }elseif(!empty($request->case == "group")){
            
            $groups = Groups::where('group_name','like',"%$word%")->get();
            return view('group.groupSearch',['groups'=> $groups])
            ->with(['title' => "団体検索結果"]);
        }
    }
    
// ----検索後の団体詳細ページ表示----
    public function groupDetails($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;         
        $groups = Groups::where('id',$id)->get();
        
        $member_num = Members::where('groupid',$id)
                   ->where('entry_status',1)
                   ->count();
        
        $check = "";
        $check = Members::where('groupid',$id)
                 ->where('userid',$user_id)
                 ->get();
        
        return view('group.groupDetails',['groups'=> $groups])
        ->with(['member_num' => $member_num])
        ->with(['user_id' => $user_id])
        ->with(['check' => $check])
        ->with(['title' => "団体詳細"]);
        
    }
    
//----参加申請-----
    public function groupMemberEntry(Request $request)
    {
        
        $user_id = $request-> userid;
        $group_id = $request-> groupid;
        
        $members = new Members;
        $members-> groupid = $group_id;
        $members-> userid = $user_id;
		$members-> save();
        
        
        return redirect('/groupDetails/'.$group_id)
        ->with('message','団体に参加申請しました。');
        
    }
    
    
    
/*
|--------------------------------------------------------------------------
| 5) イベント関連
|--------------------------------------------------------------------------
*/

// -----イベント登録----
   public function groupEventEntryView($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        $group_name = Category::select("group_name")->distinct()->get();
        
        return view('group.groupEventEntry',['id'=> $id])
         ->with(['user_id' => $user_id])
         ->with(['group_name' => $group_name])
         ->with(['title' => "団体イベント登録"]);
        
    }

    
    public function groupEventEntry(Request $request)
    {
        $user_id = $request->userid;
        $group_id = $request->groupid;
        
        $this->validate($request, [
             'event_name' => 'required',
             'overview' => 'required',
             'genre' => 'required',
             'eventdate_st' => 'required',
             'capacity' => 'required|numeric',
             'recruitdate_st' => 'required',
             'event_info' => 'required',
             'place_name' => 'required',
             'pref' => 'required',
             'city' => 'required',
             'place_url' => 'url'
             ], [
             'event_name.required' => '団体名を入力して下さい',
             'overview.required' => '活動内容を入力して下さい',
             'genre.required' => 'ジャンルを入力して下さい',
             'eventdate_st.required' => '開催開始日を入力して下さい',
             'recruitdate_st.required' => '募集開始日を入力して下さい',
             'capacity.numeric' => ':定員は数値で入力して下さい',
             'capacity.required' => '定員を入力して下さい',
             'pref.required' => '開催場所（都道府県）を入力して下さい',
             'city.required' => '開催場所（市区町）を入力して下さい',
             'place_name.required' => '会場名を入力して下さい',
             'event_info.required' => 'イベント案内文を入力して下さい',
             'place_url.url' => '正しいURLを入力して下さい',
             
             ]);
        
        $mimeType="";
        $base64="";
        $imageName="";
        // 画像の処理
        if($request->hasFile('event_img')){    
            // 拡張子つきでファイル名を取得
            $imageName = $request->event_img->getClientOriginalName();
            // storage/app/../../imagesに画像を一時保存(=/var/www/palette/palette/images)
            $profile = $request->event_img->storeAs('images',$imageName);
    
            // 拡張子のみ
            $extension = $request->event_img->getClientOriginalExtension();
    
            $mimeType = Storage::mimeType('images/'.$imageName);
            $contents = Storage::disk('images')->get($imageName);
            $base64 = base64_encode($contents);
        }        
        
        
        
        $event = new GroupEvent;
        $event-> event_name = $request-> event_name;
        $event-> overview = $request-> overview;
        $event-> genre = $request-> genre;
        $event-> sub_genre = $request-> category2;
        $event-> event_form = $request-> event_form;
        $event-> paid = $request-> paid;
        $event-> eventdate_st = $request-> eventdate_st;
        $event-> eventtime_st = $request-> eventtime_st;
        $event-> eventdate_ed = $request-> eventdate_ed;
        $event-> eventtime_ed = $request-> eventtime_ed;
        $event-> capacity = $request-> capacity;
        $event-> recruitdate_st = $request-> recruitdate_st;
        $event-> recruittime_st = $request-> recruittime_st;
        $event-> recruitdate_ed = $request-> recruitdate_ed;
        $event-> recruittime_ed = $request-> recruittime_ed;
        $event-> event_img = $imageName;
        $event-> event_info = $request-> event_info;
        $event-> place_name = $request-> place_name;
        $event-> place_url = $request-> place_url;
        $event-> country = $request-> country;
        $event-> pref = $request-> pref;
        $event-> city = $request-> city;
        $event-> building = $request-> building;
        $event-> groupid = $group_id;
        $event-> created_userid = $user_id;
		$event-> save();
		
		 // イベント作成と同時に代表者としてメンバー登録
        $id = $event->id;
        
        $members = new EventMember;
        $members-> eventid = $id;
        $members-> groupid = $group_id;
        $members-> userid = $user_id;
        $members-> entry_status = 1;
        $members-> representative_status = 1;
		$members-> save();
		
		$group_name = Category::select("group_name")->distinct()->get();
		
		return redirect('/groupMenu/'.$group_id)
		->with(['group_name' => $group_name])
		->with('message','イベントに新規作成しました。');;
    }
    
// ----イベント一覧---
    public function groupEventList($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        
        $groups = Groups::where('id',$id)->get();
        
        $events = GroupEvent::where('groupid',$id)
                   ->where('public_status',0)
                   ->get();
        
        return view('group.groupEventList',['id'=> $id])
         ->with(['user_id' => $user_id])
         ->with(['events' => $events])
         ->with(['groups' => $groups])
         ->with(['title' => "団体イベント一覧"]);
        
    }

// ----イベント詳細(管理者画面)
   public function groupEventMenu($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        
        $events = GroupEvent::find($id);
        $base64="";
        $mimeType = "";
        if ($events->event_img) {
            $mimeType = Storage::mimeType('images/'.$events->event_img);
            $contents = Storage::disk('images')->get($events->event_img);
            //Log::debug('Storage image realpath'.$contents);
            $base64 = base64_encode($contents);
        }
        $member_num = EventMember::where('eventid',$id)
         ->where('entry_status',1)
         ->count();
        
        $check = "";
        $check = EventMember::where('eventid',$id)
         ->where('userid',$user_id)
         ->get();
        
        $events = GroupEvent::where('id',$id)->get();
        return view('group.groupEventMenu',['id'=> $id])
         ->with(['check' => $check])
         ->with(['member_num' => $member_num])
         ->with(['user_id' => $user_id])
         ->with(['events' => $events])
         ->with(['mimetype' => $mimeType])
         ->with(['base64' => $base64])
         ->with(['title' => "団体イベント詳細"]);
        
    }

// ----イベントメンバー編集画面表示---- 
     public function eventMemberView($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        $members = EventMember::leftJoin('palette_user', 'palette_event_member.userid', '=', 'palette_user.id')
                  ->select('palette_event_member.id as id','groupid','userid','palette_user.name_sei as user_sei','palette_user.name_mei as user_mei','palette_user.sex as user_sex','palette_user.birthday as user_birthday','entry_status','representative_status')
                  ->where('eventid',$id)
                  ->get();
        
        $events = GroupEvent::where('id',$id)->get();
        
        return view('group.eventMemberEdit',['members'=> $members])
        ->with(['id'=> $id])
        ->with(['events'=> $events])
        ->with(['title' => "イベントメンバー編集"]);
    }
    
// ---イベント参加者編集
     public function eventMemberEdit(Request $request)
    {
       $i = 0;
       foreach($request->id as $id){
           $members = EventMember::findOrFail($id);
           $members-> entry_status = $request-> entry_status[$id];
           $members-> representative_status = $request-> representative_status[$id];
           $members-> updated_at = now();
           $members-> save();
       }
       $event_id = $request->eventid;
       return redirect('/eventMemberEdit/'.$event_id)
        ->with(['event_id' => $event_id,])
        ->with('message','イベントメンバー情報を更新しました。');
       
    }

// ----イベントメンバー追加-----
  public function eventMemberAdd(Request $request)
    {
        $this->validate($request, [
            'mail' => 'required|email',
            ],[
             'mail.required' => 'メールアドレスを入力して下さい',
             'mail.email' => 'メールアドレスを正しく入力して下さい',
            ]);
            
        $id = $request->group;
        $mail = $request->mail;
        
        $user = User::where('email',$mail)->get();
        
        if(count($user) == 0){
            return redirect('/groupMemberEdit/'.$id)
            ->with(['id'=> $id])
            ->with(['title' => "団体メンバー編集"])
            ->with('message','このアドレスで登録しているユーザーはいません。');
        }else{
            foreach($user as $row){
            $userid = $row-> id;
            }
            $check = Members::where('userid',$userid)
                     ->where('groupid',$id)
                     ->get();
            
            if(count($check) == 0){
               $members = new Members;
               $members-> groupid = $id;
               $members-> userid = $userid;
               $members-> entry_status = 1;
               $members-> reading_status = 1;
	     	   $members-> save();
        
               return redirect('/groupMemberEdit/'.$id)
               ->with(['id'=> $id])
               ->with(['title' => "団体メンバー編集"])
               ->with('message','メンバー追加完了。');
            }else{
               return redirect('/groupMemberEdit/'.$id)
               ->with(['id'=> $id])
               ->with(['title' => "団体メンバー編集"])
               ->with('message','このアドレスは既に追加されています。');
            }
        }
    }
 
 
    
// ----イベント編集
    public function groupEventEdit($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        $events = GroupEvent::find($id);
        $base64="";
        $mimeType = "";
        if ($events->event_img) {
            $mimeType = Storage::mimeType('images/'.$events->event_img);
            $contents = Storage::disk('images')->get($events->event_img);
            //Log::debug('Storage image realpath'.$contents);
            $base64 = base64_encode($contents);
        }        
        $events = GroupEvent::where('id',$id)->get();
        
        return view('group.groupEventEdit',['id'=> $id])
         ->with(['user_id' => $user_id])
         ->with(['events' => $events])
         ->with(['mimetype' => $mimeType])
         ->with(['base64' => $base64])
         ->with(['title' => "イベント内容編集"]);
    }
    public function groupEventUpdata(Request $request)
    {
        
        $this->validate($request, [
             'event_name' => 'required',
             'overview' => 'required',
             'genre' => 'required',
             'eventdate_st' => 'required',
             'capacity' => 'required|numeric',
             'recruitdate_st' => 'required',
             'event_info' => 'required',
             'place_name' => 'required',
             'pref' => 'required',
             'city' => 'required',
             'place_url' => 'url'
             ], [
             'event_name.required' => '団体名を入力して下さい',
             'overview.required' => '活動内容を入力して下さい',
             'genre.required' => 'ジャンルを入力して下さい',
             'eventdate_st.required' => '開催開始日を入力して下さい',
             'recruitdate_st.required' => '募集開始日を入力して下さい',
             'capacity.numeric' => ':定員は数値で入力して下さい',
             'capacity.required' => '定員を入力して下さい',
             'pref.required' => '開催場所（都道府県）を入力して下さい',
             'city.required' => '開催場所（市区町）を入力して下さい',
             'place_name.required' => '会場名を入力して下さい',
             'event_info.required' => 'イベント案内文を入力して下さい',
             'place_url.url' => '正しいURLを入力して下さい',
             ]);
             
        $mimeType="";
        $base64="";
        $imageName="";
        // 画像の処理
        if($request->hasFile('event_img')){    
            // 拡張子つきでファイル名を取得
            $imageName = $request->event_img->getClientOriginalName();
            // storage/app/../../imagesに画像を一時保存(=/var/www/palette/palette/images)
            $profile = $request->event_img->storeAs('images',$imageName);
    
            // 拡張子のみ
            $extension = $request->event_img->getClientOriginalExtension();
    
            $mimeType = Storage::mimeType('images/'.$imageName);
            $contents = Storage::disk('images')->get($imageName);
            $base64 = base64_encode($contents);
        }        
        
        $eventid = $request->id;
        
        $event = GroupEvent::findOrFail($eventid);
        $event-> event_name = $request-> event_name;
        $event-> overview = $request-> overview;
        $event-> genre = $request-> genre;
        $event-> sub_genre = $request-> sub_genre;
        $event-> event_form = $request-> event_form;
        $event-> paid = $request-> paid;
        $event-> eventdate_st = $request-> eventdate_st;
        $event-> eventtime_st = $request-> eventtime_st;
        $event-> eventdate_ed = $request-> eventdate_ed;
        $event-> eventtime_ed = $request-> eventtime_ed;
        $event-> capacity = $request-> capacity;
        $event-> recruitdate_st = $request-> recruitdate_st;
        $event-> recruittime_st = $request-> recruittime_st;
        $event-> recruitdate_ed = $request-> recruitdate_ed;
        $event-> recruittime_ed = $request-> recruittime_ed;
        $event-> event_img = $imageName;
        $event-> event_info = $request-> event_info;
        $event-> place_name = $request-> place_name;
        $event-> place_url = $request-> place_url;
        $event-> country = $request-> country;
        $event-> pref = $request-> pref;
        $event-> city = $request-> city;
        $event-> building = $request-> building;
		$event-> save();
		
		return redirect('/groupEventMenu/'.$eventid)
    	->with('message','更新しました。');
    }

// ----イベント検索
    public function groupEventSearchView()
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        
        $group_name = Category::select("group_name")->distinct()->get();
        
        return view('group.groupEventSearch')->with([
             'user_id' => $user_id,
             'title' => "イベント検索",
             'group_name' => $group_name
        ]);
    }

    public function groupEventSearch(Request $request)
    {
       
        $date = $request->eventdate;
        $sub_genre = $request->category2;
        $pref = $request->pref;
        
        \DB::enableQueryLog();
        $group_name = Category::select("group_name")->distinct()->get();
        
        $events = GroupEvent::leftJoin('palette_groups', 'palette_group_event.groupid', '=', 'palette_groups.id')
                  ->select('event_name','genre','sub_genre','capacity','palette_group_event.pref as pref','event_img','eventdate_st','eventdate_ed','groupid','group_name')
                  ->get();
                  
        $sql = "SELECT palette_group_event.id,event_name,genre,sub_genre,capacity, palette_group_event.pref as pref,event_img, eventdate_st, eventdate_ed, groupid, group_name FROM palette_group_event left join palette_groups on palette_group_event.groupid = palette_groups.id";

        $where = 0;       
        if ($date) {
            if (!$where) {
                $sql .= " where ";
                $where = 1;
            } else {
                $sql .= " and ";
            }
            $sql .= "eventdate_st <= '".$date."' and eventdate_ed >= '".$date."'";
        }
        if ($sub_genre) {
            if (!$where) {
                $sql .= " where ";
                $where = 1;
            } else {
                $sql .= " and ";
            }
            $sql .= "sub_genre = '".$sub_genre."'";
        }
        if ($pref) {
            if (!$where) {
                $sql .= " where ";
                $where = 1;
            } else {
                $sql .= " and ";
            }
            $sql .= "pref = '".$pref."'";
        }
        //Log::debug('SQL:'.$sql);
        $events = DB::select($sql);
        
        return view('group.groupEventSearch',['events'=> $events])
            ->with(['group_name' => $group_name])
            ->with(['title' => "団体検索結果"]);
        
    }
    
    public function groupEventSearchCategory(Request $request)
    {
       $group = $request->group;
       $vategory = Category::select("category_name")->where("group_name", $group)->get();

       return response()->json($vategory);
        
    }
    
// ----検索後の詳細（ユーザー参加申請用）
    public function groupEventDetails($id)
    {
        $login_user = \Auth::user();
        if(!$login_user){
            return redirect('/')
                    ->with('error_message','エラーが発生しました。');
        }
        $user_id = $login_user-> id;
        $events = GroupEvent::find($id);
        $base64="";
        $mimeType = "";
        if ($events->event_img) {
            $mimeType = Storage::mimeType('images/'.$events->event_img);
            $contents = Storage::disk('images')->get($events->event_img);
            //Log::debug('Storage image realpath'.$contents);
            $base64 = base64_encode($contents);
        }        
        $events = GroupEvent::where('id',$id)->get();
        
        $member_num = EventMember::where('eventid',$id)
         ->where('entry_status',1)
         ->count();
        
        $check = "";
        $check = EventMember::where('eventid',$id)
         ->where('userid',$user_id)
         ->get();
        
        return view('group.groupEventDetails',['id'=> $id])
         ->with(['check' => $check])
         ->with(['member_num' => $member_num])
         ->with(['user_id' => $user_id])
         ->with(['events' => $events])
         ->with(['mimetype' => $mimeType])
         ->with(['base64' => $base64])
         ->with(['title' => "団体イベント詳細"]);
    }

// ----イベント参加申請
     public function eventMemberEntry(Request $request)
    {
        $event_id = $request-> eventid;
        $user_id = $request-> userid;
        $group_id = $request-> groupid;
        
        $members = new EventMember;
        $members-> eventid = $event_id;
        $members-> groupid = $group_id;
        $members-> userid = $user_id;
		$members-> save();
        
        
        return redirect('/groupEventDetails/'.$event_id)
        ->with('message','イベントに参加申請しました。');
    }
}
