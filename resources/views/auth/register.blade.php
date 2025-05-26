<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.5) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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

        .bg-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
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

        <div class="flex items-center justify-center gap-25 max-w-7xl mx-auto py-8 relative z-10">
            <div class="text-left mb-8 font-poppins leading-tight reveal active">
                <span class="text-8xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent"> Welcome </span> <br>
                <div class="text-white my-10">
                    <span class="text-2xl">Create your account and start your journey with us. <br> Already have an account?</span>
                </div>
                <a href="{{ route('login') }}" class="px-10 py-4 bg-gradient-to-r from-blue-400 to-purple-400 text-gray-800 font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Login
                </a>
            </div>

            <div class="text-center mb-8 font-poppins leading-tight reveal active bg-white p-10 rounded-lg glass-effect">
                <span class="font-bold text-3xl"> <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Register</span> an Account</span>
           
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 mt-4">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle text-red-400 mt-1 mr-3"></i>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6 text-left mt-7 reveal active">
                    @csrf
                    
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-user mr-2"></i>Full Name
                        </label>
                        <input type="text" name="name" id="name" placeholder="Enter your full name" value="{{ old('name') }}" required 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        @error('name')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-envelope mr-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        @error('email')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <label for="password" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required
                                class="w-full p-4 pr-12 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-12 text-gray-400 hover:text-white">
                            <i class="fas fa-eye" id="eye-icon-password"></i>
                            <i class="fas fa-eye-slash hidden" id="eye-slash-icon-password"></i>
                        </button>
                        @error('password')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="relative">
                        <label for="password_confirmation" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-lock mr-2"></i>Confirm Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required
                                class="w-full p-4 pr-12 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-12 text-gray-400 hover:text-white">
                            <i class="fas fa-eye" id="eye-icon-password_confirmation"></i>
                            <i class="fas fa-eye-slash hidden" id="eye-slash-icon-password_confirmation"></i>
                        </button>
                        @error('password_confirmation')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-phone mr-2"></i>Phone Number <span class="text-gray-400 text-sm">(Optional)</span>
                        </label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your phone number" value="{{ old('phone') }}" 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        @error('phone')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Institution Field -->
                    <div>
                        <label for="institution" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-university mr-2"></i>Institution <span class="text-gray-400 text-sm">(Optional)</span>
                        </label>
                        <input type="text" name="institution" id="institution" placeholder="Enter your institution" value="{{ old('institution') }}" 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        @error('institution')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Student ID Field -->
                    <div>
                        <label for="student_id" class="font-semibold mb-2 block text-gray-200">
                            <i class="fas fa-id-card mr-2"></i>Student ID <span class="text-gray-400 text-sm">(Optional)</span>
                        </label>
                        <input type="text" name="student_id" id="student_id" placeholder="Enter your student ID" value="{{ old('student_id') }}" 
                            class="w-full p-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:bg-white/15">
                        @error('student_id')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 btn-glow">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </button>
                </form>
            </div>
        </div>   
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eye-icon-${fieldId}`);
            const eyeSlashIcon = document.getElementById(`eye-slash-icon-${fieldId}`);

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

        // Add reveal animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const revealElements = document.querySelectorAll('.reveal');
            revealElements.forEach(element => {
                element.classList.add('active');
            });
        });
    </script>
</body>
</html>