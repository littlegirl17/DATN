<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ hàng</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/HK.png') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <style>
        .bg_admin_login {
            background-color: #f3f4f9;
            height: 100vh;
            /* Chiều cao bằng 100% chiều cao của viewport */
        }

        .form_admin {
            margin: 0 auto;
            width: 400px;
            padding-top: 150px;
        }

        .form_admin_content {
            background-color: #ffffff;
            box-shadow: rgba(17, 17, 26, 0.05) 0px 4px 16px,
                rgba(17, 17, 26, 0.05) 0px 8px 32px;
            padding: 30px 50px;
        }

        .form_admin_content .title h2 {
            padding-bottom: 15px;
            text-align: center;
            background: linear-gradient(to right,
                    #ffc506,
                    #3b4242);
            /* Phối hợp hai màu */
            -webkit-background-clip: text;
            /* Cắt nền theo chữ */
            -webkit-text-fill-color: transparent;
            /* Làm cho chữ trong suốt */
        }

        .form_admin_item {
            display: flex;
            flex-direction: column;
            padding-bottom: 20px;
        }

        .form_admin_item label {
            color: #8e8c8c;
            font-size: 1rem;
            padding-bottom: 5px;
        }

        .form_admin_item input {
            padding: 8px 10px;
            border: none;
            outline: none;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px,
                rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
            border-radius: 5px;
        }

        .btn_admin_login {
            width: 100%;
            background-color: #ffc506;
            color: #ffffff;
            outline: none;
            border: none;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
            position: relative;
            overflow: hidden;
            /* Để ẩn phần hiệu ứng ra ngoài nút */
            font-weight: bold;
            /* Làm cho chữ đậm hơn */
            transition: color 0.3s ease;
            /* Thêm hiệu ứng chuyển tiếp cho màu chữ */
        }

        .btn_admin_login::before {
            content: "";
            position: absolute;
            top: 100%;
            /* Bắt đầu từ dưới */
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #e0a800;
            /* Màu vàng đậm */
            transition: top 0.3s ease;
            /* Thời gian chuyển tiếp */
            z-index: 0;
            /* Đặt ở dưới cùng */
        }

        .btn_admin_login:hover::before {
            top: 0;
            /* Di chuyển lên trên khi hover */
            z-index: -1;
        }

        .btn_admin_login:hover {
            color: #ffffff;
            /* Giữ màu chữ khi hover */
            z-index: 1;
            /* Đặt nút lên trên cùng */
        }
    </style>
</head>

<body>
    <div class="bg_admin_login">
        <div class="container">
            <div class="form_admin">
                <div class="form_admin_content">
                    <div class="title">
                        <h2>Đăng nhập</h2>
                    </div>
                    <div class="form_admin_item">
                        <label for="">Tên đăng nhập</label>
                        <input type="text" placeholder="Nhập tên đăng nhập" />
                    </div>
                    <div class="form_admin_item">
                        <label for="">Mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" />
                    </div>
                    <button type="submit" class="btn_admin_login">Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
</body>

</html>
