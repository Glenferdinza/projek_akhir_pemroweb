<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.5) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
    <div class="hero-bg text-white px-12 py-6 h-screen min-h-screen">
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
        
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md">
                <div class="text-center mb-8 font-poppins glass-effect p-8 rounded-xl">
                    <h1 class="text-3xl font-bold mb-4">
                        <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Reset Password</span>
                    </h1>
                    <p class="text-gray-300 mb-6">
                        Enter your new password below.
                    </p>
                    
                    <!-- Display Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-error">
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @elseif($errors->has('password'))
                                {{ $errors->first('password') }}
                            @elseif($errors->has('token'))
                                {{ $errors->first('token') }}
                            @else
                                {{ $errors->first() }}
                            @endif
                        </div>
                    @endif
                    
                    <form action="{{ route('password.update') }}" method="POST" class="space-y-6 text-left">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        
                        <div>
                            <label for="email_display" class="font-semibold mb-2 block text-gray-200">Email Address</label>
                            <input type="email" 
                                   id="email_display" 
                                   value="{{ $email }}" 
                                   disabled
                                   class="w-full p-4 bg-white/5 border border-white/10 rounded-xl text-gray-400 cursor-not-allowed">
                        </div>
                        
                        <div class="relative">
                            <label for="password" class="font-semibold mb-2 block text-gray-200">New Password</label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Enter new password" 
                                   required
                                   class="w-full p-4 pr-12 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15 @error('password') border-red-400 @enderror">
                            <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-11 text-gray-300 hover:text-white">
                                <svg id="eye-icon-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1 1 0 010-.643C3.47 7.815 7.523 4.5 12 4.5c4.477 0 8.53 3.315 9.964 7.179a1 1 0 010 .643C20.53 16.185 16.477 19.5 12 19.5c-4.477 0-8.53-3.315-9.964-7.179z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eye-slash-icon-password" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.507 12c1.886 4.138 6.03 7.5 10.493 7.5 1.96 0 3.79-.506 5.384-1.392M6.118 6.118A10.45 10.45 0 0112 4.5c4.477 0 8.53 3.315 9.964 7.179a10.451 10.451 0 01-4.212 5.168M6.118 6.118L17.882 17.882M6.118 6.118L17.882 17.882M3 3l18 18" />
                                </svg>
                            </button>
                            @error('password')
                                <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="relative">
                            <label for="password_confirmation" class="font-semibold mb-2 block text-gray-200">Confirm New Password</label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Confirm new password" 
                                   required
                                   class="w-full p-4 pr-12 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-4 top-11 text-gray-300 hover:text-white">
                                <svg id="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1 1 0 010-.643C3.47 7.815 7.523 4.5 12 4.5c4.477 0 8.53 3.315 9.964 7.179a1 1 0 010 .643C20.53 16.185 16.477 19.5 12 19.5c-4.477 0-8.53-3.315-9.964-7.179z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eye-slash-icon-confirm" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.507 12c1.886 4.138 6.03 7.5 10.493 7.5 1.96 0 3.79-.506 5.384-1.392M6.118 6.118A10.45 10.45 0 0112 4.5c4.477 0 8.53 3.315 9.964 7.179a10.451 10.451 0 01-4.212 5.168M6.118 6.118L17.882 17.882M6.118 6.118L17.882 17.882M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        
                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-glow">
                            Reset Password
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center">
                        <p class="text-gray-300">
                            Remember your password? 
                            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition-colors duration-300 font-semibold">
                                Back to Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eye-icon-${fieldId === 'password' ? 'password' : 'confirm'}`);
            const eyeSlashIcon = document.getElementById(`eye-slash-icon-${fieldId === 'password' ? 'password' : 'confirm'}`);
            
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