<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VenBooking - Hero Section</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <section class="hero" id="hero">
        <div class="hero-background">
            <div class="gradient-overlay"></div>
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
        </div>
        
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="badge">
                        <i class="fas fa-star"></i>
                        <span>Plataforma #1 en Venezuela</span>
                    </div>
                    
                    <h1 class="hero-title">
                        Descubre Venezuela como nunca antes
                    </h1>
                    
                    <p class="hero-description">
                        La Aplicación Web más completa para reservar posadas, alquilar vehículos y 
                        encontrar paquetes turísticos únicos. Tu próxima aventura venezolana 
                        comienza aquí.
                    </p>
                    
                    <div class="features-grid">
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Posadas Únicas</h3>
                                <p>En todo el territorio nacional</p>
                            </div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Reservas Instantáneas</h3>
                                <p>Confirmación inmediata</p>
                            </div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="bg-success feature-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Vehículos Premium</h3>
                                <p>Flota moderna y segura</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="hero-visual">
                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-screen">
                                <img src="https://images.unsplash.com/photo-1592323360850-e317605f0526?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxMXx8YXBwJTIwc2NyZWVuc2hvdHxlbnwwfDB8fHwxNzI3NzgzMDE1fDA&ixlib=rb-4.0.3&q=80&w=1080" 
                                     alt="VenBooking App Interface" 
                                     class="app-screenshot">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            padding: 2rem 0;
            background: linear-gradient(135deg,rgb(130, 244, 164) 0%,rgb(46, 209, 57) 100%);
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
background: linear-gradient(135deg, 
    rgba(80, 180, 100, 0.9) 0%, 
    rgba(15, 75, 12, 0.9) 100%);

        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape-4 {
            width: 100px;
            height: 100px;
            top: 10%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            min-height: 80vh;
        }

        .hero-text {
            color: white;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: slideInDown 1s ease-out;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            animation: slideInLeft 1s ease-out 0.2s both;
        }

        .highlight {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .highlight::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            border-radius: 2px;
        }

        .hero-description {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 3rem;
            opacity: 0.9;
            animation: slideInLeft 1s ease-out 0.4s both;
        }

        .features-grid {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: slideInUp 1s ease-out 0.6s both;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
width: 60px;
height: 60px;
background: linear-gradient(45deg, #3CB371, #1E8449);
border-radius: 16px;
display: flex;
align-items: center;
justify-content: center;
font-size: 1.5rem;
color: white;
flex-shrink: 0;

        }

        .feature-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .feature-content p {
            font-size: 1.3rem;
            opacity: 0.8;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            animation: slideInUp 1s ease-out 0.8s both;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: white;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }

        .stats {
            display: flex;
            gap: 2rem;
            animation: slideInUp 1s ease-out 1s both;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #FFD700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .phone-mockup {
            position: relative;
            animation: slideInRight 1s ease-out 0.6s both;
        }

        .phone-frame {
            width: 300px;
            height: 600px;
            background: linear-gradient(145deg, #2a2a2a, #1a1a1a);
            border-radius: 40px;
            padding: 20px;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.3),
                inset 0 2px 4px rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .phone-frame::before {
            content: '';
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 6px;
            background: #333;
            border-radius: 3px;
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            border-radius: 30px;
            overflow: hidden;
            background: #000;
        }

        .app-screenshot {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 30px;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            animation: floatCard 3s ease-in-out infinite;
        }

        .card-1 {
            top: 20%;
            left: -20%;
            color: #667eea;
            animation-delay: 0s;
        }

        .card-2 {
            top: 50%;
            right: -25%;
            color: #FFD700;
            animation-delay: 1s;
        }

        .card-3 {
            bottom: 20%;
            left: -15%;
            color: #e74c3c;
            animation-delay: 2s;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .hero-visual {
                order: -1;
            }

            .phone-frame {
                width: 250px;
                height: 500px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .stats {
                justify-content: center;
            }

            .floating-card {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .features-grid {
                gap: 1rem;
            }

            .feature-item {
                padding: 0.75rem;
            }

            .phone-frame {
                width: 200px;
                height: 400px;
            }
        }
    </style>
</body>
</html>