const container = document.querySelector(".container");
const btnSignIn = document.getElementById("btn-sign-in");
const btnSignUp = document.getElementById("btn-sign-up");
const mobileLoginBtn = document.getElementById("mobile-login-btn");
const mobileRegisterBtn = document.getElementById("mobile-register-btn");

// Toggle between login and register forms
btnSignIn?.addEventListener("click", () => {
    container.classList.remove("toggle");
});

btnSignUp?.addEventListener("click", () => {
    container.classList.add("toggle");
});

// Mobile toggle buttons
mobileLoginBtn?.addEventListener("click", () => {
    document.querySelector(".container-form.sign-in").classList.add("active");
    document.querySelector(".container-form.sign-up").classList.remove("active");
    mobileLoginBtn.classList.add("active");
    mobileRegisterBtn.classList.remove("active");
});

mobileRegisterBtn?.addEventListener("click", () => {
    document.querySelector(".container-form.sign-in").classList.remove("active");
    document.querySelector(".container-form.sign-up").classList.add("active");
    mobileRegisterBtn.classList.add("active");
    mobileLoginBtn.classList.remove("active");
});

// Password visibility toggle
document.querySelectorAll('.toggle-password').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const target = document.getElementById(this.getAttribute('data-target'));
        const icon = this.querySelector('ion-icon');
        if (target.type === 'password') {
            target.type = 'text';
            icon.setAttribute('name', 'eye-off-outline');
        } else {
            target.type = 'password';
            icon.setAttribute('name', 'eye-outline');
        }
    });
});

// Login form submission
document.getElementById('loginForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    const spinner = document.getElementById('spinner');
    const btnText = document.getElementById('loginBtnText');
    
    btn.setAttribute('aria-busy', 'true');
    btn.disabled = true;
    spinner.style.opacity = '1';
    btnText.textContent = 'Ingresando...';
});

// Responsive adjustments
function isMobile() {
    return window.innerWidth <= 768;
}

function updateMobileView() {
    const mobileBtns = document.querySelector('.mobile-toggle-btns');
    const welcomeSection = document.querySelector('.container-welcome');
    
    if (isMobile()) {
        mobileBtns.style.display = 'flex';
        welcomeSection.style.display = 'none';
        
        // Ensure one form is always active
        if (!document.querySelector('.container-form.sign-in.active') && 
            !document.querySelector('.container-form.sign-up.active')) {
            document.querySelector('.container-form.sign-in').classList.add('active');
            mobileLoginBtn.classList.add('active');
            mobileRegisterBtn.classList.remove('active');
        }
    } else {
        mobileBtns.style.display = 'none';
        welcomeSection.style.display = 'flex';
        document.querySelector('.container-form.sign-in').classList.add('active');
    }
}

// Form validations
function validateLoginForm() {
    const form = document.querySelector('.sign-in');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        let valid = true;
        document.querySelectorAll('.sign-in .error-front').forEach(el => el.remove());

        const email = this.email.value.trim();
        const password = this.password.value.trim();

        if (!email.match(/^[^@\s]+@[^@\s]+\.[^@\s]+$/)) {
            showError(this.email, 'Ingrese un correo válido');
            valid = false;
        }
        if (password.length === 0) {
            showError(this.password, 'Ingrese su contraseña');
            valid = false;
        }
        if (!valid) e.preventDefault();
    });
}

function validateRegisterForm() {
    const form = document.querySelector('.sign-up');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        let valid = true;
        document.querySelectorAll('.sign-up .error-front').forEach(el => el.remove());

        const name = this.name.value.trim();
        const email = this.email.value.trim();
        const password = this.password.value.trim();

        if (name.length === 0) {
            showError(this.name, 'Ingrese su nombre');
            valid = false;
        }
        if (!email.match(/^[^@\s]+@[^@\s]+\.[^@\s]+$/)) {
            showError(this.email, 'Ingrese un correo válido');
            valid = false;
        }
        if (password.length < 6) {
            showError(this.password, 'La contraseña debe tener al menos 6 caracteres');
            valid = false;
        }
        if (!valid) e.preventDefault();
    });
}

function showError(input, message) {
    const div = document.createElement('div');
    div.className = 'error-front';
    div.style.color = 'var(--error-color)';
    div.style.fontSize = '12px';
    div.style.marginTop = '5px';
    div.style.marginBottom = '10px';
    div.innerText = message;
    input.parentNode.insertBefore(div, input.nextSibling);
}

// Initialize
window.addEventListener('DOMContentLoaded', function() {
    updateMobileView();
    validateLoginForm();
    validateRegisterForm();
});

window.addEventListener('resize', updateMobileView); 