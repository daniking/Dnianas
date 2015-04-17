<?php 

use Dnianas\User\UserRepository;

use Laracasts\Validation\FormValidationException;

use Dnianas\Uploads\Photo;

use Dnianas\User\UserRegisterService;

class GettingStartedController extends BaseController
{

    /**
     * The user repository
     * @var object
     */
    protected $user;

    /**
     * The photo helper
     * @var object
     */
    protected $photo;

    protected $registeration;
    /**
     * Inject the depenencies to the controller
     * @param Object $user The user repository
     */
    public function __construct(UserRepository $user, UserRegisterService $registeration)
    {
        $this->user     = $user;
        $this->registeration = $registeration;
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
        $gettingStarted= App::make('Dnianas\Forms\GettingStartedForm');
        // Validate the user input
        try {
            $gettingStarted->validate(Input::all());
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


    public function setProfilePicture()
    {
        // Get the input
        $input = Input::file('profile_picture');

        // Get the validation form
        $profilePictureForm = App::make('Dnianas\Forms\ProfilePictureForm');

        // Validate the image
        try {
            $profilePictureForm->validate(Input::all());
        } catch (FormValidationException $e) {
            return Response::json([
                'success' => 'false',
                'message' => 'The selected file is not an image.'
            ]);
        }

        // Resize the profile picture and save
        $profilePicture = (new Photo($input))->makeProfilePicture();

        $user = Auth::user();

        $user->profile_picture = $profilePicture->path;
        $user->save();

        return Response::json(['success' => 'true', 'image_path' => '/photos/' . $user->profile_picture]);
    }


    public function setCoverPhoto()
    {

        // Get the cover form
        $coverPhotoForm = App::make('Dnianas\Forms\CoverPhotoForm');

        // Validate the input
        try {
            $coverPhotoForm->validate(Input::all());
        } catch (FormValidationException $e) {
            return Response::json([
                'success' => 'false',
                'message' => 'The selected file is not an image.'
            ]);
        }
        
        // Resize the cover photo and store it.
        $input = Input::file('cover_photo');
        $cover = (new Photo($input))->makeCoverPhoto();

        $user = Auth::user();

        $user->cover_photo = $cover->path;
        $user->save();

        return Response::json(['success' => 'true', 'image_path' => '/photos/cover-' . $user->cover_photo]);
    }

}