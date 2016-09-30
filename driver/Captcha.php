<?php
// create and config the captcha:


class Captcha {

	public $load_path = "/image/";
	public $image_path = "static/image/";
	public $rand_pool = '0123456789abcdefghijklmnopqrstuvwxyz';
	public $x_length = 100; // width
	public $y_length = 30; // height
	public $font = 5;
	public $back_color = [0, 255, 127];
	public $words = '';

	public function create($length)
	{
		$bc = $this->back_color;
// create canvas:
		$image = imagecreate($this->x_length, $this->y_length);
		$bgcolor = imagecolorallocate($image, $bc[0], $bc[1], $bc[2]);
//		imagefill($image, 0, 0, $bgcolor);
		$this->captcha = $image;
// create canvas complete;

		$this->rand_ellipse($length); // ellipse join.
		$this->paste_text($length); // words join.
	}

	public function load_font($path)
	{
	    $font = @imageloadfont($path) ? : $this->print_err(__FUNCTION__);
		if ($font)
			$this->font = $font;
	}

//  paste words to canvas:
	private function paste_text($length)
	{
		for($once=0; $once<$length; $once++):
			$color = imagecolorallocate(
				$this->captcha,
				rand(0,44),
				rand(0,44),
				rand(0,44)
				); // end of color
			$text = substr(
				$this->rand_pool,
				rand(0, strlen($this->rand_pool)),
				1
				); // end of text of $this-> words
			$this->words .= $text; // add one word to captcha strings.
			
			// average divide $length:
			$x = ($once * $this->x_length/$length)+ rand(3,8);
			$y = rand(3,15);
		    @imagestring($this->captcha, $this->font, $x, $y, $text, $color) ?
				: $this->print_err(__FUNCTION__);
		endfor;
	}

	public function rand_point($num)
	{
//      must create image first:
		if (! isset($this->captcha))
			$this->print_err(__FUNCTION__); // end of check

	    for ($point=0; $point<$num; $point++):
			$color = imagecolorallocate(
				$this->captcha,
				rand(0, 100),
				rand(0, 100),
				rand(0, 100)
				);
		    @imagesetpixel(
				$this->captcha,
				rand(1, $this->x_length-1),
				rand(1, $this->y_length-1),
				$color
				) ? : $this->print_err(__FUNCTION__);
		endfor;
	}

	private function rand_ellipse($num)
	{
//      must create image first:
		if (! isset($this->captcha))
			$this->print_err(__FUNCTION__); // end of check

		for ($ellipse=0; $ellipse<$num; $ellipse++):
			$color = imagecolorallocate(
				$this->captcha,
				rand(200, 255),
				rand(200, 255),
				rand(255, 255)
				); // config color complete.
		    @imageellipse(
				$this->captcha,
				$cx = rand(10, $this->x_length-10),
				$cy = rand(5, $this->y_length-5),
				rand(10, $this->x_length-10),
				rand(5, $this->y_length-5),
				$color
				) ? : $this->print_err(__FUNCTION__);
		endfor;
	}

//  function error print:
	private function print_err($func)
	{
		die("Fail to create captcha: <b>Captcha::$func()</b> in " . __FILE__);
	}

//  send captcha and not save:
	public function print_image()
	{
		$filename = time();
//		header("Content-type: image/png");
//		imagepng($this->captcha);
		imagepng($this->captcha, $this->image_path . "{$filename}.png");
		echo "<img src=\"{$this->load_path}$filename.png\" />";
		return $filename;
	}
}
