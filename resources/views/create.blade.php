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

    
    <section id="create-event" class="py-20 px-8 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 relative overflow-hidden">
        <div class="absolute top-10 right-10 w-40 h-40 bg-gradient-to-br from-blue-200 to-purple-200 rounded-full opacity-20 animate-float"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 bg-gradient-to-br from-pink-200 to-red-200 rounded-full opacity-20 animate-float-delayed"></div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="bg-gradient-to-r from-pink-500 to-violet-500 bg-clip-text text-transparent font-bold text-xl uppercase tracking-wider">Create Event</span>
                <h2 class="font-bold text-5xl font-poppins text-gray-800 mt-4">Create New <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Event</span></h2>
                <p class="text-gray-600 mt-4 text-lg">Share your amazing event with the community</p>
            </div>

            @if (session('success'))
                <div class="bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-4 rounded-2xl mb-6 reveal shadow-lg">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">✅</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-gradient-to-r from-red-400 to-red-500 text-white px-6 py-4 rounded-2xl mb-6 reveal shadow-lg">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">❌</span>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 py-4 rounded-2xl mb-6 reveal shadow-lg">
                    <div class="flex items-start">
                        <span class="text-2xl mr-3 mt-1">⚠</span>
                        <div>
                            <div class="font-medium mb-2">Please fix the following errors:</div>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="glass-effect rounded-3xl p-8 shadow-2xl reveal">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Event Title -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Event Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="Enter your event title..." required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Event Image -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Event Image</label>
                        <div id="dropzone" class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center transition-all duration-300 hover:border-blue-400 bg-white cursor-pointer"
                            onclick="document.getElementById('imageInput').click();"
                            ondragover="event.preventDefault();" 
                            ondrop="handleDrop(event)">
                            <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m5 8h2a2 2 0 002-2v-5a2 2 0 00-2-2h-1.5a.5.5 0 010-1H17a2 2 0 012 2v5a2 2 0 01-2 2h-2z"/>
                            </svg>
                            <p class="text-gray-500">Drag & drop an image here or <span class="text-blue-500 underline">click to upload</span></p>
                            <p class="mt-1 text-sm text-gray-400">Only image files (jpg, png, etc.) allowed</p>
                            <img id="preview" class="mt-4 max-h-40 hidden rounded-lg shadow" />
                        </div>
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="handleFileSelect(event)">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Description</label>
                        <textarea name="description" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 resize-none" 
                                rows="4" placeholder="Describe your event in detail..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Category -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Category</label>
                        <select name="category" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" required>
                            <option value="">Select Category</option>
                            <option value="Competition" {{ old('category') == 'Competition' ? 'selected' : '' }}>🏆 Competition</option>
                            <option value="Seminar" {{ old('category') == 'Seminar' ? 'selected' : '' }}>📚 Seminar</option>
                            <option value="Workshop" {{ old('category') == 'Workshop' ? 'selected' : '' }}>🛠 Workshop</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Start Date -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Start Date</label>
                        <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" required>
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">End Date</label>
                        <input type="datetime-local" name="end_date" value="{{ old('end_date') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" required>
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Location -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="Enter event location...">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Organizer -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Organizer</label>
                        <input type="text" name="organizer" value="{{ old('organizer', Auth::user()->name ?? '') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="Enter organizer name..." required>
                        @error('organizer')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', Auth::user()->email ?? '') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="Enter contact email..." required>
                        @error('contact_email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Phone (Optional) -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Contact Phone</label>
                        <input type="tel" name="contact_phone" value="{{ old('contact_phone') }}" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="Enter contact phone (optional)">
                        @error('contact_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Participants (Optional) -->
                    <div>
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Max Participants</label>
                        <input type="number" name="max_participants" value="{{ old('max_participants') }}" min="1" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="Leave empty for unlimited">
                        @error('max_participants')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Registration Fee (Optional) -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Registration Fee (IDR)</label>
                        <input type="number" name="registration_fee" value="{{ old('registration_fee', 0) }}" min="0" step="0.01" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 font-medium" 
                            placeholder="0 for free event">
                        @error('registration_fee')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Additional Info (Optional) -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-3 text-gray-700 text-lg">Additional Information</label>
                        <textarea name="additional_info" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 hover:border-gray-300 text-gray-700 resize-none" 
                                rows="3" placeholder="Any additional information (optional)">{{ old('additional_info') }}</textarea>
                        @error('additional_info')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-8 text-center">
                    <button type="submit" class="w-full px-12 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-full hover:shadow-2xl transition-all duration-300 transform hover:scale-105 btn-glow">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </section>

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
        
        // Handle file drop
        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file only.');
                    event.target.value = '';
                    return;
                }
                
                // Validate file size (2MB max)
                if (file.size > 2048 * 1024) {
                    alert('File size must be less than 2MB.');
                    event.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    
                    // Update dropzone text
                    const dropzone = document.getElementById('dropzone');
                    const text = dropzone.querySelector('p');
                    text.innerHTML = `<span class="text-green-500">✓ ${file.name} selected</span>`;
                };
                reader.readAsDataURL(file);
            }
        }

        // Handle drag and drop
        function handleDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            
            if (files.length > 0) {
                const file = files[0];
                
                if (file.type.startsWith('image/')) {
                    const input = document.getElementById('imageInput');
                    input.files = files;
                    
                    // Trigger the change event
                    const changeEvent = new Event('change', { bubbles: true });
                    input.dispatchEvent(changeEvent);
                    
                    handleFileSelect({ target: { files: files } });
                } else {
                    alert('Please select an image file only.');
                }
            }
        }

        // Enhance dropzone styling
        document.getElementById('dropzone').addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-400', 'bg-blue-50');
        });

        document.getElementById('dropzone').addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
        });

        // Auto-fill end date when start date changes
        document.querySelector('input[name="start_date"]').addEventListener('change', function() {
            const endDateInput = document.querySelector('input[name="end_date"]');
            if (!endDateInput.value) {
                // Set end date to same as start date initially
                endDateInput.value = this.value;
            }
        });

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const startDate = new Date(document.querySelector('input[name="start_date"]').value);
            const endDate = new Date(document.querySelector('input[name="end_date"]').value);
            
            if (endDate <= startDate) {
                e.preventDefault();
                alert('End date must be after start date.');
                return false;
            }
            
            if (startDate <= new Date()) {
                e.preventDefault();
                alert('Start date must be in the future.');
                return false;
            }
        });
    </script>
</body>
</html>
