<div class="menu-btn sidebar-btn" id="sidebar-btn">
    <i class='bx bx-menu'></i>
    <i class='bx bx-x'></i>
</div>
<div class="sidebar" id="sidebar">
    <div class="brand">
        <img src="{{ asset('brand/CodigoIcon.jpg') }}" alt="logo">
        <span style="color: var(--color-text-primary); font-size: 1.1rem; font-weight: 600;">Profesor</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class='bx bx-home-alt-2'></i>
                <span>Inicio</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('notas.create') }}" class="menu-link">
                <i class='bx bx-edit'></i>
                <span>Ingresar punteos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('cursos.lista.visual') }}" class="menu-link">
                <i class='bx bx-show'></i>
                <span>Ver todos los cursos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('reportes.ingreso_punteos') }}" class="menu-link">
                <i class='bx bx-list-ul'></i>
                <span>Ingreso de punteos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('reportes.alumnos_por_grado') }}" class="menu-link">
                <i class='bx bx-bar-chart-square'></i>
                <span>Alumnos por grado</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('reportes.ingreso_alumnos_registro') }}" class="menu-link">
                <i class='bx bx-user-check'></i>
                <span>Ingreso alumnos registro</span>
            </a>
        </li>
        @if(!auth()->user()->profesor)
        @endif
        <li class="menu-item menu-item-static">
            <a href="{{ route('profesor.informacion-inscripcion') }}" class="menu-link">
                <i class='bx bx-id-card'></i>
                <span>Información de inscripción</span>
            </a>
        </li>
    </ul>
    <div class="footer">
        <div class="user">
            <div class="user-img">
                <img src="{{ asset('user.jpg') }}" alt="user">
            </div>
            <div class="user-data">
                <span class="name">{{ Auth::user()->name }}</span>
                <span class="email">{{ Auth::user()->email }}</span>
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
</div> 