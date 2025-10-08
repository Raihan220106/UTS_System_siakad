<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Portal | Login</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .bg-university {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('http://static.photos/education/1200x630/42');
            background-size: cover;
            background-position: center;
        }
        .input-highlight {
            transition: all 0.3s ease;
            border-bottom: 2px solid #e2e8f0;
        }
        .input-highlight:focus {
            border-bottom-color: #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Left Side - University Branding -->
        <div class="w-full lg:w-1/2 bg-university text-white flex flex-col justify-center items-center p-12 text-center">
            <div class="max-w-md" data-aos="fade-right">
                <div class="flex justify-center mb-8">
                    <div class="bg-white rounded-full p-4 shadow-lg">
                        <i data-feather="book-open" class="w-12 h-12 text-blue-600"></i>
                    </div>
                </div>
                <h1 class="text-4xl font-bold mb-4">University of Academia</h1>
                <p class="text-xl mb-8">Welcome to our academic portal. Access your courses, grades, and university resources.</p>
                <div class="flex space-x-4 justify-center">
                    <a href="#" class="px-4 py-2 border border-white rounded-full hover:bg-white hover:text-blue-800 transition">Learn More</a>
                    <a href="#" class="px-4 py-2 bg-white text-blue-800 rounded-full hover:bg-blue-100 transition">Virtual Tour</a>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8">
            <div class="w-full max-w-md" data-aos="fade-left">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h2>
                    <p class="text-gray-600">Access your university account</p>
                </div>

                <form class="space-y-6" action="login_process.php" method="POST">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">University Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="mail" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="pl-10 w-full px-0 py-3 border-0 border-b-2 input-highlight focus:ring-0 bg-transparent" 
                                placeholder="student@university.edu">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="pl-10 w-full px-0 py-3 border-0 border-b-2 input-highlight focus:ring-0 bg-transparent" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Sign in
                            <i data-feather="arrow-right" class="ml-2 h-4 w-4"></i>
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Contact administration</a>
                    </p>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i data-feather="facebook" class="h-6 w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i data-feather="twitter" class="h-6 w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i data-feather="linkedin" class="h-6 w-6"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out'
        });
        feather.replace();
    </script>
</body>
</html>