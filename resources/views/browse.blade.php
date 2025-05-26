<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portalis - Student Event Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.5) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }

        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        .animate-gradient {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.25);
        }

        .bg-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #ffffff;
            border-radius: 50%;
            animation: sparkle 3s infinite;
        }

        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(to right, #3b82f6, #06b6d4, #10b981);
            z-index: 1000;
            transition: width 0.1s ease;
        }

        .navbar {
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 30%, #334155 70%, #475569 100%);
            position: relative;
            overflow: hidden;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.15;
        }

        .shape-1 {
            top: 20%;
            left: 10%;
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #3b82f6, #06b6d4);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            top: 60%;
            right: 15%;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #f59e0b, #ef4444);
            transform: rotate(45deg);
            animation: float 6s ease-in-out infinite reverse;
        }

        .shape-3 {
            bottom: 20%;
            left: 20%;
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #10b981, #059669);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: float 10s ease-in-out infinite;
        }

        .image-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .image-hover:hover {
            transform: scale(1.08) rotate(1deg);
            filter: brightness(1.1) saturate(1.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1f2937;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #06b6d4);
            border-radius: 4px;
        }

        .section-transition {
            background: linear-gradient(180deg, transparent 0%, rgba(59, 130, 246, 0.05) 50%, transparent 100%);
        }

        .typing-effect {
            border-right: 2px solid #3b82f6;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 50% { border-right-color: transparent; }
            51%, 100% { border-right-color: #3b82f6; }
        }

        .morphing-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab, #667eea, #764ba2);
            background-size: 600% 600%;
            animation: gradientShift 20s ease infinite;
        }

        .floating-icon {
            animation: float 4s ease-in-out infinite;
        }

        .floating-icon:nth-child(2) { animation-delay: 1s; }
        .floating-icon:nth-child(3) { animation-delay: 2s; }

        .glow-effect {
            animation: glow 2s ease-in-out infinite alternate;
        }

        .parallax {
            transform: translateZ(0);
        }
    </style>
</head>
<body class="bg-gray-50 font-inter text-gray-900 overflow-x-hidden">
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator"></div>

    <header id="home" class="hero-bg text-white px-8 py-4 text-center h-200 relative z-50">
        <!-- Floating Shapes Background -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <!-- Particles Background -->
        <div class="bg-particles">
            <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; top: 30%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 30%; top: 40%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 40%; top: 50%; animation-delay: 3s;"></div>
            <div class="particle" style="left: 50%; top: 60%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 60%; top: 70%; animation-delay: 5s;"></div>
            <div class="particle" style="left: 70%; top: 80%; animation-delay: 6s;"></div>
            <div class="particle" style="left: 80%; top: 25%; animation-delay: 7s;"></div>
            <div class="particle" style="left: 90%; top: 35%; animation-delay: 8s;"></div>
        </div>

        <nav class="navbar fixed top-0 left-0 right-0 z-50 flex justify-between items-center px-8 py-6">
            <a class="logo" href="#">
                <div class="text-3xl font-bold morphing-bg bg-clip-text text-transparent font-poppins">Portalis</div>
            </a>
            <div class="nav-links space-x-8">
                <a href="#home" class="font-medium hover:text-blue-400 transition-all duration-300 relative group">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-400 to-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#about" class="font-medium hover:text-blue-400 transition-all duration-300 relative group">
                    About
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-400 to-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#why-us" class="font-medium hover:text-blue-400 transition-all duration-300 relative group">
                    Why Us?
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-400 to-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#contact" class="font-medium hover:text-blue-400 transition-all duration-300 relative group">
                    Contact
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-400 to-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
            <div class="">
                <a href="#login" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-sky-400 text-gray-900 font-semibold rounded-full shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] transition-all duration-300 transform hover:scale-120 glow-effect">
                    Login
                </a>
            </div>
        </nav>

        <div class="hero max-w-6xl mx-auto py-32 relative z-10">
            <div class="text-7xl font-bold mb-8 font-poppins leading-tight reveal">
                <span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent">Manage</span>
                <span class="text-white"> and </span>
                <span class="bg-gradient-to-r from-pink-400 via-purple-400 to-pink-500 bg-clip-text text-transparent">Explore</span>
                <div class="mt-4">
                    <span class="text-white">Student Events </span>
                    <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent typing-effect">Easily</span>
                </div>
            </div>

            <p class="text-xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed reveal">
                Browse exciting competitions, seminars, and workshops or create and manage your own events to share with others. 
                Join a community of passionate students making things happen.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center reveal">
                <a href="{{ asset('/') }}" class="btn-glow px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-400 text-gray-900 font-semibold rounded-full shadow-[0_0_30px_rgba(34,197,94,0.4)] hover:shadow-[0_0_50px_rgba(34,197,94,0.6)] transition-all duration-300 transform hover:scale-105 glow-effect">
                    Back to Homepage
                </a>
                </a>
                <a href="#create-event" class="btn-glow px-8 py-4 bg-gradient-to-r from-blue-500 to-sky-400 text-gray-900 font-semibold rounded-full shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] transition-all duration-300 transform hover:scale-105 glow-effect">
                    Create an Event
                </a>
            </div>
        </div>   
    </header>

    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-16 px-8 relative overflow-hidden">
        <!-- Background particles -->
        <div class="absolute inset-0">
            <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 90%; top: 30%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 30%; top: 80%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 70%; top: 60%; animation-delay: 6s;"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="text-3xl font-bold morphing-bg bg-clip-text text-transparent font-poppins mb-4">Portalis</div>
                    <p class="text-gray-300 leading-relaxed mb-6">
                        Connecting students through amazing events. Create, discover, and participate in competitions, seminars, and workshops that shape your future.
                    </p>
                    <div class="flex space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300 cursor-pointer">
                            <span class="text-xl">📧</span>
                        </div>
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300 cursor-pointer">
                            <span class="text-xl">📱</span>
                        </div>
                        <div class="w-12 h-12 bg-pink-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300 cursor-pointer">
                            <span class="text-xl">📷</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-xl mb-6 text-gray-100">Platform</h4>
                    <div class="space-y-3">
                        <a href="#create-event" class="block text-gray-300 hover:text-blue-400 transition-colors duration-300">Create Event</a>
                        <a href="#" class="block text-gray-300 hover:text-blue-400 transition-colors duration-300">Browse Events</a>
                        <a href="#contact" class="block text-gray-300 hover:text-blue-400 transition-colors duration-300">Support</a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-xl mb-6 text-gray-100">Company</h4>
                    <div class="space-y-3">
                        <a href="#about" class="block text-gray-300 hover:text-blue-400 transition-colors duration-300">About</a>
                        <a href="#contact" class="block text-gray-300 hover:text-blue-400 transition-colors duration-300">Contact</a>
                        <a href="#" class="block text-gray-300 hover:text-blue-400 transition-colors duration-300">Terms</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center border-t border-gray-700 pt-8">
                <div>
                    <h4 class="font-bold text-xl mb-4 text-gray-100">Our Location</h4>
                    <div class="bg-gray-800 rounded-2xl p-4 hover:bg-gray-700 transition-colors duration-300">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63337.65139741951!2d110.3308366!3d-7.7955797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57896162388d%3A0x3027a76e352bd70!2sYogyakarta!5e0!3m2!1sen!2sid!4v1687768899045!5m2!1sen!2sid" 
                            width="100%" 
                            height="200" 
                            style="border:0; border-radius:12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <p class="text-gray-300 mt-3 text-center">📍 Based in Sleman, Yogyakarta, Indonesia</p>
                    </div>
                </div>
                
                <div class="text-center lg:text-right">
                    <div class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-6">
                        <h5 class="font-bold text-xl mb-2">Join Our Community!</h5>
                        <p class="text-sm mb-4 opacity-90">Get notified about new events</p>
                        <div class="flex space-x-2">
                            <input type="email" placeholder="Enter your email" 
                                   class="flex-1 px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
                            <button class="px-6 py-2 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12 pt-8 border-t border-gray-700">
                <p class="text-gray-400">&copy; 2025 Portalis. All rights reserved. Made by Portalis Team </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for Animations and Interactions -->
    <script>
        // Scroll Progress Indicator
        window.addEventListener('scroll', () => {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            document.querySelector('.scroll-indicator').style.width = scrolled + '%';
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Reveal Animation on Scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => {
            observer.observe(el);
        });

        // Smooth Scrolling for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Dynamic Particles
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 3 + 's';
            
            document.querySelectorAll('.bg-particles').forEach(container => {
                if (container.children.length < 15) {
                    container.appendChild(particle.cloneNode());
                }
            });
        }

        // Add more particles periodically
        setInterval(createParticle, 2000);

        // Form Enhancement
        const formInputs = document.querySelectorAll('input, textarea, select');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Typing Effect for Hero Text
        const heroText = document.querySelector('.typing-effect');
        if (heroText) {
            let isVisible = true;
            setInterval(() => {
                heroText.style.borderRightColor = isVisible ? 'transparent' : '#3b82f6';
                isVisible = !isVisible;
            }, 500);
        }

        // Interactive Cards
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.03)';
                this.style.boxShadow = '0 30px 60px -12px rgba(0, 0, 0, 0.25)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '';
            });
        });

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>
