<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - مسابقة حيزية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preload" href="{{ asset('binhook/logoxxxhdpi.png') }}" as="image">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">تسجيل الدخول للمترشحين</h1>
        </div>

        @if(session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                <p>{{ session('info') }}</p>
            </div>
        @endif

        <form action="{{ route('portal.login.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="email">البريد الإلكتروني</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('email') border-red-500 @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2" for="password">كلمة المرور</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" type="password" name="password" id="password" required>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-emerald-600">
                    <span class="ml-2 mr-2 text-gray-700">تذكرني</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-emerald-700 transition duration-300">
                تسجيل الدخول
            </button>
        </form>
    </div>
    <div class="mt-8 flex items-center justify-center w-full pb-8" dir="ltr">
        <span class="text-gray-400 text-sm">Powered by</span>
        <img src="{{ asset('binhook/logoxxxhdpi.png') }}" alt="Binhook" class="h-5 ml-2">
    </div>

</body>
</html>
