<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="http://www.elink.com.ph/wp-content/uploads/2016/01/elink-logo-site.png">
        <title>Elink Employee Directory | Login</title>
        <link href="{{ asset('public/css/css.css')}}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: "Source Sans Pro", "Segoe UI", Frutiger, "Frutiger Linotype", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                background-image: url({{asset('public/img/002-subtle-light-pattern-background-texture.jpg')}});
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .content {
                text-align: center;
                width: 400px;
                border: 1px solid #eaeaea;
                padding: 50px 50px 50px 30px;
                background-color: #F5F5F5;
                box-shadow: 1px 1px 2px 0px #a9a9a970;
            }
            .title {
                font-size: 50px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .form-input{
                background-color: white;
                font-family: inherit;
                border: 1px solid #dfdfdf;
                color: inherit;
                display: block;
                font-size: 14px;
                margin: 0 0 13px 0;
                padding: 7px 7px 7px 15px;
                height: 34px;
                width: 100%;
            }
            .form-group label{
                font-weight: bold !important;
                font-size: 15px;
                margin-bottom: 2px;
                display: table-caption;
            }
            .form-group{
                margin-top: 10px;
            }

            .btn-holder{
                margin-top: 20px;
            }
            button.flat{
                width: auto;
                background: #36bae2;
                box-shadow: none;
                color: #fff;
                font-weight: 500;
                cursor: pointer;
                position: relative;
                display: inline-block;
                font-size: 14px !important;
                margin: 0;
                padding: 12px 32px;
                position: relative;
                text-align: center;
                border-radius: 2px;
                border: none;
                -webkit-transition: none;
                -moz-transition: none;
                transition: none;
            }
             button.flat:hover{
                background-color: #1da0c8;
             }
             .invalid-feedback{
                color: #C9302C;
                font-size: 14px !important;
                line-height: 19px;
                font-weight: 500;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('public/img/elink-logo-site.png')}}" style="width: 80px; margin-bottom: -20px;">
                    eLink's <br>
                    <span style="font-size: 40px">Employee Directory</span>
                </div>
                <div class="links">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input class="form-input" type="text" name="email" placeholder="Username" value="{{ old('email') }}" required autofocus/>
                        </div>
                        <div class="form-group">
                            <input  class="form-input" type="password" name="password" value="" placeholder="Password" required/>
                        </div>
                         @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                        <div class="form-group btn-holder">
                            <button class="button flat" name="submit">
                                <span class="icon">
                                    <img src="{{ asset('public/img/arrow-right.gif')}}" alt="→">
                                </span> 
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
