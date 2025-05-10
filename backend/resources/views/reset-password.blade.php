<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 40px 30px;
            text-align: right;
            direction: rtl;
        }
        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .btn-reset {
            display: inline-block;
            margin: 30px auto 20px;
            padding: 15px 30px;
            background-color: #3490dc;
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-reset:hover {
            background-color: #2778c4;
        }
        .footer {
            margin-top: 40px;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>مرحباً {{ $user->nom }}،</h2>
    <p>لقد طلبت إعادة تعيين كلمة المرور الخاصة بك. انقر على الزر أدناه لإعادة التعيين:</p>

    <p style="text-align: center;">
        <a href="{{ $resetUrl }}" class="btn-reset">إعادة تعيين كلمة المرور</a>
    </p>

    <p>سينتهي صلاحية هذا الرابط خلال ساعة واحدة. إذا لم تطلب ذلك، يمكنك تجاهل هذه الرسالة.</p>

    <p class="footer">مع تحياتنا،<br><strong>فريق ChbebiWin</strong></p>
</div>

</body>
</html>