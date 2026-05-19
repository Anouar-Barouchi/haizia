<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعداد الحساب - مسابقة حيزية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">إعداد كلمة المرور</h1>
            <p class="text-gray-500 mt-2">أهلاً بك {{ $candidate->first_name }}! يرجى تعيين كلمة مرور لحسابك.</p>
        </div>

        <form action="{{ route('portal.setup.save', $candidate->id) }}" method="POST">
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

            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-emerald-700 transition duration-300">
                حفظ ودخول
            </button>
        </form>
    </div>

</body>
</html>
