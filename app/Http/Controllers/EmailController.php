<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(): Response
    {
        return response()
            ->view('login');
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::attempt($validateData)) {
            return redirect('/done');
        } else {
            return back();
        }
    }

    public function done()
    {
        return 'Login Berhasil';
    }

    public function registerView(): Response
    {
        return response()
            ->view('register');
    }

    public function store(Request $request)
    {
        $user = New User;
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $token = $user->id.hash('sha256', Str::random(120));
        // $tokenbcript = bcrypt($user->id);
        $verifyURL = route('verify', ['token' => $token]);

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        $message = 'Terima Kasih karena sudah mendaftarkan email anda ke akun kami <br> YESSS!!!';

        $mail_data = [
            'recipient'=>$request->input('email'),
            // recipient = Penerima
            'subject'=> 'Email Verify',
            'body'=> $message,
            'actionLink'=>$verifyURL
        ];

        Mail::send('email', $mail_data, function($messege) use ($mail_data) {
            $messege->from('admin@abdataccounting.com', 'Abdat Accounting');
            $messege->to($mail_data['recipient'])
                    ->subject($mail_data['subject']);
        });

        return redirect('/');
    }

    public function verify(Request $request)
    {
        $token = $request->token;
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (!is_null($verifyUser)){
            $user = $verifyUser->user;
            if ($user->email_verified == 0) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();

                return redirect('/');
            } else {
                return abort(403);
            }
        }
    }
}
