<?php 
namespace Dnianas\User;

use Auth;

use About;

class UserRegisterService 
{

    /**
     * The activation code that sent by an email
     * @var string
     */
    protected $code;

    public function register(array $input)
    {
        // Validation is OK, So we insert it into database
        $user = new \User;
        $this->code = str_random(80);
        $user->first_name       = $input['first_name'];
        $user->last_name        = $input['last_name'];
        $user->username         = $input['username'];
        $user->email            = $input['email'];
        $user->password         = \Hash::make($input['password']);
        $user->gender           = $input['gender'];
        $user->active           = 0;
        $user->code             = $this->code;
        $user->birthday         =\Carbon::createFromDate($input['birth_year'], $input['birth_month'], $input['birth_day']);
        $user->profile_picture  = 'profile_picture.jpg';
        $user->save();       
    }

    /**
     * Sends a confirmation email to the user
     * @param  string $email    The user's email
     * @param  string $username The users's username
     * @return boolean           
     */
    public function sendConfirmationEmail($email, $username)
    {
        $data = [
            'username' => $username,
            'code'     => $this->code
        ];
        \Mail::send('emails.verify', $data, function($message) use(&$email)
        {
            $message->from('akarmathers13@gmail.com', 'Dnianas');
            $message->to($email, 'Member')->subject('Welcome to Dnianas! Activate your account now!');
        });
    }

    public function updateUser(array $input, $user_id)
    {
        $about = new About;
        
        $about->address     = $input['address'];
        $about->job_title   = $input['job_title'];
        $about->website     = $input['website'];
        $about->about       = $input['about'];
        $about->user_id     = $user_id;

        // Save it to the database
        $about->save();


    }
}