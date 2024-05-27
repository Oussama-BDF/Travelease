<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ucfirst($title)}} - Explore Morocco</title>

        <style>
            * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box
            }

            body {
                padding: 0;
                margin: 0
            }

            .container {
                background: url('http://127.0.0.1:8000/img/hero.jpg') no-repeat center/cover;
                position: relative;
                height: 100vh
            }

            .container .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .container .error {
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                max-width: 520px;
                width: 100%;
                line-height: 1.4;
                text-align: center
            }

            .error .icon {
                position: relative;
                height: 240px
            }

            .error .icon h1 {
                font-family: montserrat, sans-serif;
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                font-size: 252px;
                font-weight: 900;
                margin: 0;
                color: #262626;
                text-transform: uppercase;
                letter-spacing: -40px;
                margin-left: -20px
            }

            .error .icon h1>span {
                text-shadow: -8px 0 0 #999
            }

            .error .icon h3 {
                font-family: cabin, sans-serif;
                position: relative;
                font-size: 16px;
                font-weight: 700;
                text-transform: uppercase;
                color: #ffff;
                margin: 0;
                letter-spacing: 3px;
                padding-left: 6px
            }

            .error h2 {
                font-family: cabin, sans-serif;
                font-size: 20px;
                font-weight: 400;
                text-transform: uppercase;
                color: #ffff;
                margin-top: 0;
                margin-bottom: 25px
            }

            .error button {
                padding: 5px;
                color: white;
                background-color: #999;
                border-radius: 7px;
                border: 1px solid black;
                cursor: pointer;
            }
            
            .error button:hover {
                opacity: .9
            }

            @media only screen and (max-width: 767px) {
                .error .icon {
                    height: 200px
                }

                .notfound .icon h1 {
                    font-size: 200px
                }
            }

            @media only screen and (max-width: 480px) {
                .notfound .icon {
                    height: 162px
                }

                .notfound .icon h1 {
                    font-size: 162px;
                    height: 150px;
                    line-height: 162px
                }

                .notfound h2 {
                    font-size: 16px
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="overlay"></div>
            <div class="error">
                <div class="icon">
                    <h3>Oops!</h3>
                    <h1><span>{{$codeStatus[0]}}</span><span>{{$codeStatus[1]}}</span><span>{{$codeStatus[2]}}</span></h1>
                </div>
                <h2>{{$message}}</h2>
                <button onclick="goBack()">Go Back</button>
            </div>
        </div>
    </body>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</html>