<?php 
namespace Dnianas\Uploads;

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

    public function makeProfilePicture($input)
    {
        $this->fileName     = $input->getClientOriginalName();
        $this->extension    = $input->getClientOriginalExtension();
        $this->hashedName   = sha1(time() . $this->fileName);
        $this->path         = $this->hashedName . '.' .$this->extension;

        // Resize the image
        $image = \Image::make($input);
        $image->fit(300, 300);

        // Set the destination
        $destination = photos_path() . '/' . $this->path;

        // Save the image
        $image->save($destination);

        // Return the object
        return $this;
    }

    public function makeCoverPhoto($input)
    {
        $this->fileName     = $input->getClientOriginalName();
        $this->extension    = $input->getClientOriginalExtension();
        $this->hashedName   = sha1(time() . $this->fileName);
        $this->path         = $this->hashedName . '.' .$this->extension;

        // Resize the image
        $image = \Image::make($input);
        $image->fit(900, 350);

        // Set the destination
        $destination = photos_path() . '/cover-' . $this->path;

        // Save the image
        $image->save($destination);

        return $this;
    }

}
