<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.rateyo.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/newstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
</head>

<body>
    <header class="site-header">
        <div class="top-header">
            <div class="container">
                <div class="top-header-content">
                    <div class="support-info">
                        <i class="fas fa-envelope support-icon"></i>
                        <a href="mailto:venbooking@gmail.com" class="support-email">
                            Soporte Técnico: venbooking@gmail.com
                        </a>
                    </div>
                    <a href="#" id="logout-btn" class="login-btn p-2">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container">
                <div class="header-content">
                    <!-- Logo -->
                    <div class="logo-section">
                            <img src="./Assets/Images/logo.png" alt="logo" style="width: 50px; height: 70px; object-fit: cover;">
                        <div class="logo-text">
                            <h1 class="brand-name">VenBooking</h1>
                            <p class="brand-tagline">Tu destino perfecto</p>
                        </div>
                    </div>
                    <nav class="desktop-nav">
                        <ul class="nav-menu">
                            <li class="nav-item">
                                <a href="./Includes/Inicio.php" class="nav-link">
                                    <i class="fas fa-cogs"></i> Volver al Panel de Control
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu" id="mobileMenu">
                <div class="mobile-menu-content">
                    <nav class="mobile-nav">
                        <li class="nav-item">
                            <a href="./Includes/Inicio.php" class="mobile-nav-link">
                                <i class="fas fa-cogs"></i> Volver al Panel de Control
                            </a>
                        </li>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <script>
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Estás a punto de cerrar sesión",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#D2D2D2',
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = './Includes/logout.php';
            }
        })
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        let isMenuOpen = false;

        // Toggle mobile menu
        mobileMenuBtn.addEventListener('click', function() {
            isMenuOpen = !isMenuOpen;

            if (isMenuOpen) {
                mobileMenuBtn.classList.add('active');
                mobileMenu.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
            } else {
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = ''; // Restore scrolling
            }
        });

        // Close menu when clicking on a link
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                isMenuOpen = false;
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (isMenuOpen && !mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event
                    .target)) {
                isMenuOpen = false;
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && isMenuOpen) {
                isMenuOpen = false;
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Smooth scroll for anchor links
        const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Add scroll effect to header
        let lastScrollTop = 0;
        const header = document.querySelector('.site-header');

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop;
        });

        // Add loading animation to feature cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe feature cards for animation
        const featureCards = document.querySelectorAll('.feature-card');
        featureCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition =
                `opacity 0.6s ease ${index * 0.2}s, transform 0.6s ease ${index * 0.2}s`;
            observer.observe(card);
        });

        // Add ripple effect to buttons
        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');

            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        }

        // Add ripple effect styles
        const style = document.createElement('style');
        style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 600ms linear;
            background-color: rgba(255, 255, 255, 0.6);
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .login-btn, .nav-link, .mobile-nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .site-header.scrolled {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }
        
        .site-header.scrolled .main-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    `;
        document.head.appendChild(style);

        // Add ripple effect to interactive elements
        const interactiveElements = document.querySelectorAll('.login-btn, .nav-link, .mobile-nav-link');
        interactiveElements.forEach(element => {
            element.addEventListener('click', createRipple);
        });

        // Add typing effect to brand tagline
        const tagline = document.querySelector('.brand-tagline');
        const originalText = tagline.textContent;
        tagline.textContent = '';

        let i = 0;

        function typeWriter() {
            if (i < originalText.length) {
                tagline.textContent += originalText.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }

        // Start typing effect after a short delay
        setTimeout(typeWriter, 1000);

        // Add parallax effect to hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                heroSection.style.transform = `translateY(${scrolled * 0.1}px)`;
            }
        });

        // Add hover sound effect (optional - requires audio files)
        const playHoverSound = () => {
            // Uncomment and add audio file if desired
            // const audio = new Audio('hover-sound.mp3');
            // audio.volume = 0.1;
            // audio.play().catch(() => {}); // Ignore errors if audio fails
        };

        // Add hover effects with sound
        const hoverElements = document.querySelectorAll(
            '.nav-link, .mobile-nav-link, .login-btn, .feature-card');
        hoverElements.forEach(element => {
            element.addEventListener('mouseenter', playHoverSound);
        });
    });
    </script>
</body>

</html>