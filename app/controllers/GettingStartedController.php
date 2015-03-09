<?php 

use Dnianas\User\UserRepository;

use Dnianas\Forms\GettingStarted;

use Laracasts\Validation\FormValidationException;

class GettingStartedController extends BaseController
{

    /**
     * The user repository
     * @var object
     */
    protected $user;

    /**
     * Inject the depenencies to the controller
     * @param Object $user The user repository
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
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
            $this->gettingStarted->validate(Input::all());
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
        // Get the input
        $profile_picture = Input::file('profile_picture');

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
        
        $extension = $profile_picture->getClientOriginalExtension();
        $file_name = $profile_picture->getClientOriginalName();

        $image = Image::make($profile_picture);

        $name = sha1(time() . $file_name);
        // Sample: domain.com/photos/4952058f4d990c21019c7bc6a319bddcba6cbfa9.png
        $destination = photos_path() . '/' . $name . '.' . $extension;

        $image->fit(300, 300);
        $image->save($destination);

        //$this->image->makeThumbnail($imageFile, $destination);

        $image = Auth::user()->photos()->create([
            'profile_picture' => true, 
            'path' => $name . '.' .$extension
            ]);

        return Response::json(['success' => 'true', 'image_path' => '/photos/' . $image->path]);
    }

    /**
     * TODO: Make this code better.
     * This is not the controller's resposibilty.
     */
    public function setCoverPhoto()
    {
        $cover_photo = Input::file('cover_photo');

        $coverPhotoForm = App::make('Dnianas\Forms\CoverPhotoForm');

        try {
            $coverPhotoForm->validate(Input::all());
        } catch (FormValidationException $e) {
            return Response::json([
                'success' => 'false',
                'message' => 'The selected file is not an image.'
            ]);
        }
        
        $extension = $cover_photo->getClientOriginalExtension();
        $file_name = $cover_photo->getClientOriginalName();

        $image = Image::make($cover_photo);

        $name = sha1(time() . $file_name);
        // Sample: domain.com/photos/4952058f4d990c21019c7bc6a319bddcba6cbfa9.png
        $destination = photos_path() . '/' . 'cover-'. $name . '.' . $extension;

        $image->fit(900, 350);
        $image->save($destination);

        $image = Auth::user()->photos()->create([
            'cover_photo' => true, 
            'path' => $name . '.' .$extension
            ]);

        return Response::json(['success' => 'true', 'image_path' => '/photos/cover-' . $image->path]);
    }

}