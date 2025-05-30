const container = document.querySelector(".container");
const btnSignIn = document.getElementById("btn-sign-in");
const btnSignUp = document.getElementById("btn-sign-up");

btnSignIn.addEventListener("click", () => {
    container.classList.remove("toggle");
});
btnSignUp.addEventListener("click", () => {
    container.classList.add("toggle");
});

// El archivo loginjs.js debe restaurarse a su versión original, sin lógica de alternancia de formularios ni botones adicionales. Si tu archivo original solo tenía funciones para mostrar/ocultar contraseña y spinner, déjalo así:
document.querySelectorAll('.toggle-password').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const target = document.getElementById(this.getAttribute('data-target'));
        if (target.type === 'password') {
            target.type = 'text';
            this.querySelector('ion-icon').setAttribute('name', 'eye-off-outline');
        } else {
            target.type = 'password';
            this.querySelector('ion-icon').setAttribute('name', 'eye-outline');
        }
    });
});
if(document.getElementById('loginForm')) {
    document.getElementById('loginForm').addEventListener('submit', function() {
        var btn = document.getElementById('loginBtn');
        var spinner = document.getElementById('spinner');
        var btnText = document.getElementById('loginBtnText');
        btn.setAttribute('aria-busy', 'true');
        btn.disabled = true;
        spinner.classList.remove('d-none');
        btnText.textContent = 'Ingresando...';
    });
}

// Mostrar solo el formulario de login en móvil por defecto y alternar con el botón debajo de Iniciar sesión
function mostrarSoloLoginEnMovil() {
    if (window.innerWidth <= 600) {
        document.querySelectorAll('.container-form').forEach(f => f.classList.remove('active'));
        var loginForm = document.querySelectorAll('.container-form')[0];
        if (loginForm) loginForm.classList.add('active');
        // Mostrar botón de alternancia
        var btn = document.getElementById('mobile-signup-btn');
        if (btn) btn.style.display = 'block';
    } else {
        document.querySelectorAll('.container-form').forEach(f => f.classList.add('active'));
        var btn = document.getElementById('mobile-signup-btn');
        if (btn) btn.style.display = 'none';
    }
}
window.addEventListener('DOMContentLoaded', mostrarSoloLoginEnMovil);
window.addEventListener('resize', mostrarSoloLoginEnMovil);

// Alternar a registro en móvil usando el botón debajo de Iniciar sesión
var btnMobileSignup = document.getElementById('mobile-signup-btn');
if (btnMobileSignup) {
    btnMobileSignup.addEventListener('click', function() {
        document.querySelectorAll('.container-form').forEach(f => f.classList.remove('active'));
        var signupForm = document.querySelectorAll('.container-form')[1];
        if (signupForm) signupForm.classList.add('active');
        btnMobileSignup.style.display = 'none';
    });
}