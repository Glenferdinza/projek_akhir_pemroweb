<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        .font-inter { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        /* Enhanced Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(1deg); }
            66% { transform: translateY(-5px) rotate(-1deg); }
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.3) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            50% { box-shadow: 0 0 0 20px rgba(59, 130, 246, 0); }
        }

        /* Background Styles */
        .hero-bg {
            background: linear-gradient(135deg, 
                #0f0f23 0%, 
                #1a1a2e 25%, 
                #16213e 50%, 
                #0f3460 75%, 
                #e94560 100%);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
            position: relative;
            overflow: hidden;
        }

        /* Glass Morphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        /* Enhanced Floating Shapes */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            filter: blur(1px);
        }

        .shape-1 {
            top: 10%;
            left: 5%;
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            animation: float 12s ease-in-out infinite;
        }

        .shape-2 {
            top: 50%;
            right: 10%;
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .shape-3 {
            bottom: 15%;
            left: 15%;
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            transform: rotate(45deg);
            animation: float 10s ease-in-out infinite;
            animation-delay: 3s;
        }

        .shape-4 {
            top: 30%;
            left: 80%;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            border-radius: 50%;
            animation: float 14s ease-in-out infinite;
            animation-delay: 5s;
        }

        /* Particles */
        .bg-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 2;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: linear-gradient(45deg, #ffffff, #a78bfa);
            border-radius: 50%;
            animation: sparkle 4s infinite;
        }

        /* Form Enhancements */
        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .form-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(99, 102, 241, 0.6);
            box-shadow: 
                0 0 0 3px rgba(99, 102, 241, 0.1),
                0 8px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .form-input:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .form-input.error {
            border-color: rgba(239, 68, 68, 0.6);
            background: rgba(239, 68, 68, 0.05);
            animation: pulse 2s infinite;
        }

        /* Button Enhancements */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 25px rgba(240, 147, 251, 0.4);
        }

        /* Loading Animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading .btn-primary {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Success/Error Messages */
        .alert {
            animation: slideUp 0.5s ease-out;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                gap: 2rem;
            }
            
            .welcome-section {
                text-align: center;
            }
            
            .shape {
                opacity: 0.05;
            }
        }

        /* Enhanced Password Strength Indicator */
        .password-strength {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-top: 8px;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-toggle {
        cursor: pointer;
        user-select: none;
        transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: #3b82f6 !important;
            transform: scale(1.1);
        }

        .password-toggle i {
            transition: all 0.3s ease;
        }

        .strength-weak { width: 25%; background: #ef4444; }
        .strength-fair { width: 50%; background: #f59e0b; }
        .strength-good { width: 75%; background: #3b82f6; }
        .strength-strong { width: 100%; background: #10b981; }
    </style>
</head>
<body>
    <div class="hero-bg min-h-screen text-white">
        <!-- Enhanced Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>

        <!-- Enhanced Particles -->
        <div class="bg-particles">
            <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 25%; top: 30%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 40%; top: 15%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 60%; top: 45%; animation-delay: 3s;"></div>
            <div class="particle" style="left: 75%; top: 25%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 85%; top: 60%; animation-delay: 5s;"></div>
            <div class="particle" style="left: 15%; top: 70%; animation-delay: 6s;"></div>
            <div class="particle" style="left: 90%; top: 80%; animation-delay: 7s;"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <div class="hero-container flex items-center justify-center gap-12 min-h-screen">
                <!-- Welcome Section -->
                <div class="welcome-section flex-1 max-w-lg reveal">
                    <div class="space-y-6">
                        <h1 class="text-6xl md:text-7xl font-bold font-poppins">
                            <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                                Welcome
                            </span>
                        </h1>
                        
                        <p class="text-xl text-gray-300 leading-relaxed">
                            Create your account and embark on an amazing journey with us. 
                            Join thousands of users who trust our platform.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 items-start">
                            <p class="text-gray-400">Already have an account?</p>
                            <a href="{{ route('login') }}" class="btn-secondary px-6 py-3 font-semibold rounded-full inline-flex items-center gap-2 text-white">
                                <i class="fas fa-sign-in-alt"></i>
                                Sign In
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Registration Form -->
                <div class="flex-1 max-w-md w-full reveal">
                    <div class="glass-card rounded-2xl p-8 shadow-2xl">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold font-poppins">
                                <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                                    Create Account
                                </span>
                            </h2>
                            <p class="text-gray-300 mt-2">Fill in your details to get started</p>
                        </div>

                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="alert bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-emerald-400 text-lg"></i>
                                <div>
                                    <h3 class="font-semibold text-emerald-400">Success!</h3>
                                    <p class="text-emerald-300 text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Error Messages -->
                        @if($errors->any())
                        <div class="alert bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-6">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-exclamation-circle text-red-400 text-lg mt-1"></i>
                                <div>
                                    <h3 class="font-semibold text-red-400 mb-2">Please fix the following:</h3>
                                    <ul class="text-red-300 text-sm space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li class="flex items-center gap-2">
                                                <i class="fas fa-circle text-xs"></i>
                                                {{ $error }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register.submit') }}" class="space-y-5" id="registerForm">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label for="name" class="flex items-center gap-2 font-medium text-gray-200">
                                    <i class="fas fa-user text-blue-400"></i>
                                    Full Name
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                    placeholder="Enter your full name" required 
                                    class="form-input w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none @error('name') error @enderror">
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label for="email" class="flex items-center gap-2 font-medium text-gray-200">
                                    <i class="fas fa-envelope text-blue-400"></i>
                                    Email Address
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                    placeholder="Enter your email" required 
                                    class="form-input w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none @error('email') error @enderror">
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-2">
                                <label for="password" class="flex items-center gap-2 font-medium text-gray-200">
                                    <i class="fas fa-lock text-blue-400"></i>
                                    Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" 
                                        placeholder="Create a strong password" required
                                        class="form-input w-full px-4 py-3 pr-12 rounded-xl text-white placeholder-gray-400 focus:outline-none @error('password') error @enderror">
                                    <button type="button" onclick="togglePassword('password')" 
                                        class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-all duration-300">
                                        <i class="fas fa-eye" id="eye-password"></i>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                                </div>
                                <p class="text-xs text-gray-400" id="passwordStrengthText">Enter a password to see strength</p>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="space-y-2">
                                <label for="password_confirmation" class="flex items-center gap-2 font-medium text-gray-200">
                                    <i class="fas fa-lock text-blue-400"></i>
                                    Confirm Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                        placeholder="Confirm your password" required
                                        class="form-input w-full px-4 py-3 pr-12 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                                    <button type="button" onclick="togglePassword('password_confirmation')" 
                                        class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-all duration-300">
                                        <i class="fas fa-eye" id="eye-password_confirmation"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Optional Fields -->
                            <div class="space-y-4 border-t border-white/10 pt-4">
                                <p class="text-sm text-gray-400 flex items-center gap-2">
                                    <i class="fas fa-info-circle"></i>
                                    Optional Information
                                </p>
                                
                                <!-- Phone Number -->
                                <div class="space-y-2">
                                    <label for="phone" class="flex items-center gap-2 font-medium text-gray-300">
                                        <i class="fas fa-phone text-gray-400"></i>
                                        Phone Number
                                    </label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
                                        placeholder="Your phone number" 
                                        class="form-input w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                                </div>

                                <!-- Institution -->
                                <div class="space-y-2">
                                    <label for="institution" class="flex items-center gap-2 font-medium text-gray-300">
                                        <i class="fas fa-university text-gray-400"></i>
                                        Institution
                                    </label>
                                    <input type="text" name="institution" id="institution" value="{{ old('institution') }}" 
                                        placeholder="Your institution or company" 
                                        class="form-input w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                                </div>

                                <!-- Student ID -->
                                <div class="space-y-2">
                                    <label for="student_id" class="flex items-center gap-2 font-medium text-gray-300">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                        Student ID
                                    </label>
                                    <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}" 
                                        placeholder="Your student ID" 
                                        class="form-input w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-primary w-full py-4 font-semibold rounded-xl text-white transition-all duration-300">
                                <span class="flex items-center justify-center gap-2">
                                    <i class="fas fa-user-plus"></i>
                                    Create Account
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
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

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = [];

            if (password.length >= 8) strength++;
            else feedback.push("at least 8 characters");

            if (/[a-z]/.test(password)) strength++;
            else feedback.push("lowercase letters");

            if (/[A-Z]/.test(password)) strength++;
            else feedback.push("uppercase letters");

            if (/[0-9]/.test(password)) strength++;
            else feedback.push("numbers");

            if (/[^A-Za-z0-9]/.test(password)) strength++;
            else feedback.push("special characters");

            return { strength, feedback };
        }

        // Password strength visualization
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');
            
            if (password.length === 0) {
                strengthBar.className = 'password-strength-bar';
                strengthText.textContent = 'Enter a password to see strength';
                return;
            }

            const { strength, feedback } = checkPasswordStrength(password);
            
            strengthBar.className = 'password-strength-bar';
            
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = `Weak - Add: ${feedback.join(', ')}`;
            } else if (strength === 3) {
                strengthBar.classList.add('strength-fair');
                strengthText.textContent = `Fair - Add: ${feedback.join(', ')}`;
            } else if (strength === 4) {
                strengthBar.classList.add('strength-good');
                strengthText.textContent = 'Good - Almost there!';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Strong password!';
            }
        });

        // Form submission handling
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const submitBtn = e.target.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';
            submitBtn.disabled = true;
        });

        // Reveal animations
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach((element, index) => {
                setTimeout(() => {
                    element.classList.add('active');
                }, index * 200);
            });
        });

        // Enhanced form validation feedback
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '' && this.checkValidity()) {
                    this.style.borderColor = 'rgba(16, 185, 129, 0.6)';
                } else if (this.value.trim() !== '' && !this.checkValidity()) {
                    this.classList.add('error');
                }
            });

            input.addEventListener('input', function() {
                this.classList.remove('error');
                this.style.borderColor = '';
            });
        });
    </script>
</body>
</html>