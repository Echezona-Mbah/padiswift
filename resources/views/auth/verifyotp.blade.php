<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image and Registration Form</title>
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .image-section {
            flex: 1;
            background: url('/assets/images/black-page/testimonial2.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            background-blend-mode: overlay;
            min-height: 100vh;
        }

        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-section {
                min-height: 30vh;
            }
        }
    </style>
</head>
<body>
    @include('sweetalert::alert')
    <div class="container">
        <div class="image-section">
            <h1>Welcome to Our Website</h1>
        </div>
        <div class="form-section">
<form method="POST" action="{{ route('verifyEmail') }}">
                @csrf
            <h2>Verify Email</h2>


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', request('email')) }}">


            <label for="password">Otp:</label>
            <input type="number" id="otp" name="otp" :value="old('otp')" >

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
@if ($errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonText: 'OK',
    });
</script>
@endif
</html>
