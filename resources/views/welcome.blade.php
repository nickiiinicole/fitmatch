<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitMatch - Home</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Monomakh&family=Oswald:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/95a02bd20d.js"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar">
        <h1 class="logo">FitMatch</h1>
        <ul class="navbar-links">
            <li><a href="#hero" class="nav-link">Inicio</a></li>
            <li><a href="#reviews" class="nav-link">Opiniones</a></li>
            @auth
                <li><a href="{{ url('/home') }}" class="nav-link">Mi cuenta</a></li>
                @if (Auth::user()->role === 'admin')
                    <li><a href="{{ route('classes.index') }}" class="nav-link">Gestionar Clases</a></li>
                    <li><a href="{{ route('coaches.index') }}" class="nav-link">Gestión de Entrenadores</a></li>
                    {{-- <li><a href="{{ route('reservations.index') }}" class="nav-link">Reservas</a></li> --}}
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" id="btnLogOut" class="nav-link logout">Cerrar sesión</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="nav-link">Registrarse</a></li>
                @endif
            @endauth
        </ul>
    </nav>

    <!-- Sección Hero -->
    <section id="hero" class="hero-section">
        <div class="overlay"></div>
        <div class="contain">
            <div class="card">
                <div class="face face1">
                    <i class="fas fa-dumbbell"></i>
                    <h3>FITNESS</h3>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>
                            <span class="destacado">Fitness & Pilates</span><br> son la solución perfecta para ti!
                            Combinamos lo mejor de ambos mundos: la
                            intensidad y quema de calorías del fitness con la <span class="destacado2">tonificación,
                                flexibilidad y control
                                mental del pilates.</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face face1">
                    <i class="fas fa-dumbbell"></i>
                    <h3>RECOVERY</h3>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>
                            <span class="destacado"> Cuida tu cuerpo, relaja tu mente</span><br>Nuestra clase de
                            Recovery
                            está diseñada para ayudarte a liberar tensiones, mejorar tu flexibilidad y acelerar la
                            recuperación muscular. ¡Es el complemento perfecto para cualquier rutina de fitness

                        </p>
                    </div>
                </div>
            </div>
            <div class="titulo"><p>NUESTRAS CLASES DESTACADAS</p></div>
            <div class="card">
                <div class="face face1">
                    <i class="fas fa-dumbbell"></i>
                    <h3>BOXING</h3>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>
                            <span class="destacado">BOXING</span><br> Aprende las técnicas básicas y avanzadas del boxeo
                            mientras quemas calorías y liberas estrés<span class="destacado2">MEJORA TU CONDICIÓN
                                , QUEMA GRASA, TONIFICA</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face face1">
                    <i class="fas fa-dumbbell"></i>
                    <h3>MMA</h3>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>
                            <span class="destacado">MIXED MARTIAL ARTS</span><br> es uno de los entrenamientos más
                            completos
                            que existen. En nuestras clases, combinarás técnicas de golpeo, agarre y defensa personal
                            para desarrollar<span class="destacado2">FUERZA, RESISTENCIA
                                ,AGILIDAD</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face face1">
                    <i class="fas fa-dumbbell"></i>
                    <h3>BOOM</h3>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>
                            <span class="destacado">GLUTEBOOM</span><br> están diseñadas para activar y trabajar
                            intensamente esta zona, combinando ejercicios de fuerza, resistencia y cardio.<span
                                class="destacado2">VOLUMEN, DEFINICION, FORTALECE</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face face1">
                    <i class="fas fa-dumbbell"></i>
                    <h3>MUAY THAI</h3>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>
                            <span class="destacado">EL ARTE DE LOS OCHO MIEMBROS</span><br> Muay Thai es un deporte que
                            utiliza puños, codos, rodillas y piernas. En nuestras clases, descubrirás:<span
                                class="destacado2">Técnicas tradicionales y modernas para mejorar tu condición
                                física</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Sección Opiniones (Reviews) -->
    <section id="reviews" class="reviews-section">
        <h2 class="reviews-title">Opiniones de nuestros clientes</h2>
        <div class="review-wrapper">
            <div class="review-container">
                <div class="review-card">“Excelente gimnasio con entrenadores profesionales.”<br> <strong>- Carlos
                        M.</strong></div>
                <div class="review-card">“Me encantaron las clases de yoga, 100% recomendado.”<br> <strong>- Ana
                        R.</strong></div>
                <div class="review-card">“Ambiente increíble y buenos equipos.”<br> <strong>- Miguel T.</strong></div>
                <div class="review-card">“Las instalaciones son modernas y bien equipadas.”<br> <strong>- Laura
                        G.</strong></div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
