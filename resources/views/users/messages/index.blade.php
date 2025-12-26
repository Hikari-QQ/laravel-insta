@extends('layouts.app')

@section('title', 'Direct Messages')

@section('content')
    <style>
        /* --- メインレイアウト --- */
        .dm-container {
            display: flex;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            height: 80vh;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* 左側エリア */
        .user-list {
            width: 320px;
            min-width: 320px;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.5);
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* 右側エリア */
        .chat-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* ヘッダー共通 */
        .chat-header,
        .user-list-header {
            height: 70px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* --- ユーザーリストのデザイン（メイン・モーダル共通） --- */
        .user-list-content {
            flex-grow: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            /* align-items: stretch; はデフォルトなのでなくても大丈夫ですが、明示的に */
        }

        .user-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            text-decoration: none !important;
            transition: all 0.2s;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            /* 横幅いっぱい */
            border-radius: 0;
            /* 角丸なし */
            margin: 0;
            /* 余白なし */
        }

        /* ホバー時とアクティブ時の色 */
        .user-item:hover,
        .user-item.active {
            background-color: #FBEFEF !important;
            /* importantをつけてモーダルでも適用 */
        }

        /* --- 各パーツのデザイン --- */
        .user-name {
            font-weight: bold;
            font-size: 1rem;
        }

        .avatar-md {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
        }

        .icom-md {
            font-size: 45px;
            color: #ff85a2;
            opacity: 0.8;
        }

        .fa-square-plus:hover {
            transform: scale(1.1);
            opacity: 0.7;
        }

        /* --- メッセージエリア --- */
        .chat-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 25px;
            display: flex;
            flex-direction: column;
        }

        .message-bubble {
            max-width: 75%;
            padding: 10px 18px;
            border-radius: 20px;
            margin-bottom: 12px;
            word-wrap: break-word;
        }

        .message-sent {
            background-color: #BFEAF2;
            align-self: flex-end;
            color: #4A4A4A;
            border-bottom-right-radius: 4px;
        }

        .message-received {
            background-color: #fff;
            align-self: flex-start;
            color: #6f6f6f;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .chat-input-area {
            padding: 15px 25px;
            background-color: rgba(255, 255, 255, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn-send {
            background-color: #ff85a2;
            color: white;
            border-radius: 50px;
            border: none;
            padding: 0 25px;
        }

        .unread-dot {
            width: 10px;
            height: 10px;
            background-color: #ff85a2;
            /* メインのピンク色 */
            border-radius: 50%;
            display: inline-block;
            margin-left: auto;
            /* 右端に寄せる */
            box-shadow: 0 0 5px rgba(255, 133, 162, 0.5);
        }

        /* タイトル装飾：下線なし・水色ハート */
        .suggestion-title-text {
            color: #F08FB3; /* ピンクの文字 */
            font-weight: bold;
            text-decoration: none !important; /* 下線を消去 */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        /* ハートの色：水色 */
        .icon-blue-light {
            color: #BFEAF2;
        }
    </style>

    <div class="container">
        <div class="dm-container shadow-sm">
            <div class="user-list">
                <div class="user-list-header d-flex justify-content-between align-items-center">
                    <div style="width: 1.4rem;"></div>
                    <div class="suggestion-title-text">
                        <i class="fa-solid fa-heart icon-blue-light"></i>
                        <h6 class="mb-0 fw-bold" style="color: #F08FB3;">@translate('Messages')</h6>
                        <i class="fa-solid fa-heart icon-blue-light"></i>
                    </div>
                    <button type="button" class="btn p-0 border-0" data-bs-toggle="modal" data-bs-target="#newUserModal"
                        title="New Message">
                        <i class="fa-regular fa-square-plus"
                            style="color: #ff85a2; font-size: 1.4rem; transition: 0.3s;"></i>
                    </button>
                </div>

                <div class="user-list-content">
                    @foreach ($friends as $friend)
                        <a href="{{ route('message.show', $friend->id) }}"
                            class="user-item {{ isset($selected_user) && $selected_user->id == $friend->id ? 'active' : '' }}">
                            <div class="me-3 position-relative">
                                @if ($friend->avatar)
                                    <img src="{{ $friend->avatar }}" class="avatar-md">
                                @else
                                    <i class="fa-solid fa-circle-user icom-md"></i>
                                @endif
                            </div>
                            <div class="text-truncate flex-grow-1">
                                <span class="user-name text-dark">{{ $friend->name }}</span>
                            </div>

                            {{-- 未読がある場合のみドットを表示 --}}
                            @if($friend->unread_count > 0)
                                <span class="unread-dot"></span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="chat-area">
                @if(isset($selected_user))
                    <div class="chat-header">
                        <h6 class="mb-0 fw-bold" style="color: #C9B3E0;">{{ $selected_user->name }}</h6>
                    </div>

                    <div class="chat-messages" id="chat-box">
                        @forelse($messages as $msg)
                            <div class="message-bubble {{ $msg->sender_id == auth()->id() ? 'message-sent' : 'message-received' }}"
                                data-id="{{ $msg->id }}">
                                {{ $msg->body }}
                            </div>
                        @empty
                            <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                <i class="fa-regular fa-paper-plane mb-3"
                                    style="font-size: 3rem; color: #ff85a2; opacity: 0.3;"></i>
                                <p class="small">@translate('No messages yet')</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="chat-input-area">
                        <form id="chat-form" class="d-flex h-100">
                            @csrf
                            <input type="hidden" id="receiver_id" value="{{ $selected_user->id }}">
                            <input type="text" id="message-body" class="form-control border-0 rounded-pill me-2 shadow-sm px-3"
                                placeholder="@translate('Add a message')…♡" required autocomplete="off">
                            <button type="submit" id="send-btn" class="btn btn-send shadow-sm fw-bold">Send</button>
                        </form>
                    </div>
                @else
                    <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                        <div class="text-center">
                            <i class="fa-regular fa-paper-plane mb-3"
                                style="font-size: 3.5rem; color: #ff85a2; opacity: 0.4;"></i>
                            <p>@translate('Choose who to message')</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="newUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content"
                style="border-radius: 20px; border: none; background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(15px); overflow: hidden;">
                <div class="modal-header border-bottom-0 pb-3 pt-3">
                    <h5 class="modal-title fw-bold mx-auto" style="color: #F08FB3; padding-left: 1.5rem;">@translate('New Message')</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($all_users as $user)
                            @php
                                // モーダル用にも未読数を取得（全ユーザーを取得しているのでここで計算）
                                $unread = \App\Models\Message::where('sender_id', $user->id)
                                            ->where('receiver_id', auth()->id())
                                            ->where('is_read', false)
                                            ->count();
                            @endphp
                            <a href="{{ route('message.show', $user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center user-item border-0">
                                <div class="me-3">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" class="avatar-md" style="width: 40px; height: 40px;">
                                    @else
                                        <i class="fa-solid fa-circle-user icom-md" style="font-size: 40px;"></i>
                                    @endif
                                </div>
                                <span class="user-name flex-grow-1">{{ $user->name }}</span>

                                @if($unread > 0)
                                    <span class="unread-dot"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // (JavaScript部分は変更なしなので省略せずそのまま載せます)
        document.addEventListener('DOMContentLoaded', function () {
            const chatForm = document.getElementById('chat-form');
            const chatBox = document.getElementById('chat-box');
            const receiverId = document.getElementById('receiver_id')?.value;
            let lastMessageId = 0;

            const scrollToBottom = () => {
                if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
            };

            const updateLastMessageId = () => {
                const messages = chatBox.querySelectorAll('.message-bubble');
                if (messages.length > 0) {
                    lastMessageId = messages[messages.length - 1].dataset.id;
                }
            };

            const appendMessage = (message, type) => {
                if (document.querySelector(`[data-id="${message.id}"]`)) return;

                const div = document.createElement('div');
                div.classList.add('message-bubble', type === 'sent' ? 'message-sent' : 'message-received');
                div.dataset.id = message.id;
                div.textContent = message.body;

                if (chatBox.querySelector('.text-muted')) chatBox.innerHTML = '';

                chatBox.appendChild(div);
                scrollToBottom();
                lastMessageId = message.id;
            };

            if (chatBox) {
                updateLastMessageId();
                scrollToBottom();
            }

            if (chatForm) {
                chatForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const bodyInput = document.getElementById('message-body');
                    const body = bodyInput.value;
                    if (!body.trim()) return;

                    fetch("{{ route('message.send') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ receiver_id: receiverId, body: body })
                    })
                        .then(res => res.json())
                        .then(data => {
                            // メッセージ送信に成功したら画面をリロード
                            // これにより左側のリストが更新され、新しい相手が表示されます
                            window.location.reload();
                        });
                });

                setInterval(() => {
                    fetch(`/message/fetch/${receiverId}?last_id=${lastMessageId}`)
                        .then(res => res.json())
                        .then(newMessages => {
                            newMessages.forEach(msg => appendMessage(msg, 'received'));
                        });
                }, 3000);
            }
        });
    </script>
@endsection