@php
    $base_url = url('/').'/';
@endphp
<!DOCTYPE doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title> BK Chat </title>
        <!-- <link rel="icon" href="{{url('/img')}}/logo.png"> -->
        <link rel="stylesheet" href="{{$base_url}}vendor/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{$base_url}}css/app.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{$base_url}}vendor/font/css/font-awesome.min.css">
        <script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>
        <script src="{{$base_url}}vendor/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="{{$base_url}}js/app.js" type="text/javascript"></script>
        
    </head>
    <body >
        <div id="base-url" class="d-none">{{$base_url}}</div>
        <div id="user-list" class="d-none">{{$userList}}</div>
        <div id="room-list" class="d-none">{{$roomList}}</div>

        <div id="frame">
            <div id="sidepanel">
                <div id="profile" my-id="{{Auth::user()->id}}">
                    <div class="wrap">
                        <img id="profile-img" src="{{URL('/images/').'/'.Auth::user()->avatar}}" class="online" alt="" />
                        <p>{{Auth::user()->name}}</p>
                        <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                        <div id="status-options">
                            <ul>
                                <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
                                <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                                <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                                <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
                            </ul>
                        </div>
                        <div id="expanded">

                            <button class="btn btn-primary"><i class="fa fa-info" aria-hidden="true"></i> Thông tin</button>
                            <a class="btn btn-primary" href="{{$base_url.'logout'}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
                        </div>
                    </div>
                </div>
                <div id="search">
                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="text" id="search-user" placeholder="Search contacts..." />
                </div>
                <div id="contacts">
                   
                </div>
                <div id="bottom-bar">
                    <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
                    <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
                </div>
            </div>
            <div class="content">
                <div class="contact-profile">
                    {{-- <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> --}}
                    <p>Harvey Specter</p>
                    <div class="social-media" >
                        <i class="fa fa-gears" title="cài đặt" onclick="openSetting()" aria-hidden="true"></i>
                        <i class="fa fa-map-marker" onclick="pinThisBox()" title="Ghim cuộc trò chuyện này" aria-hidden="true"></i>
                         <i class="fa fa-list" onclick="getPinnedMessage()" title="Tin nhắn đã ghim" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="messages">
                    <div class="loader message-loader"></div>
                    <div class="message-wraper">

                        
                    </div>
                </div>
                <div class="message-input">
                    <div class="wrap">
                    <input type="text" id="message-input" placeholder="Write your message..." />
                    <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>