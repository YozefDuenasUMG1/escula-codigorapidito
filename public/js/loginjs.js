document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const container = document.querySelector(".container");
    const btnSignIn = document.getElementById("btn-sign-in");
    const btnSignUp = document.getElementById("btn-sign-up");
    const mobileToggleButtons = document.querySelectorAll('.mobile-toggle-button');
    const signInForm = document.getElementById("sign-in-form");
    const signUpForm = document.getElementById("sign-up-form");

    // Función para alternar formularios en mobile
    function toggleMobileForms(target) {
        // Remover active de todos los botones
        mobileToggleButtons.forEach(btn => btn.classList.remove('active'));
        // Ocultar todos los formularios
        document.querySelectorAll('.container-form').forEach(form => {
            form.classList.remove('active');
        });
        // Activar el botón y formulario correspondiente
        if (target === 'sign-in') {
            document.querySelector('[data-target="sign-in"]').classList.add('active');
            signInForm.classList.add('active');
        } else {
            document.querySelector('[data-target="sign-up"]').classList.add('active');
            signUpForm.classList.add('active');
        }
    }

    // Configurar eventos para mobile
    function setupMobileToggle() {
        mobileToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                toggleMobileForms(this.dataset.target);
            });
        });
    }

    // Verificar el tamaño de pantalla y configurar eventos
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            // Comportamiento para mobile
            setupMobileToggle();
            // Asegurarse de que solo el formulario de login está visible al cargar
            if (!signInForm.classList.contains('active')) {
                toggleMobileForms('sign-in');
            }
        } else {
            // Comportamiento para desktop
            if (btnSignIn && btnSignUp) {
                btnSignIn.addEventListener("click", () => {
                    container.classList.remove("toggle");
                });
                btnSignUp.addEventListener("click", () => {
                    container.classList.add("toggle");
                });
            }
        }
    }

    // Inicializar y configurar el resize listener
    checkScreenSize();
    window.addEventListener('resize', checkScreenSize);

    // Validación para el formulario de login
    if (signInForm) {
        signInForm.addEventListener('submit', function(e) {
            let valid = true;
            // Limpiar errores previos
            document.querySelectorAll('.sign-in .error-front').forEach(el => el.remove());

            const email = this.email.value.trim();
            const password = this.password.value.trim();

            // Validar email
            if (!email.match(/^[^@\s]+@[^@\s]+\.[^@\s]+$/)) {
                showError(this.email, 'Ingrese un correo válido');
                valid = false;
            }
            // Validar contraseña
            if (password.length === 0) {
                showError(this.password, 'Ingrese su contraseña');
                valid = false;
            }
            if (!valid) e.preventDefault();
        });
    }

    // Validación para el formulario de registro
    if (signUpForm) {
        signUpForm.addEventListener('submit', function(e) {
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

    // Función para mostrar errores
    function showError(input, message) {
        const div = document.createElement('div');
        div.className = 'error-front';
        div.style.color = 'red';
        div.style.fontSize = '12px';
        div.style.marginBottom = '5px';
        div.innerText = message;
        input.parentNode.insertBefore(div, input.nextSibling);
    }
});