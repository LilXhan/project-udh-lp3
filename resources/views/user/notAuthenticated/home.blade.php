@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold text-white mb-3">
                        <i class="fas fa-leaf me-2"></i>
                        Tracker de Hábitos
                    </h1>
                    <p class="lead text-light mb-4">
                        Sistema completo de seguimiento de hábitos alimenticios y actividad física. 
                        Controla tu balance calórico y construye un estilo de vida saludable.
                    </p>
                    
                    @if($user)
                        <div class="welcome-card p-4 bg-white rounded-3 mb-4 shadow">
                            <h3 class="text-success mb-2">
                                <i class="fas fa-user-circle me-2"></i>
                                ¡Bienvenido de vuelta, {{ $user->name }}!
                            </h3>
                            <p class="mb-3 text-dark">Continúa registrando tus hábitos diarios</p>
                            <a href="{{ route('habitos.index') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-chart-line me-2"></i>
                                Ver mis Hábitos
                            </a>
                        </div>
                    @else
                        <div class="auth-buttons">
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg me-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-user-plus me-2"></i>
                                Registrarse
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center">
                    <div class="feature-showcase">
                        <div class="showcase-card">
                            <i class="fas fa-balance-scale fa-4x text-white mb-3"></i>
                            <h4 class="text-white">Balance Calórico</h4>
                            <p class="text-light">Monitorea tu consumo vs gasto de calorías</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sección de Características -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-12">
                <h2 class="display-5 fw-bold text-dark mb-3">Características Principales</h2>
                <p class="lead text-muted">Herramientas completas para un estilo de vida saludable</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100 p-4 bg-white rounded-3 shadow-sm text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-apple-alt fa-3x text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Registro de Alimentos</h4>
                    <p class="text-muted">
                        Registra los alimentos que consumes diariamente con información 
                        detallada de calorías y tipos nutricionales.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card h-100 p-4 bg-white rounded-3 shadow-sm text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-running fa-3x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Actividades Físicas</h4>
                    <p class="text-muted">
                        Lleva el control de tus ejercicios y actividades físicas, 
                        incluyendo duración y calorías quemadas.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card h-100 p-4 bg-white rounded-3 shadow-sm text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-chart-pie fa-3x text-warning"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Balance Calórico</h4>
                    <p class="text-muted">
                        Visualiza tu balance calórico diario y toma decisiones 
                        informadas sobre tu salud y bienestar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección del Proyecto -->
<section class="project-section py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="project-info">
                    <h2 class="display-5 fw-bold text-primary mb-4">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Proyecto Académico
                    </h2>
                    <div class="project-details">
                        <div class="detail-item mb-3">
                            <h5 class="fw-bold text-dark">
                                <i class="fas fa-university me-2 text-primary"></i>
                                Universidad de Huánuco
                            </h5>
                            <p class="text-muted mb-0">Facultad de Ingeniería - Escuela Académica Profesional de Ingeniería de Sistemas</p>
                        </div>
                        
                        <div class="detail-item mb-3">
                            <h5 class="fw-bold text-dark">
                                <i class="fas fa-code me-2 text-success"></i>
                                Lenguaje de Programación III
                            </h5>
                            <p class="text-muted mb-0">Desarrollo web con Laravel Framework y tecnologías modernas</p>
                        </div>
                        
                        <div class="detail-item mb-3">
                            <h5 class="fw-bold text-dark">
                                <i class="fas fa-calendar-alt me-2 text-info"></i>
                                Periodo Académico 2025
                            </h5>
                            <p class="text-muted mb-0">Primer semestre - Julio 2025</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="tech-stack">
                    <h3 class="fw-bold text-center mb-4">Stack Tecnológico</h3>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="tech-card p-3 bg-danger text-white rounded text-center">
                                <i class="fab fa-laravel fa-2x mb-2"></i>
                                <h6 class="fw-bold">Laravel 10</h6>
                                <small>Framework PHP</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="tech-card p-3 bg-primary text-white rounded text-center">
                                <i class="fab fa-bootstrap fa-2x mb-2"></i>
                                <h6 class="fw-bold">Bootstrap 5</h6>
                                <small>Framework CSS</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="tech-card p-3 bg-warning text-dark rounded text-center">
                                <i class="fab fa-js-square fa-2x mb-2"></i>
                                <h6 class="fw-bold">JavaScript</h6>
                                <small>Interactividad</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="tech-card p-3 bg-dark text-white rounded text-center">
                                <i class="fas fa-database fa-2x mb-2"></i>
                                <h6 class="fw-bold">MySQL</h6>
                                <small>Base de datos</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="tech-card p-3 bg-secondary text-white rounded text-center">
                                <i class="fab fa-php fa-2x mb-2"></i>
                                <h6 class="fw-bold">PHP 8+</h6>
                                <small>Backend</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="tech-card p-3 bg-success text-white rounded text-center">
                                <i class="fas fa-cogs fa-2x mb-2"></i>
                                <h6 class="fw-bold">MVC</h6>
                                <small>Arquitectura</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer de presentación -->
<footer class="presentation-footer py-4 bg-dark text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h5 class="fw-bold mb-2">
                    <i class="fas fa-leaf me-2"></i>
                    Tracker de Hábitos - Sistema de Gestión de Hábitos Saludables
                </h5>
                <p class="mb-2">Desarrollado como proyecto final para Lenguaje de Programación III</p>
                <p class="text-muted mb-0">
                    <i class="fas fa-university me-1"></i>
                    Universidad de Huánuco - {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .hero-section {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 50%, #2ecc71 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.2);
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .welcome-card {
        border-left: 5px solid #28a745;
        backdrop-filter: blur(10px);
    }
    
    .feature-showcase {
        position: relative;
        z-index: 2;
    }
    
    .showcase-card {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 20px;
        padding: 2.5rem;
        transition: transform 0.3s ease;
    }
    
    .showcase-card:hover {
        transform: translateY(-10px);
        background: rgba(255,255,255,0.2);
    }
    
    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .tech-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .tech-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .detail-item {
        padding: 1.5rem;
        border-left: 4px solid #007bff;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 0 12px 12px 0;
        transition: transform 0.3s ease;
    }
    
    .detail-item:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-lg {
        padding: 0.875rem 2.5rem;
        font-size: 1.1rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .btn-outline-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255,255,255,0.3);
    }
    
    .auth-buttons .btn {
        min-width: 200px;
    }
    
    .features-section {
        background: linear-gradient(to bottom, #f8f9fa, #ffffff);
    }
    
    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 0;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
        
        .auth-buttons {
            text-align: center;
        }
        
        .auth-buttons .btn {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
            margin-right: 0 !important;
        }
        
        .auth-buttons .btn:last-child {
            margin-bottom: 0;
        }
        
        .showcase-card {
            margin-top: 2rem;
        }
    }
</style>
@endsection