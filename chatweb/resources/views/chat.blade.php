@extends('base')

@section('content')
    <div class="chat_container">
        <div class="col-sm-3 chat_sidebar">
            <div class="row">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" class="  search-query form-control" placeholder="Conversation"/>
                        <button class="btn btn-danger" type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
                <div class="dropdown all_conversation">
                    <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-weixin" aria-hidden="true"></i>
                        All Conversations
                        <span class="caret pull-right"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="#"> All Conversation </a>
                            <ul class="sub_menu_ list-unstyled">
                                <li><a href="#"> All Conversation </a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
                <div class="member_list">
                    <ul class="list-unstyled">
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right ">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec">
                                    <strong class="primary-font">Quangpv</strong> <strong class="pull-right">
                                        09:45AM</strong>
                                </div>
                                <div class="contact_sec">
                                    <strong class="primary-font">(+84) 999 999 999</strong> <span
                                            class="badge pull-right">3</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--chat_sidebar-->


        <div class="col-sm-9 message_section">
            <div class="row">
                <div class="new_message_head">
                    <div class="pull-left">
                        <button><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Message</button>
                    </div>
                    <div class="pull-right">
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cogs" aria-hidden="true"></i> Setting
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!--new_message_head-->

                <div class="chat_area">
                    <ul class="list-unstyled">
                        <li class="left clearfix">
                     <span class="chat-img1 pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body1 clearfix">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots
                                    in a piece of classical Latin literature from 45 BC, making it over 2000 years
                                    old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                                    Virginia.</p>
                                <div class="chat_time pull-right">09:40PM</div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img1 pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body1 clearfix">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots
                                    in a piece of classical Latin literature from 45 BC, making it over 2000 years
                                    old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                                    Virginia.</p>
                                <div class="chat_time pull-right">09:40PM</div>
                            </div>
                        </li>
                        <li class="left clearfix">
                     <span class="chat-img1 pull-left">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body1 clearfix">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots
                                    in a piece of classical Latin literature from 45 BC, making it over 2000 years
                                    old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                                    Virginia.</p>
                                <div class="chat_time pull-right">09:40PM</div>
                            </div>
                        </li>
                        <li class="left clearfix admin_chat">
                     <span class="chat-img1 pull-right">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body1 clearfix">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots
                                    in a piece of classical Latin literature from 45 BC, making it over 2000 years
                                    old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                                    Virginia.</p>
                                <div class="chat_time pull-left">09:40PM</div>
                            </div>
                        </li>
                        <li class="left clearfix admin_chat">
                     <span class="chat-img1 pull-right">
                     <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.0-1/p74x74/30716204_1184191368385005_3507653857420859414_n.jpg?_nc_cat=105&_nc_ht=scontent.fhan4-1.fna&oh=020e8d866c12771b308eefd9b48b9e51&oe=5C7AE8F6"
                          alt="User Avatar" class="img-circle">
                     </span>
                            <div class="chat-body1 clearfix">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots
                                    in a piece of classical Latin literature from 45 BC, making it over 2000 years
                                    old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                                    Virginia.</p>
                                <div class="chat_time pull-left">09:40PM</div>
                            </div>
                        </li>


                    </ul>
                </div><!--chat_area-->
                <div class="message_write">
                    <textarea class="form-control" placeholder="type a message"></textarea>
                    <div class="clearfix"></div>
                    <div class="chat_bottom"><a href="#" class="pull-left upload_btn"><i class="fa fa-cloud-upload"
                                                                                         aria-hidden="true"></i>
                            Add Files</a>
                        <a href="#" class="pull-right btn btn-success">
                            Send</a></div>
                </div>
            </div>
        </div> <!--message_section-->
    </div>
@endsection