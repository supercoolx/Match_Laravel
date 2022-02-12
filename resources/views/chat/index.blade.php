@extends('layout.app')

@section('content')
    <section class="content-section chat-section">
        <div class="chat-sidebar">
            <div class="chat-header">人材紹介サイトのプラットフォーム制作</div>
            <div class="my-chat"># マイチャット</div>
            <ul id="chat-users">
                @foreach($channels as $ch)
                    <li class="chat-user {{ isset($channel) ? ($ch->id == $channel->id ? 'active' : '') : '' }} {{ $ch->unread ? 'has-new-message' : '' }}">
                        <a href="{{ route('chat.channel', ['channelId' => $ch->id]) }}">
                            <img src="{{ $ch->opponent->avatar ? upload_asset($ch->opponent->avatar) : static_asset('assets/img/account.png') }}" alt="" class="chat-user-avatar object-cover-center">
                            <span>{{ $ch->opponent->name_kana }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="bottom-menu">
                <li class="chat-user">
                    <a href="{{ route('chat.setting') }}">
                        <span>メール通知設定について</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="chat-content">
            <div class="chat-content-wrapper">
                @isset($channel)
                    <div class="chat-messages" id="chat-messages">
                        @php
                            $date = null;
                            $days = array('日', '月', '火', '水', '木', '金', '土');
                        @endphp
                        @foreach($messages as $message)
                            @php
                                $created = new DateTime($message->created_at);
                                $create_date = $created->format('m月d日');
                                $create_time = $created->format('H:i');
                                $weekday = $days[date('w', strtotime($message->created_at))];
                            @endphp
                            @if($date != $create_date)
                                <div class="chat-date">
                                    <span class="rounded-pill px-3">{{ $create_date }}{{ $weekday }}</span>
                                </div>
                            @endif
                            <div class="chat-message">
                                <div class="chat-message-user">
                                    <img src="{{ $message->user_from->avatar ? upload_asset($message->user_from->avatar) : static_asset('assets/img/account.png') }}" class="avatar" alt="">
                                </div>
                                <div class="chat-message-content">
                                    <p class="chat-time">{{ $message->user_from->name }} {{ $create_time }}</p>
                                    @if($message->type == config('constants.chat.file'))
                                        @php
                                            $fileInfo = explode('|', $message->message);
                                            $imageFileTypes = ['apng','gif','ico','cur','jpg', 'jpeg','jfif', 'pjpeg', 'pjp', 'png', 'svg'];
                                        @endphp
                                        @if($fileInfo[1] && in_array($fileInfo[1], $imageFileTypes))
                                            <a href="{{ upload_asset($fileInfo[2]) }}" class="attachment-file" target="_blank">
                                                <img src="{{ upload_asset($fileInfo[2]) }}" alt="{{ $fileInfo[0] }}" class="attachment-image">
                                                <span class="attachment-name">{{ $fileInfo[0] }}</span>
                                            </a>
                                        @else
                                            <a href="{{ upload_asset($fileInfo[2]) }}" class="attachment-file" target="_blank">
                                                <span class="attachment-name">{{ $fileInfo[0] }}</span>
                                            </a>
                                        @endif
                                    @else
                                        <?= $message->message ?>
                                    @endif
                                </div>
                            </div>
                            @php
                                $date = $create_date;
                            @endphp
                        @endforeach
                    </div>
                    <div class="chat-input-box">
                        <div id="input-message"></div>
                        <div class="btn-attachment"></div>
                        <div class="btn-send"></div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ static_asset('assets/lib/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('assets/lib/ckeditor.js') }}"></script>
    <script>
        var chatEditor = null;
        let elChatMessages = null;
        const imageFileTypes = ['apng','gif','ico','cur','jpg', 'jpeg','jfif', 'pjpeg', 'pjp', 'png', 'svg'];
            
        @isset($channel)
        function scrollToChatBottom() {
            elChatMessages.scrollTop(elChatMessages.prop("scrollHeight"));
        }

        function sendMessage() {
            if(!chatEditor) {
                return false;
            }
            const message = chatEditor.getData();
            if(!message) {
                return false;
            }
            $.ajax({
                url: "{{ route('chat.send') }}",
                method: "POST",
                cache: false,
                data: {
                    'channel_id': {{ $channel->id }},
                    'message': message,
                },
                dataType: "json"
            }).done(function( response ) {
                let time = new Date()
                elChatMessages.append(
                    '<div class="chat-message">' +
                    '<div class="chat-message-user">' +
                    '<img src="{{ getAuthAvatar() }}" class="avatar" alt="">' +
                    '</div>' +
                    '<div class="chat-message-content">' + 
                    '<p class="chat-time">{{ getAuthName() }} ' + time.getHours() + ':' + time.getMinutes() + '</p>' +
                    message + '</div>' +
                    '</div>'
                );
                scrollToChatBottom();
                chatEditor.setData('');
            });
        }

        $(document).ready(function () {
            
            elChatMessages = $('#chat-messages');

            ClassicEditor.create( 
                document.querySelector( '#input-message' ), 
                {
                    alignment: {
                        options: [ 'left', 'right' ]
                    },
                    toolbar: [ 'bold', 'italic', 'bulletedList', 'blockQuote'],
                    placeholder: 'メッセージを送信する',
                }
            ).then( function (editor) {
                chatEditor = editor;
            }).catch( error => {
                console.error( error );
            });

            $('.chat-input-box .btn-send').click(function () {
                sendMessage();
                chatDropzone.processQueue();
            });

            scrollToChatBottom();

            let chatDropzone = new Dropzone("div#chat-messages", {
                url: "{{ route('chat.attachment') }}",
                // previewTemplate: document.querySelector('#attachment-preview').innerHTML,
                method: "post",
                paramName: "attachment",
                // hiddenInputContainer: "div#chat-messages",
                uploadMultiple: false,
                autoProcessQueue: false,
                clickable: true,
                maxFilesize: 20,
                // createImageThumbnails: false,
                // disablePreviews: false,
                init() {
                    elChatMessages.addClass('dropzone');
                },
                accept: function(file, done) {
                    scrollToChatBottom();
                    done();
                },
                sending: function (file, xhr, formData) {
                    formData.append("channel_id", {{ $channel->id }});
                    formData.append("_token", '{{ csrf_token() }}');
                },
                complete: function(file) {
                    chatDropzone.removeFile(file);
                    let time = new Date()
                    elChatMessages.append(
                        '<div class="chat-message">' +
                        '<div class="chat-message-user">' +
                        '<img src="{{ getAuthAvatar() }}" class="avatar" alt="">' +
                        '</div>' +
                        '<div class="chat-message-content">' + 
                        '<p class="chat-time">{{ getAuthName() }} ' + time.getHours() + ':' + time.getMinutes() + '</p>' +
                        '<a href="#" class="attachment-file"><span class="attachment-name">' + file.name + '</span></a></div>' +
                        '</div>'
                    );
                }
            });
            $('.chat-input-box .btn-attachment').click(function () {
                chatDropzone.hiddenFileInput.click();
            });
        });
        @endisset
    </script>
@endsection
