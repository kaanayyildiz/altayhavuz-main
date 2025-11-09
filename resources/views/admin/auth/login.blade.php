<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Giriş - Altay Havuz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex flex-col items-center justify-center p-4">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-16 w-auto object-contain">
    </div>

    <div class="w-full max-w-md bg-white border border-gray-200 shadow-xl rounded-2xl p-8">
        @if($errors->any())
            <div class="mb-4 bg-red-50 text-red-800 border border-red-200 px-4 py-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="loginForm" action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="admin@example.com">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Şifre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input type="password" id="passwordInput" name="password" required class="w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="123456">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg id="eyeIcon" class="h-5 w-5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8L3.07945 4.30466C4.29638 2.84434 6.09909 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8L12.9206 11.6953C11.7036 13.1557 9.90091 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8ZM8 11C9.65685 11 11 9.65685 11 8C11 6.34315 9.65685 5 8 5C6.34315 5 5 6.34315 5 8C5 9.65685 6.34315 11 8 11Z" fill="currentColor"></path>
                            </g>
                        </svg>
                        <svg id="eyeSlashIcon" class="h-5 w-5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 16H13L10.8368 13.3376C9.96488 13.7682 8.99592 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8L3.07945 4.30466C3.14989 4.22013 3.22229 4.13767 3.29656 4.05731L0 0H3L16 16ZM5.35254 6.58774C5.12755 7.00862 5 7.48941 5 8C5 9.65685 6.34315 11 8 11C8.29178 11 8.57383 10.9583 8.84053 10.8807L5.35254 6.58774Z" fill="currentColor"></path>
                                <path d="M16 8L14.2278 10.1266L7.63351 2.01048C7.75518 2.00351 7.87739 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8Z" fill="currentColor"></path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <button type="submit" id="submitBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg px-4 py-3 flex items-center justify-center transition-colors duration-200">
                <span id="submitText">Giriş Yap</span>
                <svg id="submitSpinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-blue-600 font-semibold rounded-lg px-4 py-3 transition-all duration-200 flex items-center justify-center gap-2 group">
                <svg class="w-5 h-5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Anasayfaya Dön</span>
            </a>
        </form>
    </div>

    <script>
        // Password toggle functionality
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeSlashIcon = document.getElementById('eyeSlashIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            } else {
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            }
        });

        // Form submit spinner
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');

        loginForm.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitSpinner.style.display = 'block';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        });
    </script>
</body>
</html>





