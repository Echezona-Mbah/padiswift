
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
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

        <h1>Verify Your PadiSwift Account🌟 </h1>
        <h3>Dear {{ $user->first_name }}!,</h3>
        <p>Welcome to PadiSwift! To ensure the security of your account, please use the following One-Time Password (OTP) to complete the verification process:</p>
        <p>Your OTP: {{ $email_verification_otp }} </p>
        <p>This code will expire in [X] minutes, so please enter it promptly. If you did not request this verification, please disregard this email.
        </p>
        <p>If you have any questions or need assistance, our support team is ready to help. Simply reply to this email, and we'll be in touch
        </p>
        <p>Thank you for choosing PadiSwift. We look forward to providing you with a seamless and secure experience.
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
