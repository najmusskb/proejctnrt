<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ $content->com_name ?? 'Admin' }} | Login</title>
        <link rel="icon" type="image/png" href="{{ !empty($content->favicon) ? asset($content->favicon) : asset('images/no.png') }}" />
        <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa:wght@400;700&family=Cairo:wght@400;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap-4.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    </head>
    <body class="auth-body">
        <div class="auth-deco auth-deco-1"></div>
        <div class="auth-deco auth-deco-2"></div>
        <div class="auth-deco auth-deco-3"></div>
        <main class="auth-wrap">
            <div class="auth-card">
                <div class="auth-brand-panel">
                    <div class="auth-brand-inner">
                        <img src="{{ asset($content->logo) }}" alt="logo" class="auth-logo" />
                        <h1>Welcome Back</h1>
                        <p>Sign in to manage your <strong>{{ $content->com_name }}</strong> dashboard.</p>
                        <div class="auth-brand-feats">
                            <span><i class="fa-solid fa-shield"></i> Secure Admin Panel</span>
                            <span><i class="fa-solid fa-bolt"></i> Full Site Control</span>
                            <span><i class="fa-solid fa-rocket"></i> Fast &amp; Smart Tools</span>
                        </div>
                        <a href="{{ route('index') }}" class="auth-goto-site"><i class="fa-solid fa-arrow-left"></i> Back to Website</a>
                    </div>
                </div>

                <div class="auth-form-panel">
                    <div class="auth-form-inner">
                        <span class="auth-badge"><i class="fa-solid fa-user-lock"></i> Admin Login</span>
                        <h2>Sign In</h2>
                        <p class="auth-sub">Enter your credentials to access the dashboard.</p>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @yield('main-content')

                        <form action="{{ route('login.check') }}" method="POST">
                            @csrf
                            <div class="auth-input">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Username" />
                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="auth-input mb-4">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="password" id="authPass" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                                <button type="button" class="auth-eye" id="authEye" tabindex="-1"><i class="fa-solid fa-eye"></i></button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <button type="submit" name="login" class="auth-btn"><i class="fa-solid fa-arrow-right"></i> Login</button>
                        </form>

                        <nav class="auth-footer-nav">
                            <a href="#!">Copyright &copy; {{ date('Y') }}</a>
                            <a href="#!">{{ $content->com_name }}</a>
                        </nav>
                    </div>
                </div>
            </div>
        </main>

        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-4.min.js') }}"></script>
        <script>
            $("document").ready(function(){
                setTimeout(function(){
                    $("div.alert").remove();
                }, 3000);
            });

            var eye = document.getElementById('authEye');
            var pass = document.getElementById('authPass');
            if (eye && pass) {
                eye.addEventListener('click', function(){
                    var show = pass.type === 'password';
                    pass.type = show ? 'text' : 'password';
                    this.innerHTML = show ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
                });
            }
        </script>
    </body>
</html>
