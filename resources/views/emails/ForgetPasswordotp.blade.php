


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0px;
            padding: 20px;
        }

        h1, h3, p {
            color: #333;
        }

        .header-image {
            width: 100%;
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-block;
            margin-right: 15px;
        }

        .social-icons a img {
            width: 40px;
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo-main.png') }}" alt="Company Logo" style="max-width: 60%; margin-bottom: 20px;">

        <h1>Reset Your PadiSwift Password 🔄  </h1>
        <h3>Dear {{ $user->first_name }}!,</h3>
        <p>It happens to the best of us! If you've forgotten your PadiSwift password, don't worry. Use the following One-Time Password (OTP) to reset your password: </p>
        <p>Your OTP:{{ $security_login_otp }}</p>
        <p>This code is valid for [X] minutes. Click here to reset your password. If you didn't initiate this request, please disregard this email.</p>
        <p>If you need further assistance, feel free to reach out to our support team.
        </p>
        <p>Thank you for choosing PadiSwift. We're here to make your experience secure and stress-free.
        </p>
        <p>Best Regards,
        </p>
        <p>The PadiSwift Team</p>


        <!-- Social Media Icons -->
        <div class="social-icons">
            <a href="https://www.facebook.com/your-facebook-page"><img src="{{ asset('images/facebook-removebg-preview.png') }}" alt="Facebook"></a>
            <a href="https://www.instagram.com/your-instagram-account"><img src="{{ asset('images/instagram-removebg-preview.png') }}" alt="Instagram"></a>
            <a href="https://www.linkedin.com/in/your-linkedin-profile"><img src="{{ asset('images/linkin-removebg-preview.png') }}" alt="LinkedIn"></a>
            <a href="https://wa.me/your-whatsapp-number"><img src="{{ asset('images/whatsapp-removebg-preview.png') }}" alt="WhatsApp"></a>
            <a href="https://www.youtube.com/your-youtube-channel"><img src="{{ asset('images/youtube-removebg-preview.png') }}" alt="YouTube Video Thumbnail"></a>
        </div>
    </div>
</body>
</html>


{{-- <!DOCTYPE html>
<html>
<head>
    <title>OTP Email</title>
</head>
<body>
    <div>
        <p>Dear User,</p>
        <p>Your OTP code is: <strong>{{ $security_login_otp }}</strong></p>
        <p>Please use this OTP code to verify your identity.</p>
        <p>Thank you for using our service.</p>
    </div>
</body>
</html> --}}


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <p>Your OTP for password reset is: <strong>{{ $forgot_password_code }}</strong></p>


</body>
</html> --}}
