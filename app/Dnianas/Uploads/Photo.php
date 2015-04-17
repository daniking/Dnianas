<?php 
namespace Dnianas\Uploads;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo 
{    

    /**
     * The image filename.
     * @var string
     */
    protected $filename;

    /**
     * The image extension.
     * @var string
     */
    protected $extension;

    /**
     * The image hashed value that we hashed using SHA1.
     * @var string
     */
    protected $hashedName;

    /**
     * The filename with the hashed name and the extension.
     * @var string
     */
    public $path;

    /**
     * The input from the user, Usually it's the file.
     * @var object
     */
    public $input;

    public function __construct(UploadedFile $input)
    {
        $this->input        = $input;
        $this->fileName     = $this->input->getClientOriginalName();
        $this->extension    = $this->input->getClientOriginalExtension();
        $this->hashedName   = sha1(time() . $this->fileName);
        $this->path         = $this->hashedName . '.' .$this->extension;
    }

    public function makeProfilePicture()
    {
        // Resize the image
        $image = \Image::make($this->input);
        $image->fit(300, 300);

        // Set the destination
        $destination = photos_path() . '/' . $this->path;

        // Save the image
        $image->save($destination);

        // Return the object
        return $this;
    }

    public function makeCoverPhoto()
    {
        // Resize the image
        $image = \Image::make($this->input);
        $image->fit(900, 350);

        // Set the destination
        $destination = photos_path() . '/cover-' . $this->path;

        // Save the image
        $image->save($destination);

        return $this;
    }

}
