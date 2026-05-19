<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دعوة مشاركة</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f5;
            color: #333;
            margin: 0;
            padding: 0;
            direction: rtl;
            text-align: right;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #10b981;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #10b981;
            margin-bottom: 20px;
        }
        .candidate-name {
            font-size: 22px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            color: #4b5563;
            margin-bottom: 30px;
        }
        .qr-section {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .qr-section p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 15px;
        }
        .qr-code {
            width: 200px;
            height: 200px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>دعوة حضور نهائية</h1>
        </div>
        <div class="content">
            @if($candidate->profile_pic)
                <img src="{{ asset('storage/' . $candidate->profile_pic) }}" alt="Profile Picture" class="profile-pic">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($candidate->first_name . ' ' . $candidate->last_name) }}&background=10b981&color=fff&size=120" alt="Profile Picture" class="profile-pic">
            @endif
            
            <div class="candidate-name">{{ $candidate->first_name }} {{ $candidate->last_name }}</div>
            
            <div class="message">
                يسعدنا إعلامك بأنه تم قبول ترشيحك النهائي. نرجو منك الاحتفاظ بشارة المشاركة الرسمية (PDF) المرفقة مع هذا البريد، حيث تحتوي على رمز الاستجابة السريعة (QR Code) الذي سيتم استخدامه لتسجيل حضورك في يوم الحدث.
            </div>

            <div class="qr-section">
                <p><strong>بوابة المترشحين الخاصة بك</strong></p>
                <p style="margin-bottom: 20px;">يرجى إعداد حسابك وكلمة المرور لتتمكن من الوصول إلى بوابة المترشحين الخاصة بك، حيث ستقوم لاحقاً برفع صورك ومعلومات الكاميرا الخاصة بك يوم المسابقة.</p>
                <a href="{{ $setupUrl }}" style="display: inline-block; background-color: #10b981; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin-bottom: 15px;">إعداد حسابي الآن</a>
                <p style="color: #ef4444; font-size: 12px; font-weight: bold; margin-top: 10px;">⚠️ تحذير: هذا الرابط مخصص لك فقط. يرجى عدم مشاركته مع أي شخص آخر حفاظاً على أمان مشاركتك.</p>
            </div>
            
            <div class="qr-section" style="margin-top: 20px;">
                <p>يرجى إبراز الشارة المرفقة أو هذا الرمز عند نقطة الاستقبال</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('candidates.checkin', ['code' => $candidate->code])) }}" alt="QR Code" class="qr-code">
            </div>
        </div>
        <div class="footer">
            جميع الحقوق محفوظة &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html>
