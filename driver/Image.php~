<?php
class Image {

	const MODEPNG = 'imagecreatefrompng';
	const MODEJPEG = 'imagecreatefromjpeg';

	public $image_path = '/home/phptest/static/media/';

    public function __construct($image, $mode)
	{
		$this->image_name = "{$this->image_path}$image";
		$this->image = call_user_func($mode, "{$this->image_path}$image");
	}

	public function makemark($image, $mode)
	{
		$logo = call_user_func($mode, "{$this->image_path}$image");
		$logo_width = imagesx($logo);
		$logo_height = imagesy($logo);
		imagecopy($this->image, $logo, 0, 0, 0, 0, $logo_width, $logo_height);
	}

	public function flip()
	{
		$width = imagesx($this->image);
		$height = imagesy($this->image);
		$new = imagecreatetruecolor($width, $height);
		for ($x=0; $x < $width; $x++) {
			imagecopy($new, $this->image, $width-$x, 0, $x, 0, 1, $height);
		}
		$this->image = $new;
	}

	public function send()
	{
		$info = finfo_open(FILEINFO_MIME_TYPE);
		if (finfo_file($info, $this->image_name) == 'image/png'):
			header('Content-type: image/png');
			imagepng($this->image);
		elseif (finfo_file($info, $this->image_name) == 'image/jpeg'):
			header('Content-type: image/jpeg');
		    header($this->image);
		else:
			die("no support type");
		endif;
	}
}
