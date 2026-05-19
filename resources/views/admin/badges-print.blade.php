<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة شارات المترشحين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            font-family: 'Cairo', sans-serif; 
            background-color: #e2e8f0; 
        }
        
        @media print {
            body {
                background-color: white;
            }
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-after: always;
            }
        }
        
        .badge-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 22cm;
            margin: 0 auto;
        }

        .badge-container {
            width: 106mm;
            height: 155mm;
            position: relative;
            background: #0f172a; 
            color: #ffffff;
            text-align: center;
            overflow: hidden;
            border: 1px solid #ccc; /* Cut guide */
            box-sizing: border-box;
            page-break-inside: avoid;
            break-inside: avoid;
            margin-bottom: 20px;
        }
        
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 0%, #1e293b 0%, #0f172a 70%);
            z-index: 1;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .top-accent {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4mm;
            background: #f59e0b; 
            z-index: 2;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
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
            margin-top: 10mm;
            height: 22mm;
            width: auto;
        }

        .profile-pic-container {
            margin-top: 10mm;
        }

        .profile-pic {
            width: 38mm;
            height: 38mm;
            border-radius: 50%;
            border: 2px solid #f59e0b;
            background-color: #1e293b;
            object-fit: cover;
        }

        .name {
            margin-top: 5mm;
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .membership {
            margin-top: 2mm;
            font-size: 14px;
            color: #94a3b8;
        }

        .qr-container {
            margin-top: auto;
            margin-bottom: 15mm;
            background: #ffffff;
            padding: 3mm;
            border-radius: 8px;
        }

        .qr-code {
            width: 22mm;
            height: 22mm;
        }

        .footer {
            margin-bottom: 2mm;
            text-align: center;
            font-size: 11px;
            color: #f59e0b;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .badge-branding {
            margin-bottom: 3mm;
            text-align: center;
            font-size: 10px;
            color: #64748b;
            letter-spacing: 0.5px;
            direction: ltr;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    </style>
</head>
<body class="py-8">

    <div class="max-w-4xl mx-auto mb-8 text-center no-print bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">طباعة شارات المترشحين ({{ $candidates->count() }})</h1>
        <p class="text-gray-600 mb-6">يرجى التأكد من تفعيل "Background graphics" في إعدادات الطباعة للحصول على الألوان الصحيحة.</p>
        
        <button onclick="window.print()" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            طباعة الشارات الآن
        </button>
    </div>

    <!-- Print Area -->
    <div class="badge-grid" style="background: white; padding: 10mm;">
        @foreach($candidates as $candidate)
            <div class="badge-container">
                <div class="bg-pattern"></div>
                <div class="top-accent"></div>
                
                <div class="content">
                    @php
                        $logoPath = public_path('logo-original1.png');
                        if(!file_exists($logoPath)) $logoPath = public_path('logo-original.png');
                    @endphp
                    @if(file_exists($logoPath))
                        <img src="{{ asset('logo-original1.png') }}" class="logo" alt="Logo" onerror="this.src='{{ asset('logo-original.png') }}'">
                    @else
                        <div style="height: 22mm; margin-top: 10mm; font-size: 20px; font-weight: bold; color: #f59e0b;">مسابقة حيزية</div>
                    @endif

                    <div class="profile-pic-container">
                        @if($candidate->profile_pic)
                            <img src="{{ asset('storage/' . $candidate->profile_pic) }}" class="profile-pic" alt="Profile">
                        @else
                            <div style="width: 38mm; height: 38mm; border-radius: 50%; border: 2px solid #f59e0b; background-color: #1e293b; display: inline-block;"></div>
                        @endif
                    </div>

                    <div class="name">{{ $candidate->first_name }} {{ $candidate->last_name }}</div>
                    <div class="membership">{{ $candidate->membership }}</div>

                    <div class="qr-container">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->margin(0)->generate(route('candidates.checkin', ['code' => $candidate->code])) !!}
                    </div>

                    <div class="footer">
                        شارة مشاركة رسمية
                    </div>
                    <div class="badge-branding">
                        Powered by binhook
                    </div>
                </div>
            </div>
            
            @if(!$loop->last)
                <!-- No explicit page break, letting the browser handle it -->
            @endif
        @endforeach
    </div>

</body>
</html>
