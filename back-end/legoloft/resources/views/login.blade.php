@extends('layout.layout')
@section('title', 'Đăng nhập')
@section('content')
    <!-- START MAIN -->
    <div class="bg_login">
        <div class="container">
            <div class="login_main">
                <div class="login_content">
                    <div class="title">
                        <h2>Đăng nhập</h2>
                    </div>
                    <div class="login_item">
                        <label for="">Email</label>
                        <input type="email" placeholder="Nhập email" />
                    </div>
                    <div class="login_item">
                        <label for="">Mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" />
                        <label for="" class="login_forgetpw"><a href="" class="">Quên mật
                                khẩu</a></label>
                    </div>
                    <div>
                        <button class="btn_login">Đăng nhập</button>
                    </div>
                    <div class="border-container-login">
                        <hr class="border-left" />
                        <span>Hoặc</span>
                        <hr class="border-right" />
                    </div>
                    <div class="login_regis">
                        <span>Bạn chưa có tài khoản?</span>
                        <a href="">
                            <span>Đăng ký thành viên<i class="fa-solid fa-arrow-right ps-1"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
