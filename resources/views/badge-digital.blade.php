<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شارة المشاركة - {{ $candidate->first_name }} {{ $candidate->last_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js"></script>
    <link rel="preload" href="{{ asset('binhook/logoxxxhdpi.png') }}" as="image">
    <link rel="preload" href="{{ asset('binhook/Asset 2xxxhdpi.png') }}" as="image">
    <style>
        body { 
            font-family: 'Cairo', sans-serif; 
            background-color: #f8fafc; 
        }
        
        .badge-container {
            width: 400px;
            height: 585px; /* Roughly B4 ratio */
            position: relative;
            background: #0f172a; 
            color: #ffffff;
            text-align: center;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            margin: 0 auto;
        }
        
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 0%, #1e293b 0%, #0f172a 70%);
            z-index: 1;
        }

        .top-accent {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 12px;
            background: #f59e0b; 
            z-index: 2;
        }

        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            margin-top: 35px;
            height: 80px;
            width: auto;
        }

        .profile-pic-container {
            margin-top: 40px;
        }

        .profile-pic {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 4px solid #f59e0b;
            background-color: #1e293b;
            object-fit: cover;
        }

        .name {
            margin-top: 25px;
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .membership {
            margin-top: 5px;
            font-size: 18px;
            color: #94a3b8;
        }

        .qr-container {
            margin-top: auto;
            margin-bottom: 20px;
            background: #ffffff;
            padding: 10px;
            border-radius: 12px;
        }

        .qr-code {
            width: 90px;
            height: 90px;
        }

        .footer {
            margin-bottom: 8px;
            text-align: center;
            font-size: 14px;
            color: #f59e0b;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .badge-branding {
            margin-bottom: 14px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
            letter-spacing: 0.5px;
            direction: ltr;
        }
        
        /* Hide UI elements during capture */
        .no-capture {
            display: block;
        }
        
        .capturing .no-capture {
            display: none !important;
        }
    </style>
</head>
<body class="py-12 px-4 sm:px-6">

    <div class="max-w-lg mx-auto mb-8 text-center no-capture">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">شارة المشاركة الخاصة بك</h1>
        <p class="text-gray-600 mb-6">يمكنك تحميل هذه الشارة كصورة لمشاركتها على حساباتك في مواقع التواصل الاجتماعي، أو إبرازها يوم الحدث.</p>
        
        <button id="downloadBtn" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg transition-colors duration-200">
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            تحميل الشارة كصورة
        </button>
    </div>

    <!-- The Badge Element -->
    <div id="badgeElement" class="badge-container">
        <div class="bg-pattern"></div>
        <div class="top-accent"></div>
        
        <div class="content">
            <!-- Logo -->
            @php
                $logoPath = public_path('logo-original1.png');
                if(!file_exists($logoPath)) $logoPath = public_path('logo-original.png');
            @endphp
            @if(file_exists($logoPath))
                <img src="{{ asset('logo-original1.png') }}" class="logo" alt="Logo" onerror="this.src='{{ asset('logo-original.png') }}'">
            @else
                <div style="height: 80px; margin-top: 35px; font-size: 26px; font-weight: 800; color: #f59e0b; display: flex; align-items: center;">مسابقة حيزية</div>
            @endif

            <div class="profile-pic-container">
                @if($candidate->profile_pic)
                    <img src="{{ asset('storage/' . $candidate->profile_pic) }}" class="profile-pic" alt="Profile" crossorigin="anonymous">
                @else
                    <div class="profile-pic flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                @endif
            </div>

            <div class="name">{{ $candidate->first_name }} {{ $candidate->last_name }}</div>
            <div class="membership">{{ $candidate->membership }}</div>

            <div class="qr-container">
                <!-- Inline SVG QR Code to avoid external image loading issues in canvas -->
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(90)->margin(0)->generate(route('candidates.checkin', ['code' => $candidate->code])) !!}
            </div>

            <div class="footer">
                شارة مشاركة رسمية
            </div>
            <div class="badge-branding">
                Powered by binhook
            </div>
        </div>
    </div>

    <div class="mt-8 flex items-center justify-center w-full pb-8 no-capture" dir="ltr">
        <span class="text-gray-400 text-sm">Powered by</span>
        <img src="{{ asset('binhook/logoxxxhdpi.png') }}" alt="Binhook" class="h-5 ml-2">
    </div>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const badge = document.getElementById('badgeElement');
            const btn = this;
            const originalText = btn.innerHTML;
            
            // Change button state
            btn.innerHTML = '<img src="{{ asset('binhook/Asset 2xxxhdpi.png') }}" class="h-5 w-auto ml-2 animate-pulse" alt="Loading"> جاري التحميل...';
            btn.disabled = true;
            
            // Allow fonts to fully load and rendering to complete
            setTimeout(() => {
                htmlToImage.toPng(badge, {
                    pixelRatio: 3, // Higher scale for better quality image
                    backgroundColor: '#0f172a',
                    style: {
                        transform: 'scale(1)',
                        transformOrigin: 'top left'
                    }
                }).then(function (dataUrl) {
                    // Create download link
                    const link = document.createElement('a');
                    link.download = 'badge_{{ $candidate->first_name }}_{{ $candidate->last_name }}.png';
                    link.href = dataUrl;
                    link.click();
                    
                    // Restore button
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }).catch(function (error) {
                    console.error('Error generating image:', error);
                    alert('حدث خطأ أثناء إنشاء الصورة. يرجى المحاولة مرة أخرى.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            }, 500);
        });
    </script>
</body>
</html>
