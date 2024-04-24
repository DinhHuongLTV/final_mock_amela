<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('login');
    }

    
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'bail|required|string',
            'password' => 'bail|required|string|min:6',
        ], [
            $this->username().'.required' => 'Tên đăng nhập không để trống',
            $this->username().'.string' => 'Tên đăng nhập không hợp lệ',
            // $this->username().'.email' => 'Tên đăng nhập không đúng định dạng email',
            // $this->username().'.min' => 'Tên đăng nhập quá ngắn',
            'password.required' => 'Mật khẩu không để trống',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.min' => 'Mật khẩu chứa ít nhất 6 ký tự',
        ]);
    }

    public function username()
    {
        return 'username';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không hợp lệ'],
        ]);
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $dbField = 'email';            
        } else {
            $dbField = 'username';
        }
        $dataArr = [
            $dbField => $request->username,
            'password' => $request->password
        ];
        // return $request->only($this->username(), 'password');
        return $dataArr;
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath())
                                ->with('msg', 'Đăng nhập thành công');
    }

}

