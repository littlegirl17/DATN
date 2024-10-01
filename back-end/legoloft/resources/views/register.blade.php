@extends('layout.layout')
@section('title', 'Đăng ký')
@section('content')
    <!-- START MAIN -->
    <div class="bg_register">
        <div class="container">
            <div class="login_main">
                <div class="login_content">
                    <div class="title">
                        <h2>Đăng ký</h2>
                    </div>
                    <div class="login_item">
                        <label for="">Email</label>
                        <input type="email" placeholder="Nhập email" />
                    </div>
                    <div class="login_item">
                        <label for="">Số điện thoại</label>
                        <input type="number" placeholder="Số điện thoại" />
                    </div>
                    <div class="login_item">
                        <label for="">Mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="login_item">
                        <label for="">Nhập lại mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" />
                    </div>
                    <div>
                        <button class="btn_login">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
