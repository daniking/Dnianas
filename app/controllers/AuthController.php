<?php
use Dnianas\Forms\Registeration as Registeration;
use Dnianas\Forms\Login as Login;
use Dnianas\Forms\GettingStarted;

use Dnianas\Services\UserRegisterService;

use Laracasts\Validation\FormValidationException;

class AuthController extends BaseController
{

    protected $registeration;

    /*
     * Dnianas\Forms\Login
     */
    protected $login;

    /** 
     * @var Dnianas\Forms\GettingStarted
     */
    protected $getting_started;

    protected $registerationForm;

    /**
     * @param Login $login
     * @param UserRegisterService $registeration
     * @param GettingStarted $getting_started
     */
    public function __construct(
            Login $login, UserRegisterService $registeration, 
            Registeration $registerationForm, GettingStarted $getting_started
        )
    {
        $this->registerationForm    = $registerationForm;
        $this->registeration        = $registeration;
        $this->login                = $login;
        $this->getting_started      = $getting_started;
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
            $this->registerationForm->validate(Input::all());   
        } catch (FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        // Register the user
        $register = $this->registeration->register($input);

        // Send a confirmation email
        $this->registeration->sendConfirmationEmail(Input::get('email'), Input::get('username'));

        // Log the user in 

        $login = Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')], true);
        if ($login) {
            Session::put('after_register', true);
            return Redirect::to('getting_started')->withMessage('An activation link has been sent to your email, Activate your account now.');
        }

        return Redirect::to('/')->withMessage('An error occured while sending your activation link');
        
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
            return Redirect::to('/')->withMessage('Your account has been activated succesfully!');
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
        $data = [
        'username' => Input::get('username'),
        'password' => Input::get('password')
        ];

        if (Auth::attempt($data, true)) {
            return Redirect::intended('/');
        } else {
            return Redirect::back()->withMessage('You entered wrong email/password combination');
        }

    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->withMessage('You\'ve been logged out, Good bye!');
    }

    public function getGettingStarted()
    {
        if (Session::has('after_register')) {
            return View::make('auth.getting_started');
        } else {
            return Redirect::to('/');
        }
    }
    /**
     * @return mixed
     * @throws \Laracasts\Validation\FormValidationException
     */
    public function postGettingStarted()
    {
        // Validate the user input
        $validation = $this->getting_started->validate(Input::all());

        // Passed, So we insert it into database
        $about = new About;
        
        // $this->getting_started->update();
        $about->address     = Input::get('address');
        $about->job_title   = Input::get('job_title');
        $about->website     = Input::get('website');
        $about->about       = Input::get('about');
        $about->user_id     = Auth::id();
        $about->save();

        // Kill the session
        Session::pull('after_register');

        return Redirect::to('/')->withMessage('You account information has been updated.');
    }

}