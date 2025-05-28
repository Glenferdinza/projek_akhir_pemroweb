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
                <a href="{{ route('login') }}" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-sky-400 text-gray-900 font-semibold rounded-full shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] transition-all duration-300 transform hover:scale-120 glow-effect">
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
                <a href="/browse" class="btn-glow px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-400 text-gray-900 font-semibold rounded-full shadow-[0_0_30px_rgba(34,197,94,0.4)] hover:shadow-[0_0_50px_rgba(34,197,94,0.6)] transition-all duration-300 transform hover:scale-105 glow-effect">
                    View Created Events
                </a>
                <a href="/create" class="btn-glow px-8 py-4 bg-gradient-to-r from-blue-500 to-sky-400 text-gray-900 font-semibold rounded-full shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] transition-all duration-300 transform hover:scale-105 glow-effect">
                    Create an Event
                </a>
            </div>
        </div>   
    </header>

    <div class="w-full overflow-x-hidden overflow-y-hidden px-4 relative transform z-50 -translate-y-48">
            <div class="flex flex-row flex-nowrap justify-center items-center gap-8 mt-16 relative z-10 reveal">
                <div class="snap-center shrink-0 relative max-w-[600px] max-h-[800px] rounded-3xl overflow-hidden shadow-2xl animate-float floating-icon transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('images/compe.jpg') }}" alt="Kompetisi" class="w-full h-full object-contain mx-auto my-auto rounded-3xl">
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-sm font-bold animate-bounce">🏆</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white p-4">
                        <h3 class="text-lg font-semibold">Kompetisi UX</h3>
                        <p class="text-sm">Bandung, 12 Juni 2025</p>
                        <span class="text-xs mt-1 block">80K joined</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="snap-center shrink-0 relative max-w-[600px] max-h-[1800px] rounded-3xl overflow-hidden shadow-2xl animate-float-delayed floating-icon transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('images/semin.jpg') }}" alt="Seminar" class="w-full h-full object-contain mx-auto my-auto rounded-3xl">
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center text-sm font-bold animate-bounce">📚</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white p-4">
                        <h3 class="text-lg font-semibold">Start Design Sprint</h3>
                        <p class="text-sm">Jakarta, 20 Mei 2022</p>
                        <span class="text-xs mt-1 block">120K joined</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="snap-center shrink-0 relative max-w-[600px] max-h-[800px] rounded-3xl overflow-hidden shadow-2xl animate-float floating-icon transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('images/ws.jpg') }}" alt="Workshop" class="w-full h-full object-contain mx-auto my-auto rounded-3xl">
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-green-400 rounded-full flex items-center justify-center text-sm font-bold animate-bounce">🛠</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white p-4">
                        <h3 class="text-lg font-semibold">Workshop AI</h3>
                        <p class="text-sm">Yogyakarta, 28 Juni 2025</p>
                        <span class="text-xs mt-1 block">95K joined</span>
                    </div>
                </div>
            </div>
        </div>

    <!-- Section Transition -->
    <div class="section-transition h-16"></div>

    <section class="about px-8 bg-white relative overflow-hidden" id="about">
        <!-- Background decorations -->
        <div class="absolute top-10 right-10 w-32 h-32 bg-gradient-to-br from-blue-200 to-purple-200 rounded-full opacity-20 animate-float"></div>
        <div class="absolute bottom-10 left-10 w-24 h-24 bg-gradient-to-br from-pink-200 to-red-200 rounded-full opacity-20 animate-float-delayed"></div>
        
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 relative z-10">
            <div class="about-img w-full lg:w-1/2 reveal">
                <div class="relative group">
                    <img src="{{ asset('images/about.jpg') }}" alt="about" class="w-full h-96 object-cover rounded-3xl shadow-2xl image-hover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full opacity-30 animate-pulse group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="absolute -bottom-6 -left-6 w-12 h-12 bg-gradient-to-br from-pink-500 to-red-600 rounded-full opacity-30 animate-pulse group-hover:scale-110 transition-transform duration-300" style="animation-delay: 1s;"></div>
                </div>
            </div>
            <div class="about-content w-full lg:w-1/2 space-y-6 reveal">
                <div class="space-y-4">
                    <span class="bg-gradient-to-r from-pink-500 to-violet-500 bg-clip-text text-transparent font-bold text-xl uppercase tracking-wider">About this Platform</span>
                    <h2 class="font-bold text-5xl font-poppins leading-tight text-gray-800">
                        Empowering Students <br> 
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Through Events</span>
                    </h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed">
                    This platform helps students discover and create off-campus events like competitions, seminars, and workshops. 
                    We aim to empower student communities through accessible, easy-to-manage event sharing that connects passionate learners.
                </p>
                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center animate-pulse">📈</div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center animate-pulse" style="animation-delay: 0.5s;">🎯</div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center animate-pulse" style="animation-delay: 1s;">🚀</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Transition -->
    <div class="section-transition h-32"></div>

    <section class="why-us py-20 px-8 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 relative overflow-hidden" id="why-us">
        <!-- Animated background shapes -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-20 w-40 h-40 bg-gradient-to-r from-blue-300 to-cyan-300 rounded-full opacity-10 animate-float"></div>
            <div class="absolute top-40 right-20 w-32 h-32 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full opacity-10 animate-float-delayed"></div>
            <div class="absolute bottom-20 left-40 w-28 h-28 bg-gradient-to-r from-green-300 to-teal-300 rounded-full opacity-10 animate-float"></div>
        </div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="bg-gradient-to-r from-pink-500 to-violet-500 bg-clip-text text-transparent font-bold text-xl uppercase tracking-wider">Why Choose Us?</span>
                <h2 class="font-bold text-5xl font-poppins mt-4 text-gray-800">What Makes Us <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Different?</span></h2>
                <p class="text-gray-600 mt-4 text-lg">Discover the features that set us apart from the rest</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card-hover glass-effect rounded-3xl p-8 text-center shadow-xl reveal group">
                    <div class="mb-6 relative">
                        <img src="{{ asset('images/easy.png') }}" alt="easy" class="w-20 h-20 mx-auto mb-4 animate-float group-hover:scale-110 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-blue-500 rounded-full mx-auto opacity-20 -mt-16 animate-pulse group-hover:opacity-40 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="font-bold text-2xl mb-4 text-gray-800 font-poppins group-hover:text-blue-600 transition-colors duration-300">Easy to Use</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">Our platform is user-friendly with intuitive design, making it effortless to create and manage events.</p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-gradient-to-r from-green-500 to-blue-500 rounded-full" style="width: 95%;"></div>
                        </div>
                        <span class="text-sm text-gray-500 mt-1 block">95% User Satisfaction</span>
                    </div>
                </div>
                
                <div class="card-hover glass-effect rounded-3xl p-8 text-center shadow-xl reveal group" style="animation-delay: 0.2s;">
                    <div class="mb-6 relative">
                        <img src="{{ asset('images/wide.png') }}" alt="wide" class="w-20 h-20 mx-auto mb-4 animate-float-delayed group-hover:scale-110 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full mx-auto opacity-20 -mt-16 animate-pulse group-hover:opacity-40 transition-opacity duration-300" style="animation-delay: 1s;"></div>
                    </div>
                    <h3 class="font-bold text-2xl mb-4 text-gray-800 font-poppins group-hover:text-purple-600 transition-colors duration-300">Wide Range</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">We offer a diverse selection of events, ensuring there's something for every interest and passion.</p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="flex justify-center space-x-2">
                            <span class="px-2 py-1 bg-purple-100 text-purple-600 text-xs rounded-full">Competitions</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-full">Seminars</span>
                            <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">Workshops</span>
                        </div>
                    </div>
                </div>
                
                <div class="card-hover glass-effect rounded-3xl p-8 text-center shadow-xl reveal group" style="animation-delay: 0.4s;">
                    <div class="mb-6 relative">
                        <img src="{{ asset('images/community.png') }}" alt="community" class="w-20 h-20 mx-auto mb-4 animate-float group-hover:scale-110 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-red-500 rounded-full mx-auto opacity-20 -mt-16 animate-pulse group-hover:opacity-40 transition-opacity duration-300" style="animation-delay: 2s;"></div>
                    </div>
                    <h3 class="font-bold text-2xl mb-4 text-gray-800 font-poppins group-hover:text-orange-600 transition-colors duration-300">Community Driven</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">Built by students, for students, fostering genuine community connections and collaboration.</p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="flex justify-center items-center space-x-1">
                            <span class="text-2xl">👥</span>
                            <span class="text-sm text-gray-600">10,000+ Active Students</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Transition -->
    <div class="section-transition h-32"></div>

    <section class="contact py-20 px-8 bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 text-white relative overflow-hidden" id="contact">
        <!-- Background Particles -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="particle" style="left: 15%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 85%; top: 30%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 25%; top: 60%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 75%; top: 70%; animation-delay: 6s;"></div>
            <div class="particle" style="left: 45%; top: 25%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 65%; top: 85%; animation-delay: 3s;"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="bg-gradient-to-r from-pink-400 to-violet-400 bg-clip-text text-transparent font-bold text-xl uppercase tracking-wider">Contact Us</span>
                <h2 class="font-bold text-5xl font-poppins mt-4">Get in <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Touch</span></h2>
                <p class="text-gray-300 mt-4 text-lg">We'd love to hear from you. Send us a message!</p>
            </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 reveal">
                    @csrf
                    
                    <!-- Display Success Message -->
                    @if(session('success'))
                        <div class="bg-green-500/20 border border-green-400 text-green-300 px-4 py-3 rounded-xl mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div>
                        <label for="name" class="font-semibold mb-2 block text-gray-200">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="font-semibold mb-2 block text-gray-200">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="message" class="font-semibold mb-2 block text-gray-200">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Your Message" required 
                                class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 resize-none hover:bg-white/15">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-glow">
                        Send Message
                    </button>
                </form>
                
                <!-- Bagian kedua dari grid bisa diisi dengan konten lain -->
                <div class="reveal">
                    <!-- Contact info atau konten lainnya -->
                
                <div class="space-y-8 reveal">
                    <div class="glass-effect rounded-3xl p-8">
                        <h4 class="font-bold text-2xl mb-4 font-poppins">Contact Information</h4>
                        <p class="text-gray-300 mb-8 leading-relaxed">
                            If you have any questions or feedback, feel free to reach out to us! We're here to help you create amazing events.
                        </p>
                        
                        <div class="grid grid-cols-3 gap-4">
                            <a class="card-hover text-center p-6 bg-gradient-to-br from-gray-800 to-black rounded-2xl group transform transition-all duration-300" href="#">
                                <img src="{{ asset('images/email.png') }}" alt="Email" class="w-12 h-12 mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium">Email Us</span>
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 mt-2">
                                    <div class="w-full h-1 bg-blue-400 rounded"></div>
                                </div>
                            </a>
                            <a class="card-hover text-center p-6 bg-gradient-to-br from-green-600 to-green-700 rounded-2xl group transform transition-all duration-300" href="#">
                                <img src="{{ asset('images/telp.png') }}" alt="Phone" class="w-12 h-12 mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium">Call Us</span>
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 mt-2">
                                    <div class="w-full h-1 bg-green-400 rounded"></div>
                                </div>
                            </a>
                            <a class="card-hover text-center p-6 bg-gradient-to-br from-pink-600 to-red-600 rounded-2xl group transform transition-all duration-300" href="#">
                                <img src="{{ asset('images/ig.png') }}" alt="Instagram" class="w-12 h-12 mx-auto mb-3 rounded-full group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium">Follow Us</span>
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 mt-2">
                                    <div class="w-full h-1 bg-pink-400 rounded"></div>
                                </div>
                            </a>
                        </div>

                        <div class="mt-8 p-6 bg-white/5 rounded-2xl">
                            <h5 class="font-semibold mb-3 text-gray-200">Quick Stats</h5>
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div class="bg-blue-500/20 rounded-lg p-3">
                                    <div class="text-2xl font-bold text-blue-400">1000+</div>
                                    <div class="text-xs text-gray-300">Events Created</div>
                                </div>
                                <div class="bg-green-500/20 rounded-lg p-3">
                                    <div class="text-2xl font-bold text-green-400">50K+</div>
                                    <div class="text-xs text-gray-300">Students Connected</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
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
                            <form action="{{ route('subscribe') }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="email" name="email" placeholder="Enter your email" required 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('email') }}">
                                <button type="submit" class="px-6 py-2 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                                    Subscribe
                                </button>
                            </form>

                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
