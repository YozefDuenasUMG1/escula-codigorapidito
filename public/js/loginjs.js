document.addEventListener('DOMContentLoaded', function() {
    // Selectores
    const mobileToggleButtons = document.querySelectorAll('.mobile-toggle-button');
    const container = document.querySelector(".container");
    const btnSignIn = document.getElementById("btn-sign-in");
    const btnSignUp = document.getElementById("btn-sign-up");
    
    // Función para alternar entre formularios en mobile
    function setupMobileToggle() {
        mobileToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover clase active de todos los botones
                mobileToggleButtons.forEach(btn => btn.classList.remove('active'));
                // Añadir clase active al botón clickeado
                this.classList.add('active');
                // Ocultar todos los formularios
                document.querySelectorAll('.container-form').forEach(form => {
                    form.classList.remove('active');
                });
                // Mostrar el formulario correspondiente
                const targetForm = document.getElementById(this.dataset.target);
                targetForm.classList.add('active');
            });
        });
    }

    // Verificar el tamaño de pantalla y configurar los eventos
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            setupMobileToggle();
        } else {
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

    // Ejecutar al cargar y al redimensionar
    checkScreenSize();
    window.addEventListener('resize', checkScreenSize);

    // Validación para el formulario de login
    const signInForm = document.querySelector('.sign-in');
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
    const signUpForm = document.querySelector('.sign-up');
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