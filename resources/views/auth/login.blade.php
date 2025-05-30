<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Academia Código Rapidito</title>
    <link rel="stylesheet" href="{{ secure_asset('css/loginstyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mobile-toggle-btns">
            <button type="button" id="mobile-login-btn" class="button mobile-btn active">Iniciar sesión</button>
            <button type="button" id="mobile-register-btn" class="button mobile-btn">Registrarse</button>
        </div>
        
        <div class="container-form sign-in active">
            <form method="POST" action="{{ route('login') }}" id="loginForm" aria-label="Formulario de inicio de sesión">
                @csrf
                <div class="form-header">
                    <h2>Inicio de sesión</h2>
                    <p>Bienvenido de vuelta a la Academia Código Rapidito</p>
                </div>
                
                <div class="social-networks">
                    <button type="button" class="social-btn" aria-label="Iniciar sesión con Facebook">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </button>
                    <button type="button" class="social-btn" aria-label="Iniciar sesión con GitHub">
                        <ion-icon name="logo-github"></ion-icon>
                    </button>
                    <button type="button" class="social-btn" aria-label="Iniciar sesión con Microsoft">
                        <ion-icon name="logo-microsoft"></ion-icon>
                    </button>
                    <button type="button" class="social-btn" aria-label="Iniciar sesión con Google">
                        <ion-icon name="logo-google"></ion-icon>
                    </button>
                </div>
                
                <div class="divider">
                    <span>o usa tu correo</span>
                </div>
                
                <div class="form-group">
                    <div class="container-input">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                               aria-required="true" aria-describedby="emailHelp" placeholder="Correo electrónico">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="container-input password-input">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" placeholder="Contraseña" required id="login-password">
                        <button type="button" class="toggle-password" data-target="login-password" aria-label="Mostrar contraseña">
                            <ion-icon name="eye-outline"></ion-icon>
                        </button>
                    </div>
                    
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-options">
                        <div class="remember-me">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Recuérdame</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                    
                    <button type="submit" class="button primary-btn" id="loginBtn" aria-busy="false">
                        <span id="loginBtnText">Iniciar sesión</span>
                        <span id="spinner" class="spinner" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="container-form sign-up">
            <form class="sign-up" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-header">
                    <h2>Registrarse</h2>
                    <p>Únete a la Academia Código Rapidito</p>
                </div>
                
                <div class="social-networks">
                    <button type="button" class="social-btn" aria-label="Registrarse con Facebook">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </button>
                    <button type="button" class="social-btn" aria-label="Registrarse con GitHub">
                        <ion-icon name="logo-github"></ion-icon>
                    </button>
                    <button type="button" class="social-btn" aria-label="Registrarse con Microsoft">
                        <ion-icon name="logo-microsoft"></ion-icon>
                    </button>
                    <button type="button" class="social-btn" aria-label="Registrarse con Google">
                        <ion-icon name="logo-google"></ion-icon>
                    </button>
                </div>
                
                <div class="divider">
                    <span>o usa tu correo</span>
                </div>
                
                <div class="form-group">
                    <div class="container-input">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="name" placeholder="Nombre de usuario" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="container-input">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="container-input password-input">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" placeholder="Contraseña" required id="register-password">
                        <button type="button" class="toggle-password" data-target="register-password" aria-label="Mostrar contraseña">
                            <ion-icon name="eye-outline"></ion-icon>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="container-input password-input">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required id="register-password-confirmation">
                        <button type="button" class="toggle-password" data-target="register-password-confirmation" aria-label="Mostrar contraseña">
                            <ion-icon name="eye-outline"></ion-icon>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="container-input">
                        <ion-icon name="people-outline"></ion-icon>
                        <input type="hidden" name="role" value="alumno">
                        <input type="text" class="form-control" value="Alumno" readonly>
                    </div>
                    @error('role')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <button class="button primary-btn" type="submit">REGISTRARSE</button>
                </div>
            </form>
        </div>
        
        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <div class="welcome-content">
                    <h3>¡Bienvenido!</h3>
                    <p>Ingresa tus datos para acceder a todos los recursos de la Academia Código Rapidito</p>
                    <button class="button outline-btn" id="btn-sign-up">Registrarse</button>
                </div>
            </div>
            <div class="welcome-sign-in welcome">
                <div class="welcome-content">
                    <h3>¡Hola!</h3>
                    <p>¿Ya tienes una cuenta? Inicia sesión para continuar tu aprendizaje</p>
                    <button class="button outline-btn" id="btn-sign-in">Iniciar sesión</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ secure_asset('js/loginjs.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if (session('status'))
        @php echo "<script>document.addEventListener('DOMContentLoaded', function() {Swal.fire({icon: 'success',title: '¡Listo!',text: ".json_encode(session('status')).",confirmButtonColor: '#3AB397',timer: 2500,timerProgressBar: true,showConfirmButton: false});});</script>"; @endphp
    @endif
</body>
</html>
