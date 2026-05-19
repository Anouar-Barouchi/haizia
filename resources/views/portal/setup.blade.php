<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعداد الحساب - مسابقة حيزية</title>
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
            <h1 class="text-2xl font-bold text-gray-800">إعداد كلمة المرور</h1>
            <p class="text-gray-500 mt-2">أهلاً بك {{ $candidate->first_name }}! يرجى تعيين كلمة مرور لحسابك.</p>
        </div>

        <form action="{{ request()->fullUrl() }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="password">كلمة المرور</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('password') border-red-500 @enderror" type="password" name="password" id="password" required minlength="8">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">تأكيد كلمة المرور</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 mr-3">
                        <p class="text-sm text-yellow-700 font-semibold">
                            يرجى حفظ وتذكر كلمة المرور هذه جيداً! ستحتاجها يوم المسابقة لتسجيل الدخول ورفع صورتك النهائية.
                        </p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-emerald-700 transition duration-300">
                حفظ ودخول
            </button>
        </form>
    </div>
    
    <div class="mt-8 flex items-center justify-center w-full pb-8" dir="ltr">
        <span class="text-gray-400 text-sm">Powered by</span>
        <img src="{{ asset('binhook/logoxxxhdpi.png') }}" alt="Binhook" class="h-5 ml-2">
    </div>

</body>
</html>
