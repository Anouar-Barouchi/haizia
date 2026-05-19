<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $candidate->first_name }} {{ $candidate->last_name }} - المترشح</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #1e293b;
        }
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        .profile-pic-container {
            margin-top: -60px;
            text-align: center;
        }
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .content {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .name {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 800;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .membership {
            text-align: center;
            font-size: 1rem;
            color: #64748b;
            margin-bottom: 20px;
        }
        .section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #10b981;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .gallery-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f8fafc;
        }
        .info-label {
            font-weight: 600;
            color: #64748b;
        }
        .info-value {
            font-weight: 700;
        }
        .status-badge {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 style="margin: 0; font-size: 1.5rem;">مسابقة حيزية</h1>
        <p style="margin: 5px 0 0 0; opacity: 0.9;">الملف التعريفي للمترشح</p>
    </div>

    <div class="profile-pic-container">
        @if($candidate->profile_pic)
            <img src="{{ asset('storage/' . $candidate->profile_pic) }}" alt="Profile" class="profile-pic">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($candidate->first_name . ' ' . $candidate->last_name) }}&background=10b981&color=fff&size=120" alt="Profile" class="profile-pic">
        @endif
    </div>

    <div class="content">
        <div class="name">{{ $candidate->first_name }} {{ $candidate->last_name }}</div>
        <div class="membership">{{ $candidate->membership }} {{ $candidate->membership_name ? '- ' . $candidate->membership_name : '' }}</div>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <div class="status-badge">مترشح رسمي</div>
        </div>

        @if($candidate->has_experience || $candidate->has_awards)
            <div class="section">
                <h2 class="section-title">نبذة عن المترشح</h2>
                
                @if($candidate->has_experience)
                    <div style="margin-bottom: 15px;">
                        <div class="info-label">الخبرات والمشاركات السابقة:</div>
                        <div style="margin-top: 5px; line-height: 1.6; white-space: pre-wrap;">{{ $candidate->experience_list }}</div>
                    </div>
                @endif
                
                @if($candidate->has_awards)
                    <div>
                        <div class="info-label">الجوائز:</div>
                        <div style="margin-top: 5px; line-height: 1.6; white-space: pre-wrap;">{{ $candidate->awards_list }}</div>
                    </div>
                @endif
            </div>
        @endif

        @if($candidate->gallery && count($candidate->gallery) > 0)
            <div class="section">
                <h2 class="section-title">معرض الأعمال</h2>
                <div class="gallery-grid">
                    @foreach($candidate->gallery as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="gallery-img">
                    @endforeach
                </div>
            </div>
        @endif
        
    </div>

    <div style="text-align: center; margin-top: 30px; margin-bottom: 30px; direction: ltr;">
        <span style="color: #94a3b8; font-size: 0.875rem; vertical-align: middle;">Powered by</span>
        <img src="{{ asset('binhook/logoxxxhdpi.png') }}" alt="Binhook" style="height: 18px; vertical-align: middle; margin-left: 6px;">
    </div>

</body>
</html>
