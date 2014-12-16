<?php 
namespace Dnianas\User;

use Dnianas\Forms\Registeration as Registeration;

use Dnianas\Forms\GettingStarted as GettingStarted;


class UserRegisterService 
{
    /**
     * @var Dnianas\Forms\Registeration
     */
    protected $registerationForm; 

    /**
     * @var Dnianas\Forms\GettingStarted
     */
    protected $GettingStartedForm; 

    protected $code;

    public function __construct(Registeration $registeration, GettingStarted $getting_started) 
    {
        $this->registerationForm    = $registeration;
        $this->gettingStartedForm   = $getting_started;
    }   

    public function register(array $input)
    {
        // Validation is OK, So we insert it into database
        $user = new \User;
        $this->code = str_random(80);
        $user->first_name   = $input['first_name'];
        $user->last_name    = $input['last_name'];
        $user->username     = $input['username'];
        $user->email        = $input['email'];
        $user->password     = \Hash::make($input['password']);
        $user->gender       = $input['gender'];
        $user->active       = 0;
        $user->code         = $this->code;
        $user->birthday     =\Carbon::createFromDate($input['birth_year'], $input['birth_month'], $input['birth_day']);
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

    public function updateUser()
    {

    }
}