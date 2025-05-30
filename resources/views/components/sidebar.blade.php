<div class="menu-btn sidebar-btn" id="sidebar-btn">
    <i class='bx bx-menu'></i>
    <i class='bx bx-x'></i>
</div>
<div class="sidebar" id="sidebar" style="overflow-y: auto; max-height: 100vh;">
    <div class="menu-btn" id="menu-btn">
        <i class='bx bx-chevron-left'></i>
    </div>
    <div class="brand">
        <img src="{{ asset('brand/CodigoIcon.jpg') }}" alt="logo">
        <span style="color: var(--color-text-primary); font-size: 1.1rem; font-weight: 600;">Bienvenido</span>
    </div>
    <div class="letramod">
        <span>Administrador</span>
    </div>
    <div class="menu-container">
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('inicio') }}" class="menu-link">
                <i class='bx bx-home-alt-2'></i>
                <span>Inicio</span>
            </a>
        </li>
    </ul>
    <div class="letramod">
        <span>Alumnos</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumnos.lista') }}" class="menu-link">
                <i class='bx bx-user'></i>
                <span>Lista de alumnos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumnos.inscribir') }}" class="menu-link">
                <i class='bx bx-plus-circle'></i>
                <span>Inscribir alumnos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumnos.gestion') }}" class="menu-link">
                <i class='bx bx-book-bookmark'></i>
                <span>Gestión de alumnos</span>
            </a>
        </li>
    </ul>
    <div class="letramod">
        <span>Profesores</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('profesores.lista') }}" class="menu-link">
                <i class='bx bx-user'></i>
                <span>Lista de profesores</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('profesores.create') }}" class="menu-link">
                <i class='bx bx-plus-circle'></i>
                <span>Añadir profesor</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('profesores.gestion') }}" class="menu-link">
                <i class='bx bx-book-bookmark'></i>
                <span>Gestión de profesores</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('notas.create') }}" class="menu-link">
                <i class='bx bx-edit'></i>
                <span>Ingresar punteos</span>
            </a>
        </li>
    </ul>
    <div class="letramod">
        <span>Reportes</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('reportes.ingreso_alumnos_registro') }}" class="menu-link">
                <i class='bx bx-bookmark'></i>
                <span>Ingreso de alumnos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('reportes.alumnos_por_grado') }}" class="menu-link">
                <i class='bx bx-user-check'></i>
                <span>Alumnos por grado</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('reportes.ingreso_punteos') }}" class="menu-link">
                <i class='bx bx-list-ul'></i>
                <span>Ingreso de punteos</span>
            </a>
        </li>
    </ul>
    <div class="letramod">
        <span>Gestiones</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('sucursales.gestion') }}" class="menu-link">
                <i class='bx bx-building'></i>
                <span>Gestión de sucursales</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('cursos.gestion') }}" class="menu-link">
                <i class='bx bx-book'></i>
                <span>Gestión de cursos y niveles</span>
            </a>
        </li>
    </ul>
    <div class="letramod">
        <span>Cursos</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('cursos.lista.visual') }}" class="menu-link">
                <i class='bx bx-show'></i>
                <span>Ver todos los cursos</span>
            </a>
        </li>
    </ul>
    <div class="letramod">
        <span>Administración</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('usuarios.index') }}" class="menu-link">
                <i class='bx bx-user'></i>
                <span>Gestión de usuarios</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('solicitudes-inscripcion.index') }}" class="menu-link">
                <i class='bx bx-envelope'></i>
                <span>Solicitudes de inscripción</span>
            </a>
        </li>
    </ul>
    <div class="footer">
        
        <div class="user">
            <div class="user-img">
                <img src="{{ asset('user.jpg') }}" alt="user">
            </div>
            <div class="user-data">
                <span class="name">{{ Auth::user()->name ?? 'Usuario' }}</span>
                <span class="email">{{ Auth::user()->email ?? '' }}</span>
            </div>
            <div class="user-icon">
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                        <i class='bx bx-log-out' title="Cerrar sesión"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="dark-mode-btn" id="dark-mode-btn">
        <i class='bx bx-moon'></i>
        <i class='bx bx-sun'></i>
    </div>
</div>