<?php
use Dnianas\Forms\Registration;
use Dnianas\Forms\Login;
use Dnianas\Forms\GettingStarted;

use Dnianas\User\UserRegisterService;

use Laracasts\Validation\FormValidationException;

class AuthController extends BaseController
{

    /**
     * @var Dnianas\Forms\Registration
     */
    protected $registeration;

    /**
     * @var Dnianas\Forms\Login
     */
    protected $login;

    /** 
     * @var Dnianas\Forms\GettingStarted
     */
    protected $getting_started;

    protected $registrationForm;

    /**
     * @param Login $login
     * @param UserRegisterService $registration
     * @param Registration $registrationForm
     * @param GettingStarted $getting_started
     */
    public function __construct(
        Login $login, UserRegisterService $registration,
        Registration $registrationForm, GettingStarted $getting_started
        )
    {
        $this->registrationForm     = $registrationForm;
        $this->registeration        = $registration;
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

    /**
     * Post the getting_started form
     * @return Redirect
     */
    public function getGettingStarted()
    {
        if (Session::has('after_register')) {
            return View::make('auth.step_one');
        }

        return Redirect::to('/');
    }

    /**
     * @return mixed
     * @throws \Laracasts\Validation\FormValidationException
     */
    public function postGettingStarted()
    {
        // Validate the user input
        try {
            $this->getting_started->validate(Input::all());
        } catch(FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        // Passed, So we insert it into database
        $this->registeration->updateUser(Input::all(), Auth::user()->id);
        
        // Kill the session
        Session::pull('after_register');
        
        Session::put('step_two', true);

        // Redirect with success message
        return Redirect::to('/getting_started/step_two')->with('message', 'Setup your profile picture and cover photo');
    }

    /**
     * TODO: Make this code better.
     */
    public function setProfilePicture()
    {
        $profile_picture = Input::file('profile_picture');

        $rules = ['profile_picture' => 'required|min:10|image|real_image|'];

        $validator = Validator::make(['profile_picture' => $profile_picture], $rules);

        if ($validator->fails()) {
            return Response::json([
                'success' => 'false',
                'message' => 'The selected file is not an image.'
                ]);
        }
        
        $extension = $profile_picture->getClientOriginalExtension();
        $file_name = $profile_picture->getClientOriginalName();

        $image = Image::make($profile_picture);

        $name = sha1(time() . $file_name);
        // Sample: domain.com/photos/4952058f4d990c21019c7bc6a319bddcba6cbfa9.png
        $destination = photos_path() . '/' . $name . '.' . $extension;

        $image->fit(300, 300);
        $image->save($destination);

        $image = Auth::user()->photos()->create([
            'profile_picture' => true, 
            'path' => $name . '.' .$extension
        ]);

        return Response::json(['success' => 'true', 'image_path' => '/photos/' . $image->path]);
    }

}