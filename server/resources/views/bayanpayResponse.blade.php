<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style type="text/css">
            .content {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                width: 100%;
                margin: 10% 0;
                min-height: 200px;
            }
            .main{
                background-color: rgba(23, 23, 23, .3);
                padding:50px 200px;
                border-radius: 5px
            }
            .text {
                margin-right: 70px;
            }
            .form-control {
                margin-bottom:5px;
                font-size: 1.5rem;
                display: flex;
                justify-content: space-between;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="main">
                @if ($status !== 200)
                    <div class="form-control">
                        <span class="text"><label>{{$data['errors']}}</label></span>
                    </div>
                @else
                    <div class="form-control">
                        <span class="text"><label>Transaction ID:</label></span>
                        <span class="value">{{$data->orderid}}</span>
                    </div>

                    <div class="form-control">
                        <span class="text"><label>Amount:</label></span>
                        <span class="value">{{$data->amount}}</span>
                    </div>

                    <div class="form-control">
                        <span class="text"><label>Status:</label></span>
                        <span class="value">{{$data->status}}</span>
                    </div>

                    <div class="form-control">
                        <span class="text"><label>Status Message:</label></span>
                        <span class="value">{{$data->status_msg}}</span>
                    </div>
                @endif

                <h3 class="text">You will be redirect back soon...</h3>

            </div>
        </div>

        <script>
            window.onload = redirectToNuxt;

            function redirectToNuxt(){
                let url = "{!! $BAYANPAY_POST_RESPONSE_REDIRECTION_URL !!}";

                window.setTimeout(() => {
                    window.location = url;
                },1800)
            }
        </script>
    </body>
</html>
