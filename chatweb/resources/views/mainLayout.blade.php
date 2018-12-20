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
    <script src="{{$base_url}}vendor/js/bootstrap.min.js" type="text/javascript"></script>
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
                <button id="addcontact" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-plus fa-fw" aria-hidden="true" ></i> <span>Thêm nhóm</span></button>
                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
            </div>
        </div>
        <div class="content">
            <div class="contact-profile">
                <img src="" alt="" />
                <p>Harvey Specter</p>
                <div class="social-media" >
                    <i class="fa fa-gears" title="cài đặt" onclick="openSetting()" aria-hidden="true"></i>
                    <i class="fa fa-map-marker" onclick="pinThisBox()" title="Ghim cuộc trò chuyện này" aria-hidden="true"></i>
                    <i class="fa fa-list" onclick="getPinnedMessage()" title="Tin nhắn đã ghim" aria-hidden="true"></i>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b>Thêm nhóm mới</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                           <form>
                              <div class="form-group position-relative">
                                <label for="exampleInputPassword1" class="h-45px">Thêm thành viên vào nhóm</label>

                                <input type="text" class="form-control" id="add-member-group" onkeyup="findUserAddGroup(this)" placeholder="Tìm thành viên">
                                <div class="position-absolute w-100" id="select-user" style="top:90px;left: 0px; height: 50px;">
                                    <ul class="list-group w-100 bg-white" style="  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
                                        {{-- <li class="list-group-item p-0 d-flex align-items-center option-select-user h-45px" >
                                              <img style="width: 30px!important" height="30px" src="{{URL('/images/').'/'.Auth::user()->avatar}}" class="m-0 ml-2 mr-2 rounded-circle border border-white d-inline-block" alt="">
                                              <span><b>Cras justo odio</b></span>
                                        </li> --}}
                                    </ul>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1" class="h-45px">Tên nhóm</label>
                                <input type="text" class="form-control" id="group-name" placeholder="Điền tên nhóm của bạn">
                               
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1" class="h-45px">Mô tả về nhóm</label>
                                <input type="text" class="form-control" id="describtion-group" placeholder="Mô tả nhóm">
                              </div>


                              <div class="form-group">
                                <label for="exampleInputPassword1" class="h-45px">Ảnh đại diện nhóm</label>
                                <input type="text" class="form-control" id="picture-group" placeholder="Mô tả nhóm">
                              </div>

                                

                              <div class="form-group list-user-add-group">
                                {{-- <span class="badge badge-light mr-2 mb-2">
                                    <img style="width: 30px!important" height="30px" src="{{URL('/images/').'/'.Auth::user()->avatar}}" class="m-0 ml-2 mr-2 rounded-circle border border-white d-inline-block" alt="">
                                    <h6 class="m-0 pt-1 d-inline-block text-bold">Đào Mạnh Khá </h6>
                                    <h5 class="m-0 d-inline-block">
                                        <i class="fa fa-times-circle-o ml-2 pt-1" style="cursor: pointer;" aria-hidden="true" title="bỏ người này"></i></h5>
                                </span> --}}
                              </div>

                            </form>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button onclick="addGroup()" type="button" class="btn btn-primary">Thêm nhóm</button>
                            </div>
                        </div>
                    </div>
                </div>
</div>
<div class="messages">
    <div class="loader message-loader"></div>
    <div class="message-wraper">
        <!-- Button trigger modal -->

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