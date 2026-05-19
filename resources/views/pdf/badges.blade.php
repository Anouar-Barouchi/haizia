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
            background-color: #0f172a; /* Slate 900 */
        }
        .page-break {
            page-break-after: always;
        }
        .badge-container {
            width: 106mm;
            height: 155mm;
            position: relative;
            background: #0f172a; 
            color: #ffffff;
            text-align: center;
            overflow: hidden;
        }
        
        /* Premium subtle background element */
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
            height: 3mm;
            background: #f59e0b; /* Premium Gold */
            z-index: 2;
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
            margin-top: 10mm;
            height: 22mm;
            width: auto;
        }

        .profile-pic-container {
            margin-top: 12mm;
            text-align: center;
        }

        .profile-pic {
            width: 38mm;
            height: 38mm;
            border-radius: 50%;
            border: 2px solid #f59e0b; /* Gold border */
            background-color: #1e293b;
            object-fit: cover;
        }

        .name {
            margin-top: 6mm;
            font-size: 22px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .membership {
            margin-top: 2mm;
            font-size: 14px;
            color: #94a3b8; /* Slate 400 */
        }

        .qr-container {
            margin-top: 12mm;
            background: #ffffff;
            padding: 3mm;
            display: inline-block;
            border-radius: 8px;
        }

        .qr-code {
            width: 22mm;
            height: 22mm;
        }

        .footer {
            position: absolute;
            bottom: 6mm;
            width: 100%;
            text-align: center;
            font-size: 11px;
            color: #f59e0b; /* Gold */
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    @foreach($candidates as $candidate)
        <div class="badge-container">
            <div class="bg-pattern"></div>
            <div class="top-accent"></div>
            
            <div class="content">
                <!-- Logo -->
                @php
                    $logoPath = public_path('logo-original1.png');
                    if(!file_exists($logoPath)) $logoPath = public_path('logo-original.png');
                @endphp
                @if(file_exists($logoPath))
                    <img src="{{ $logoPath }}" class="logo" alt="Logo">
                @else
                    <div style="height: 22mm; margin-top: 10mm; font-size: 20px; font-weight: bold; color: #f59e0b;">مسابقة حيزية</div>
                @endif

                <div class="profile-pic-container">
                    @if($candidate->profile_pic)
                        <img src="{{ storage_path('app/public/' . $candidate->profile_pic) }}" class="profile-pic" alt="Profile">
                    @else
                        <!-- Simple placeholder -->
                        <div style="width: 38mm; height: 38mm; border-radius: 50%; border: 2px solid #f59e0b; background-color: #1e293b; display: inline-block;"></div>
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
