@extends('layout.app')

@section('content')
    <section class="content-section chat-section">
        <div class="chat-sidebar">
            <div class="chat-header">人材紹介サイトのプラットフォーム制作</div>
            <div class="my-chat"># マイチャット</div>
            <ul id="chat-users">
            </ul>
        </div>
        <div class="chat-content">
            @if($channelId)
                <div class="chat-content-wrapper">
                    <div class="chat-messages" id="chat-messages">
                        <div class="chat-message">
                            <div class="chat-message-user">
                                <img src="{{ $friend->avatar ? upload_asset($friend->avatar) : static_asset('assets/img/account.png') }}" class="avatar" alt="">
                                <span>{{ $friend->name }}</span>
                            </div>
                            <div class="chat-message-content">
                                <div class="welcome-message">
                                    <p>成島 様</p>
                                    <p>はじめまして。山田と申します。</p>
                                    <p>下記案件について、お話を伺いたくご連絡しました。
                                        ご確認お願いいたします。</p>
                                </div>
                                <div class="project-detail">
                                    <div class="project-detail-item">
                                        <p>求人・案件名</p>
                                        <p>{{ $project->name }}</p>
                                    </div>
                                    <div class="project-detail-item">
                                        <p>氏名</p>
                                        <p>{{ $friend->name }}</p>
                                    </div>
                                    <div class="project-detail-item">
                                        <p>氏名(カナ)</p>
                                        <p>{{ $friend->name_kana }}</p>
                                    </div>
                                    <div class="project-detail-item">
                                        <p>電話番号</p>
                                        <p>{{ $friend->phone }}</p>
                                    </div>
                                    <div class="project-detail-item">
                                        <p>メールアドレス</p>
                                        <p>{{ $friend->email }}</p>
                                    </div>
                                    <div class="project-detail-item">
                                        <p>質問事項</p>
                                    </div>
                                    <div class="project-detail-divider"></div>
                                    <p class="message-forward">以上、ご連絡お待ちしております。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-input-box">
                        <div id="input-message"></div>
                        <div class="btn-attachment"></div>
                        <div class="btn-send"></div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script type="text/html" id="attachment-preview">
        <div class="dz-preview dz-file-preview">
            <div class="dz-details">
                <div class="dz-filename"><span data-dz-name></span></div>
                <div class="dz-size" data-dz-size></div>
                <img data-dz-thumbnail />
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="dz-success-mark"><span>✔</span></div>
            <div class="dz-error-mark"><span>✘</span></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
        </div>
    </script>
    <script src="{{ static_asset('assets/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('assets/js/ckeditor.js') }}"></script>
    <script>
        var chatEditor = null;
        ClassicEditor
            .create( document.querySelector( '#input-message' ) , {
                alignment: {
                    options: [ 'left', 'right' ]
                },
                toolbar: [ 'bold', 'italic', 'bulletedList', 'blockQuote'],
                placeholder: 'メッセージを送信する',
            })
            .then( function (editor ) {
                chatEditor = editor;
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        const channelTimeInterval = 3000;
        const messageTimeInterval = 1000;
        const user = <?php echo json_encode($user); ?>;
        const friend = <?php echo json_encode($friend); ?>;
        let channelTimer = 0;
        let messageTimer = 0;
        let latestMessageId = 0;
        let elChatMessages = null;
        const imageFileTypes = ['apng','gif','ico','cur','jpg', 'jpeg','jfif', 'pjpeg', 'pjp', 'png', 'svg'];
        const videoFiles = ['mp4','webm','ogg'];

        function getChannels() {
            $.ajax({
                url: "{{ route('chat.channels') }}",
                method: "GET",
                cache: false,
                dataType: "json"
            })
                .done(function( response ) {
                    if(response.success) {
                        $('#chat-users').html('');
                        response.channels.forEach(function (channel) {
                            const avatar = channel.avatar ? ('{{ upload_asset('') }}/' + channel.avatar) : '{{ static_asset('assets/img/avatar/default.png') }}';
                            const activeClass = channel.friend_id == {{ $friendId }} ? 'active' : '';
                            const unreadClass = channel.unread > 0 ? 'has-new-message' : '';
                            $('#chat-users').append('<li class="chat-user ' + activeClass + ' ' + unreadClass + '"><a href="{{ route('chat.index') }}/' + channel.id + '"><img src="' + avatar + '" alt="" class="chat-user-avatar object-cover-center"> <span>' + channel.name + '</span></a></li>');
                        });
                    }
                });
        }
        @if($channelId && $friendId)
            function getMessages() {
                $.ajax({
                    url: "{{ route('chat.messages', ['channelId' => $channelId]) }}",
                    method: "GET",
                    data: {
                        latest: latestMessageId
                    },
                    cache: false,
                    dataType: "json"
                })
                    .done(function( response ) {
                        if(response.success) {
                            if(response.messages.length > 0) {
                                latestMessageId = response.messages[response.messages.length - 1].id;
                            }
                            if(elChatMessages) {
                                response.messages.forEach(function (message) {
                                    let chatUser = message.from == user.id ? user : friend;
                                    let messageContent = message.message;
                                    if (message.type === '{{ config("constants.chat.file") }}') {
                                        const fileInfo = messageContent.split('|');
                                        if (fileInfo[1] && imageFileTypes.includes(fileInfo[1])) {
                                            messageContent = '<a href="' + '{{ upload_asset('') }}/' + fileInfo[2] + '" class="attachment-file" target="_blank">' +
                                                '<img src="' + '{{ upload_asset('') }}/' + fileInfo[2] + '" alt="' + fileInfo[0] + '" class="attachment-image">' +
                                                '<span class="attachment-name">' + fileInfo[0] + '</span>' +
                                                '</a>';
                                        }/* else if (fileInfo[1] && imageFileTypes.includes(fileInfo[1])) {

                                        }*/ else {
                                            messageContent = '<a href="' + '{{ upload_asset('') }}/' + fileInfo[2] + '" class="attachment-file" target="_blank">' +
                                                '<span class="attachment-name">' + fileInfo[0] + '</span>' +
                                                '</a>';
                                        }
                                    }
                                    elChatMessages.append('<div class="chat-message">' +
                                        '<div class="chat-message-user">' +
                                        '<img src="' + (chatUser.avatar ? ('{{ upload_asset('') }}/' + chatUser.avatar) : '{{ static_asset('assets/img/avatar/male.png') }}') + '" class="avatar" alt="">' +
                                        '<span>' + chatUser.name + '</span>' +
                                        '</div>' +
                                        '<div class="chat-message-content">' + messageContent + '</div>' +
                                        '</div>');
                                });
                                // elChatMessages.scrollTop(elChatMessages.prop("scrollHeight"));
                            }

                        }
                    });
            }
            function scrollToChatBottom() {
                elChatMessages.scrollTop(elChatMessages.prop("scrollHeight"));
            }
            function readMessages() {
                $.ajax({
                    url: "{{ route('chat.read', ['channelId' => $channelId]) }}",
                    method: "GET",
                    cache: false,
                    dataType: "json"
                })
                    .done(function( response ) {
                        if(response.success) {
                            getChannels();
                        }
                    });
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
                        'channel_id': {{ $channelId }},
                        'message': message,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: "json"
                })
                    .done(function( response ) {
                        chatEditor.setData( '' );
                    });
            }
        @endif

        $(document).ready(function () {
            getChannels();
            channelTimer = setInterval(getChannels, channelTimeInterval);

            @if($channelId && $friendId)
                elChatMessages = $('#chat-messages');

                getMessages();
                messageTimer = setInterval(getMessages, messageTimeInterval);
                $('.chat-input-box .btn-send').click(function () {
                    readMessages();
                    sendMessage();
                    chatDropzone.processQueue();
                });

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
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    init() {
                        elChatMessages.addClass('dropzone');
                    },
                    accept: function(file, done) {
                        scrollToChatBottom();
                        if (1) {
                            done();
                        } else {
                            done();
                        }
                    },
                    sending: function (file, xhr, formData) {
                        formData.append("channel_id", {{ $channelId }});
                        formData.append("_token", '{{ csrf_token() }}');
                    },
                    complete: function(file) {
                        chatDropzone.removeFile(file);
                    }
                });
                $('.chat-input-box .btn-attachment').click(function () {

                    chatDropzone.hiddenFileInput.click();
                });
            @endif
        });
    </script>
@endsection
