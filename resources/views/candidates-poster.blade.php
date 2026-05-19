<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ملصق المترشحين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f3f4f6; /* Light gray background to show poster edges */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
        }
        
        .poster-container {
            width: 1080px;
            height: 1350px; /* 4:5 Aspect Ratio */
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            color: white;
        }

        /* Decorative Background Elements */
        .poster-bg-glow {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, rgba(0,0,0,0) 70%);
            top: -200px;
            right: -200px;
            border-radius: 50%;
            z-index: 0;
        }

        .poster-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 40px 60px;
        }

        .poster-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .poster-logo {
            height: 90px;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }

        .poster-title-container {
            text-align: left;
        }

        .poster-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            background: linear-gradient(to left, #fef08a, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            text-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .poster-subtitle {
            font-size: 1.2rem;
            color: #d1d5db;
            font-weight: 600;
            margin-top: 5px;
        }

        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px 15px;
            flex-grow: 1;
            align-content: center;
        }

        .candidate-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 100%;
            overflow: hidden;
        }

        .candidate-image-wrapper {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            padding: 4px;
            background: linear-gradient(135deg, #fef08a, #f59e0b);
            margin-bottom: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        .candidate-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #1e1b4b;
            background-color: #334155;
        }

        .candidate-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }

        .candidate-placeholder svg {
            width: 48px;
            height: 48px;
        }

        .candidate-name {
            font-size: 1rem;
            font-weight: 700;
            color: #f8fafc;
            line-height: 1.3;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
            padding: 0 10px;
            box-sizing: border-box;
        }

        .candidate-membership {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 2px;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <div class="poster-container" id="poster-capture-area">
        <div class="poster-bg-glow"></div>
        
        <div class="poster-content">
            <div class="poster-header">
                <div class="poster-title-container">
                    <h1 class="poster-title">المترشحون لمسابقة</h1>
                    <h1 class="poster-title" style="font-size: 3.5rem; margin-top: -5px;">حيزية</h1>
                    <div class="poster-subtitle">القائمة الرسمية</div>
                </div>
                <img src="{{ asset('logo-original.png') }}" alt="Haizia Logo" class="poster-logo">
            </div>

            <div class="candidates-grid">
                @foreach($candidates->take(24) as $candidate)
                    <div class="candidate-card">
                        <div class="candidate-image-wrapper">
                            @if($candidate->profile_pic)
                                <img src="{{ asset('storage/' . $candidate->profile_pic) }}" alt="{{ $candidate->first_name }}" class="candidate-image">
                            @else
                                <div class="candidate-image candidate-placeholder">
                                    <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="candidate-name">{{ $candidate->first_name }} {{ $candidate->last_name }}</div>
                        <div class="candidate-membership">{{ $candidate->membership }}</div>
                    </div>
                @endforeach
            </div>
            
            <!-- Optional Footer -->
            <div style="margin-top: auto; display: flex; justify-content: center; opacity: 0.7; font-size: 1.1rem; padding-top: 20px;">
                نتمنى التوفيق لجميع المشاركين
            </div>
        </div>
    </div>

</body>
</html>
