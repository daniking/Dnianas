<?php
use Dnianas\Forms\RegistrationForm;
use Dnianas\Forms\LoginForm;

use Dnianas\User\UserRegisterService;

use Laracasts\Validation\FormValidationException;

class AuthController extends BaseController
{

    /**
     * @var Dnianas\Forms\RegistrationForm
     */
    protected $registeration;

    /**
     * @var Dnianas\Forms\Login
     */
    protected $login;

    /**
     * @var Dnianas/Forms/Registration
     */
    protected $registrationForm;

    /**
     * @param LoginForm $login
     * @param UserRegisterService $registration
     * @param RegistrationForm $registrationForm
     */
    public function __construct(
            LoginForm $login, 
            UserRegisterService $registration,
            RegistrationForm $registrationForm 
        )
    {
        $this->registrationForm     = $registrationForm;
        $this->registeration        = $registration;
        $this->login                = $login;
    }

    /**
     * @return mixed
     */
    public function postRegister()
    {
        // Get the input
        $input = Input::all();

        // Validate the user's input
        try {
            $this->registrationForm->validate(Input::all());
        } catch (FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        // Register the user
        $this->registeration->register($input);

        // Send a confirmation email
        $this->registeration->sendConfirmationEmail(Input::get('email'), Input::get('username'));

        // Log the user in 
        $login = Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')], true);

        if ($login) {
            Session::put('after_register', true);
            return Redirect::to('getting_started')->with('message', 'An activation link has been sent to your email, Activate your account now.');
        }

        return Redirect::to('/')->with('message','An error occured while sending your activation link');
        
    }

    /**
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($code)
    {
        $user = User::where('code', '=', $code)->first();

        if (!empty($user)) {
            $user->active = 1;
            $user->code   = '';
            $user->save();
            return Redirect::to('/')->with('message', 'Your account has been activated succesfully!');
        }

        return Redirect::to('/');
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Laracasts\Validation\FormValidationException
     */
    protected function postLogin()
    {
        // Validate the user input
        try {
            $this->login->validate(Input::all());   
        } catch (FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        // Grab the user input to log them in
        $username = Input::get('username');
        $password = Input::get('password');

        // Try to log them in
        if (Auth::attempt(['username' => $username, 'password' => $password], true)) {
            return Redirect::intended('/');
        } else if (Auth::attempt(['email' => $username, 'password' => $password], true)) {
            return Redirect::intended('/');
        }

        // If the username/password was incorrect
        return Redirect::back()->withErrors('You entered wrong email/password combination');

    }

    /**
     * Logout the current user
     * 
     * @return boolean
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->with('message', 'You\'ve been logged out.');
    }
}