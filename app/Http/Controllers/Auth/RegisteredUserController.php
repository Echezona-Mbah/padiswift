<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterOTPEmail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_url' => 'url',
        ]);

        $referralUrl = $request->input('referral_url');
        $referralQueryParams = parse_url($referralUrl, PHP_URL_QUERY);
        parse_str($referralQueryParams, $queryParameters);
        $referralCode = isset($queryParameters['ref']) ? $queryParameters['ref'] : null;
        $code = $this->generateUniqueCode();

        // $emailVerificationOtp = $this->generateOtp();
        // $emailVerificationOtpExpiresAt = now()->addMinutes(config('auth.email_verification_otp_expiry_minutes'));
        // session(['otp' => $emailVerificationOtp]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ref' => $referralCode,
            'my_ref_code' => $code,

        ]);

        $email_verification_otp = $this->generateOTP();
        $user->email_verification_otp = $email_verification_otp;
        $expirationTime = now()->addMinutes(5);
        $user->update([
            'email_verification_otp' => $email_verification_otp,
            'email_verification_otp_expires_at' => $expirationTime,
        ]);

        Mail::to($request->email)->send(new RegisterOTPEmail($email_verification_otp,$user));
        

        event(new Registered($user));
        Alert::success("$request->name", 'Registration was successful. Please check your email for verification.')->showConfirmButton('OK');

      //  Auth::login($user);

        return redirect()->route('verifyEmail', ['email' => $request->email]);
    
    }

    public function verifyotp()
    {
        return view('auth.verifyotp');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|min:4',
            'email' => 'required|email',
        ]);
    
        $user = User::where('email', $request->email)
            ->where('email_verification_otp', $request->otp)
            ->where('email_verification_otp_expires_at', '>', now())
            ->first();
    
        if (!$user) {
            Alert::error("error", 'Invalid or expired OTP.')->showConfirmButton('OK');
            return redirect()->back(); // Redirect back to the form
        }
    
        if ($user->email_verified_status !== 'no') {
            Alert::error("error", 'Email already verified.')->showConfirmButton('OK');
            return redirect()->route('login'); // Redirect to login if email is already verified
        }
    
        $user->update([
            'email_verified_at' => now(),
            'email_verified_status' => 'yes',
        ]);
    
        Alert::success("success", 'Email verified successfully. Login')->showConfirmButton('OK');
        return redirect()->route('login');
    }
    



    public function generateUniqueCode()
    {
        do {
            $code = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('my_ref_code', $code)->exists());

        return $code;
    }

    protected function generateOtp()
    {
        return rand(100000, 999999); 
    }
}
