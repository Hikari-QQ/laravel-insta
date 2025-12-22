<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $message;
    private $user;

    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    public function show($id = null)
    {
        $myId = Auth::id();

        // 1. やり取りがあった人のリストを取得
        $userIds = Message::where('sender_id', $myId)
            ->orWhere('receiver_id', $myId)
            ->latest()
            ->get()
            ->map(fn($m) => $m->sender_id === $myId ? $m->receiver_id : $m->sender_id)
            ->unique()
            ->values();

        $friends = collect();
        if ($userIds->isNotEmpty()) {
            $friends = User::whereIn('id', $userIds)
                ->orderByRaw("FIELD(id, " . $userIds->implode(',') . ")")
                ->get();

            // 各ユーザーに「自分宛の未読数」をカウントして持たせる
            foreach ($friends as $friend) {
                $friend->unread_count = Message::where('sender_id', $friend->id)
                    ->where('receiver_id', $myId)
                    ->where('is_read', false)
                    ->count();
            }
        }

        $all_users = User::where('id', '!=', $myId)->get();
        $selected_user = null;
        $messages = [];

        if ($id) {
            $selected_user = User::findOrFail($id);

            // ★既読処理：この相手から自分への未読メッセージをすべて既読にする
            Message::where('sender_id', $id)
                ->where('receiver_id', $myId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            $messages = Message::where(function ($q) use ($myId, $id) {
                $q->where('sender_id', $myId)->where('receiver_id', $id);
            })->orWhere(function ($q) use ($myId, $id) {
                $q->where('sender_id', $id)->where('receiver_id', $myId);
            })->orderBy('created_at', 'asc')->get();
        }

        return view('users.messages.index', compact('friends', 'selected_user', 'messages', 'all_users'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
        ]);

        // JavaScript側にJSON形式でデータを返す
        return response()->json($message);
    }

    public function fetchMessages($id, Request $request)
    {
        $myId = Auth::id();
        $lastMessageId = $request->query('last_id'); // 画面上の最新メッセージID

        $newMessages = Message::where(function ($query) use ($myId, $id) {
            $query->where('sender_id', $id)->where('receiver_id', $myId);
        })
            ->where('id', '>', $lastMessageId) // 最新のIDより大きいものだけ取得
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($newMessages);
    }

    public function getUnreadCount()
    {
        // ログインしていない場合は0を返す（エラーを回避）
        if (!Auth::check()) {
            return response()->json(['unread_count' => 0]);
        }

        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $count]);
    }
}