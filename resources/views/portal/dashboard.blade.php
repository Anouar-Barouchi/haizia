<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة المترشحين - مسابقة حيزية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body>

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">بوابة المترشحين</h1>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 ml-4">{{ $candidate->first_name }} {{ $candidate->last_name }}</span>
                    <form action="{{ route('portal.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">حالة المسابقة</h2>
                
                <div class="flex items-center">
                    @if($candidate->competition_status === 'pending_arrival')
                        <div class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-semibold">بانتظار تسجيل الحضور</div>
                        <p class="mr-4 text-gray-600">يرجى التوجه إلى نقطة الاستقبال وإبراز الشارة الخاصة بك.</p>
                    @elseif($candidate->competition_status === 'checked_in')
                        <div class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold">تم تسجيل الحضور</div>
                        <p class="mr-4 text-gray-600">أنت الآن في قاعة الانتظار. سيتم تفعيل نموذج رفع الصور عند بدء مسابقتك.</p>
                    @elseif($candidate->competition_status === 'started')
                        <div class="px-4 py-2 bg-emerald-100 text-emerald-800 rounded-full font-semibold">المسابقة جارية</div>
                        <p class="mr-4 text-gray-600">يمكنك الآن رفع صورك وملء بيانات معداتك.</p>
                    @elseif($candidate->competition_status === 'submitted')
                        <div class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full font-semibold">تم تسليم المشاركة</div>
                        <p class="mr-4 text-gray-600">لقد تم استلام صورك بنجاح. شكراً لمشاركتك!</p>
                    @endif
                </div>
            </div>
        </div>

        @if($candidate->competition_status === 'started')
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-emerald-600 p-4 text-white">
                    <h2 class="text-xl font-bold">نموذج تسليم الصور</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('portal.submit_photos') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="camera_brand">نوع الكاميرا (العلامة التجارية)</label>
                                <select name="camera_brand" id="camera_brand" class="w-full px-4 py-2 border rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                                    <option value="">اختر العلامة التجارية</option>
                                    <option value="Canon">Canon</option>
                                    <option value="Nikon">Nikon</option>
                                    <option value="Sony">Sony</option>
                                    <option value="Fujifilm">Fujifilm</option>
                                    <option value="Panasonic">Panasonic</option>
                                    <option value="Olympus">Olympus</option>
                                    <option value="Other">أخرى</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="camera_model">موديل الكاميرا</label>
                                <input type="text" name="camera_model" id="camera_model" placeholder="مثال: EOS R5" class="w-full px-4 py-2 border rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="camera_lenses">العدسات المستخدمة</label>
                            <input type="text" name="camera_lenses" id="camera_lenses" placeholder="مثال: 24-70mm f/2.8" class="w-full px-4 py-2 border rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div class="mb-8">
                            <label class="block text-gray-700 font-semibold mb-2" for="photos">الصور النهائية (يمكن اختيار عدة صور)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="photos" class="relative cursor-pointer bg-white rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-emerald-500">
                                            <span>اختر الصور</span>
                                            <input id="photos" name="photos[]" type="file" class="sr-only" multiple accept="image/*" required>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 10MB لكل صورة</p>
                                </div>
                            </div>
                            @error('photos')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('photos.*')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            اعتماد الصور والمشاركة
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>

</body>
</html>
