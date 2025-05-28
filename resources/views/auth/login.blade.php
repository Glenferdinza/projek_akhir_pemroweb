<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .font-inter { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
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
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.5) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
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
            transform: translateY(-5px) scale(1.01);
        }
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #ffffff;
            border-radius: 50%;
            animation: sparkle 3s infinite;
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
        
        /* Alert Styles with improved animations */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }
        .alert::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: currentColor;
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
    </style>
</head>
<body>
    <div class="hero-bg text-white px-6 py-8 min-h-screen">
        <!-- Floating Shapes Background -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        
        <!-- Particles Background -->
        <div class="absolute inset-0 overflow-hidden">
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
        
        <div class="flex items-center justify-center min-h-screen relative z-10">
            <div class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Login Form Section -->
                <div class="order-2 lg:order-1">
                    <div class="glass-effect p-8 rounded-2xl card-hover font-poppins">
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold">
                                <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Welcome</span>
                                <span class="text-white">Back</span>
                            </h1>
                            <p class="text-gray-300 mt-2">Sign in to your account</p>
                        </div>
                        
                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3"></i>
                                <div>
                                    <strong>Success!</strong>
                                    <p class="mt-1">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Error Messages -->
                        @if($errors->any())
                        <div class="alert alert-error">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-3"></i>
                                <div>
                                    <strong>Login Failed:</strong>
                                    <ul class="mt-1 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="font-semibold mb-2 block text-gray-200">
                                    <i class="fas fa-envelope mr-2"></i>Email Address
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Enter your email address" 
                                       required 
                                       class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15 @error('email') border-red-500 bg-red-500/10 @enderror">
                                @error('email')
                                    <span class="text-red-400 text-sm mt-1 block flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>
                            
                        <!-- Password Field -->
                        <div class="relative">
                            <label for="password" class="font-semibold mb-2 block text-gray-200">
                                <i class="fas fa-lock mr-2"></i>Password
                            </label>
                            <div class="relative">
                                <input type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Enter your password" 
                                    required
                                    class="w-full p-4 pr-12 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15 @error('password') border-red-500 bg-red-500/10 @enderror">
                                <button type="button" onclick="togglePassword('password')" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-all duration-300 focus:outline-none">
                                    <i class="fas fa-eye" id="eye-password"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-400 text-sm mt-1 block flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                            
                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="remember" 
                                           name="remember" 
                                           class="w-4 h-4 text-blue-600 bg-white/10 border-white/20 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="remember" class="ml-2 block text-sm text-gray-200">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-glow">
                                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                            </button>
                        </form>
                        
                        <!-- Register Link -->
                        <div class="text-center mt-6">
                            <span class="text-gray-300">Don't have an account? </span>
                            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition-colors duration-200">
                                Create Account
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Welcome Section -->
                <div class="order-1 lg:order-2 text-center lg:text-right">
                    <div class="animate-float">
                        <h2 class="text-6xl lg:text-8xl font-bold text-white mb-4">
                            New 
                        </h2>
                        <h2 class="text-6xl lg:text-8xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-8">
                            Here?
                        </h2>
                        <div class="text-white mb-10">
                            <p class="text-xl lg:text-2xl">Join us and explore the world of possibilities.</p>
                        </div>
                        <a href="{{ route('register') }}" 
                           class="inline-block px-8 py-4 bg-gradient-to-r from-blue-400 to-purple-400 text-gray-800 font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-glow">
                            <i class="fas fa-user-plus mr-2"></i>Register Now
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eye-${fieldId}`);

            if (input.type === "password") {
                input.type = "text";
                eyeIcon.className = "fas fa-eye-slash"; // Ubah ke mata tercoret
            } else {
                input.type = "password";
                eyeIcon.className = "fas fa-eye"; // Ubah ke mata terbuka
            }
        }
        // Auto-hide success/error messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.alert');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    message.style.opacity = '0';
                    message.style.transform = 'translateX(-20px)';
                    setTimeout(() => {
                        message.remove();
                    }, 500);
                }, 5000);
            });
        });

        // Add subtle animations on form focus
        document.querySelectorAll('input[type="email"], input[type="password"]').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateX(5px)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateX(0)';
            });
        });
    </script>
</body>
</html>