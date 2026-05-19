<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>شارات المترشحين</title>
    <style>
        @page {
            margin: 0px;
            size: 106mm 155mm;
        }
        body {
            margin: 0px;
            padding: 0px;
            background-color: #ffffff;
        }
        .page-break {
            page-break-after: always;
        }
        .badge-container {
            width: 106mm;
            height: 155mm;
            position: relative;
            background: #1e1b4b; /* Deep blue background */
            color: white;
            text-align: center;
            overflow: hidden;
        }
        
        /* Decorative top gradient */
        .header-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 40mm;
            background: #10b981; /* Emerald green */
            border-bottom: 3px solid #f59e0b; /* Gold border */
            z-index: 1;
        }

        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        .logo {
            margin-top: 5mm;
            height: 25mm;
            width: auto;
        }

        .profile-pic-container {
            margin-top: 15mm;
            text-align: center;
        }

        .profile-pic {
            width: 35mm;
            height: 35mm;
            border-radius: 50%;
            border: 3px solid #f59e0b; /* Gold */
            background-color: #fff;
            object-fit: cover;
        }

        .name {
            margin-top: 3mm;
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
        }

        .membership {
            margin-top: 1mm;
            font-size: 14px;
            color: #d1d5db;
        }

        .qr-container {
            margin-top: 8mm;
            background: #ffffff;
            padding: 2mm;
            display: inline-block;
            border-radius: 5px;
        }

        .qr-code {
            width: 25mm;
            height: 25mm;
        }

        .footer {
            position: absolute;
            bottom: 5mm;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    @foreach($candidates as $candidate)
        <div class="badge-container">
            <div class="header-bg"></div>
            
            <div class="content">
                <!-- Logo -->
                @php
                    $logoPath = public_path('logo-original1.png');
                    if(!file_exists($logoPath)) $logoPath = public_path('logo-original.png');
                @endphp
                @if(file_exists($logoPath))
                    <img src="{{ $logoPath }}" class="logo" alt="Logo">
                @else
                    <div style="height: 25mm; margin-top: 5mm; font-size: 18px; font-weight: bold;">مسابقة حيزية</div>
                @endif

                <div class="profile-pic-container">
                    @if($candidate->profile_pic)
                        <img src="{{ storage_path('app/public/' . $candidate->profile_pic) }}" class="profile-pic" alt="Profile">
                    @else
                        <!-- Simple placeholder -->
                        <div style="width: 35mm; height: 35mm; border-radius: 50%; border: 3px solid #f59e0b; background-color: #334155; display: inline-block;"></div>
                    @endif
                </div>

                <div class="name">{{ $candidate->first_name }} {{ $candidate->last_name }}</div>
                <div class="membership">{{ $candidate->membership }}</div>

                <div class="qr-container">
                    <img src="data:image/png;base64, {!! base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(100)->generate(route('candidates.checkin', ['code' => $candidate->code]))) !!}" class="qr-code">
                </div>

                <div class="footer">
                    شارة مشاركة رسمية
                </div>
            </div>
        </div>
        
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
