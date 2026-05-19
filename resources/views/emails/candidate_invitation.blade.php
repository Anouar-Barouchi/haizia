<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دعوة مشاركة نهائية - مسابقة حيزية</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        
        .wrapper {
            width: 100%;
            background-color: #f8fafc;
            padding: 40px 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.01);
            border: 1px solid #e2e8f0;
        }
        
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        
        .profile-container {
            margin-top: -80px;
            margin-bottom: 25px;
        }
        
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            background-color: #f1f5f9;
        }
        
        .greeting {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 5px;
        }
        
        .subtitle {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 30px;
        }
        
        .message-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 35px;
        }
        
        .message-box p {
            font-size: 16px;
            line-height: 1.7;
            color: #166534;
            margin: 0;
            font-weight: 600;
        }
        
        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 30px 0;
            width: 100%;
        }
        
        .action-section {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }
        
        .action-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }
        
        .action-desc {
            font-size: 15px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .btn {
            display: inline-block;
            background-color: #10b981;
            color: #ffffff !important;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
        }
        
        .warning-text {
            color: #ef4444;
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
            background-color: #fef2f2;
            padding: 10px;
            border-radius: 6px;
        }
        
        .qr-section {
            background-color: #f8fafc;
            padding: 30px;
            border-radius: 12px;
            margin-top: 20px;
            border: 1px dashed #cbd5e1;
        }
        
        .qr-section p {
            font-size: 15px;
            color: #475569;
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .qr-code {
            width: 180px;
            height: 180px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .footer {
            padding: 30px;
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>مسابقة حيزية</h1>
                <p>دعوة حضور ومشاركة نهائية</p>
            </div>
            
            <div class="content">
                <div class="profile-container">
                    @if($candidate->profile_pic)
                        <img src="{{ asset('storage/' . $candidate->profile_pic) }}" alt="Profile Picture" class="profile-pic">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($candidate->first_name . ' ' . $candidate->last_name) }}&background=10b981&color=fff&size=120" alt="Profile Picture" class="profile-pic">
                    @endif
                </div>
                
                <div class="greeting">أهلاً بك، {{ $candidate->first_name }} {{ $candidate->last_name }}</div>
                <div class="subtitle">يسعدنا انضمامك إلينا كـ <strong>{{ $candidate->membership }}</strong></div>
                
                <div class="message-box">
                    <p>
                        تهانينا! لقد تم قبول ترشيحك النهائي للمشاركة في مسابقة حيزية.<br>
                        نرجو منك تحميل شارة المشاركة الرسمية الخاصة بك عبر الرابط أدناه وإبرازها يوم الحدث.
                    </p>
                </div>
                
                <div class="action-section" style="text-align: center; background-color: #f8fafc; border-color: #e2e8f0; border-width: 1px; border-style: solid;">
                    <div class="action-title">شارة المشاركة الرسمية</div>
                    <div class="action-desc">
                        قم بعرض وتحميل شارتك كصورة عالية الجودة لمشاركتها مع أصدقائك أو الاحتفاظ بها في هاتفك.
                    </div>
                    
                    <a href="{{ route('candidates.badge', ['code' => $candidate->code]) }}" class="btn" style="background-color: #f59e0b; color: #ffffff;">عرض وتحميل الشارة</a>
                </div>
                
                <div class="divider"></div>

                <div class="action-section">
                    <div class="action-title">بوابة المترشحين الخاصة بك</div>
                    <div class="action-desc">
                        يرجى إعداد حسابك وكلمة المرور للوصول إلى بوابتك الخاصة. ستتمكن من خلال هذه البوابة من رفع صورتك النهائية وتسجيل معلومات معداتك (الكاميرا والعدسات) يوم المسابقة.
                    </div>
                    
                    <a href="{{ $setupUrl }}" class="btn">إعداد حسابي الآن</a>
                    
                    <div class="warning-text">
                        ⚠️ تحذير: هذا الرابط مخصص لك فقط. يرجى عدم مشاركته مع أي شخص آخر حفاظاً على أمان وسرية مشاركتك.
                    </div>
                </div>
                
                <div class="divider"></div>
                
                <div class="qr-section">
                    <p>يرجى إبراز شارتك الرقمية أو هذا الرمز السريع عند وصولك لنقطة الاستقبال</p>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('candidates.checkin', ['code' => $candidate->code])) }}" alt="QR Code" class="qr-code">
                </div>
            </div>
            
            <div class="footer">
                جميع الحقوق محفوظة لمسابقة حيزية &copy; {{ date('Y') }}
            </div>
        </div>
    </div>
</body>
</html>
