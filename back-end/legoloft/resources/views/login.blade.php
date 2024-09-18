@extends('layout.layout')
@section('title', 'Đăng nhập')
@section('content')
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
                    </div>
                    <div>
                        <button class="btn_login">Đăng nhập</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
