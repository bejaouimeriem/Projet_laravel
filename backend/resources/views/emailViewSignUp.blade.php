@component('mail::message')
<h1 style="font-size: 24px; font-weight: bold; color: #0348e8; text-align: center; margin-bottom: 20px;">
    🎉 مرحبًا بك في منصتنا، {{ $nom }} !
</h1>
<p style="font-size: 16px; color: #333; line-height: 1.5; text-align: center;">
    نحن سعداء بانضمامك إلينا! 🚀  
    تم إنشاء حسابك بنجاح ويمكنك الآن الاستفادة من جميع خدماتنا.
</p>
<p style="font-size: 16px; color: #333; line-height: 1.5; text-align: center; margin-bottom: 20px;">
    انقر على الزر أدناه للوصول إلى حسابك الشخصي:
</p>
<p style="text-align: center; margin-top: 20px;">
    <a href="{{ env('FRONTEND_URL', 'http://localhost:8081/privateHome') }}"
       style="display: inline-block;
              background-color: #0348e8;
              color: #fff;
              font-size: 16px;
              font-weight: bold;
              padding: 12px 24px;
              text-decoration: none;
              border-radius: 5px;
              box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
        الدخول إلى حسابي
    </a>
</p>
<p style="font-size: 14px; color: #666; text-align: center; margin-top: 20px;">
    إذا كان لديك أي استفسار، لا تتردد في التواصل معنا.  
    نتمنى لك تجربة رائعة على منصتنا! 😊
</p>
<p style="font-size: 14px; color: #666; text-align: center; margin-top: 10px;">
    <strong>ChbebiWin</strong> إلى اللقاء، فريق
</p>
@endcomponent