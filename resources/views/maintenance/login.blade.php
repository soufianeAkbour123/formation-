<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Maintenance</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            *{
                margin: 0;
                padding: 0;
                font-family: 'poppins', sans-serif;
                box-sizing: border-box;
            }
            .container{
                width: 100vw;
                height: 100vh;
                background-image: url( asset('frontend/assets/images/background.webp') );
                background-position: center;
                background-size: cover;
                padding: 0 8%;
            }
            .logo{
                width: 120px;
                padding: 20px 0;
                cursor: pointer;
            }
            .content{
                top: 50%;
                position: absolute;
                transform: translateY(-50%);
                color: black;
                background: rgba(255, 255, 255, 0.95);
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }
            .content h1{
                font-size: 64px;
                font-weight: 600;
                margin-bottom: 20px;
            }
            .content h1 span{
                color: #ff3753;
            }
            .content p {
                margin-bottom: 20px;
                font-size: 18px;
            }
            .login-form {
                margin-top: 25px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: block;
                margin-bottom: 8px;
                color: black;
                font-weight: 500;
            }
            .form-group input {
                width: 100%;
                padding: 10px;
                border: 2px solid #ff3753;
                border-radius: 5px;
                font-size: 16px;
                outline: none;
                transition: border-color 0.3s;
            }
            .form-group input:focus {
                border-color: #d62b44;
            }
            .login-btn {
                background: #ff3753;
                border: none;
                outline: none;
                padding: 12px 25px;
                color: #fff;
                display: inline-flex;
                align-items: center;
                margin-top: 15px;
                cursor: pointer;
                border-radius: 5px;
                font-size: 16px;
                transition: background 0.3s;
            }
            .login-btn:hover {
                background: #d62b44;
            }
            .rocket{
                width: 250px;
                position: absolute;
                right: 10%;
                bottom: 0;
                animation: rocket 4s linear infinite;
            }
            @keyframes rocket{
                0%{
                    bottom: 0;
                    opacity: 0;
                }
                100%{
                    bottom: 105%;
                    opacity: 1;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img src="assets/images/logo.png" class="logo">
            <div class="content">
                <p>Le site est en maintenance</p>
                <h1>Nous <span>Lançons</span> Bientôt</h1>
                
                <form class="login-form" action="{{ route('maintenance.auth') }}" method="POST">
                    @csrf
                    @if($errors->any())
                    <div style="color: #ff3753; margin-bottom: 15px;">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label for="username">Identifiant</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <button type="submit" class="login-btn">
                        Se connecter
                        <img src="https://i.postimg.cc/QC1THsDM/triangle.png" style="width: 15px; margin-left: 10px;">
                    </button>
                </form>
            </div>
            <img src="https://i.postimg.cc/PfwZ6bDk/rocket.png" class="rocket">
        </div>
    </body>
</html>