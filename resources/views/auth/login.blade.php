<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* Alert Styles */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-weight: 500;
        }
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
        }
        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="hero-bg text-white px-12 py-6 h-max min-h-screen">
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
        <div class="flex items-center justify-center gap-25 max-w-7xl mx-auto py-16 relative z-10">
            <div class="text-center mb-8 font-poppins leading-tight reveal active bg-white p-10 rounded-lg glass-effect">
                <span class="font-bold text-3xl"> 
                    <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Login</span> to Your Account
                </span>
                
                <!-- Display Success Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- Display Error Messages -->
                @if($errors->any())
                    <div class="alert alert-error">
                        @if($errors->has('email'))
                            {{ $errors->first('email') }}
                        @elseif($errors->has('password'))
                            {{ $errors->first('password') }}
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST" class="space-y-6 text-left mt-7 reveal active">
                    @csrf
                    <div>
                        <label for="email" class="font-semibold mb-2 block text-gray-200">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               placeholder="Email" 
                               required 
                               value="{{ old('email') }}"
                               class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15 @error('email') border-red-400 @enderror">
                        @error('email')
                            <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="password" class="font-semibold mb-2 block text-gray-200">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Password" 
                               required
                               class="w-full p-4 pr-12 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15 @error('password') border-red-400 @enderror">
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-11 text-gray-300 hover:text-white">
                            <!-- Heroicons Eye (default shown) -->
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1 1 0 010-.643C3.47 7.815 7.523 4.5 12 4.5c4.477 0 8.53 3.315 9.964 7.179a1 1 0 010 .643C20.53 16.185 16.477 19.5 12 19.5c-4.477 0-8.53-3.315-9.964-7.179z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Heroicons Eye Slash (hidden by default) -->
                            <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.507 12c1.886 4.138 6.03 7.5 10.493 7.5 1.96 0 3.79-.506 5.384-1.392M6.118 6.118A10.45 10.45 0 0112 4.5c4.477 0 8.53 3.315 9.964 7.179a10.451 10.451 0 01-4.212 5.168M6.118 6.118L17.882 17.882M6.118 6.118L17.882 17.882M3 3l18 18" />
                            </svg>
                        </button>
                        @error('password')
                            <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember" 
                               class="h-4 w-4 text-blue-600 bg-white/10 border-white/20 rounded focus:ring-blue-400 focus:ring-2">
                        <label for="remember" class="ml-2 block text-sm text-gray-200">
                            Remember me
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-glow">
                        Login
                    </button>
                    
                    <!-- Forgot Password Link -->
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-300">
                            Forgot your password?
                        </a>
                    </div>
                </form>
            </div>
            <div class="text-right mb-8 font-poppins leading-tight reveal active">
                <span class="text-8xl font-bold text-white">New </span> 
                <span class="text-8xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent"> Here? </span> 
                <br>
                <div class="text-white my-10">
                    <span class="text-2xl">Join us and explore the world of possibilities.</span>
                </div>
                <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-blue-400 to-purple-400 text-gray-800 font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Register Now
                </a>
            </div>
        </div>   
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            const eyeSlashIcon = document.getElementById("eye-slash-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.add("hidden");
                eyeSlashIcon.classList.remove("hidden");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("hidden");
                eyeSlashIcon.classList.add("hidden");
            }
        }
    </script>
</body>
</html>