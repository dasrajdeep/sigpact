<?php

class Graphics {
	
	const STORE = 'data/graphics/';
	
    public function createImageString($imageFile) {

        $imageInfo = getimagesize($imageFile);
        $imageString = file_get_contents($imageFile);

        if ($imageInfo)
            return $imageString;
    }

    public function getMIME($imageFile) {

        $imageInfo = getimagesize($imageFile);

        return $imageInfo['mime'];
    }

    public function resizeImageString($imageString, $mime, $width, $height) {

        $image = imagecreatefromstring($imageString);
        $image_width = imagesx($image);
        $image_height = imagesy($image);

        $temp = imagecreatetruecolor($width, $height);
        $background = imagecolorallocate($temp, 0, 0, 0);
        imagecolortransparent($temp, $background);
        imagealphablending($temp, false);
        imagecopyresampled($temp, $image, 0, 0, 0, 0, $width, $height, $image_width, $image_height);
        imagesavealpha($temp, true);
        $image = $temp;

        ob_start();
        $type = substr($mime, 6);
        if ($type === 'jpeg')
            imagejpeg($image);
        else if ($type === 'gif')
            imagegif($image);
        else if ($type === 'png')
            imagepng($image);
        $image = ob_get_clean();

        return $image;
    }
    
    public function resizeImageStringByFactor($imageString, $mime, $factor) {
        
        $image = imagecreatefromstring($imageString);
        $image_width = imagesx($image);
        $image_height = imagesy($image);
        
        $required_width = $image_width * $factor;
        $required_height = $image_height * $factor;
        
        return $this->resizeImageString($imageString, $mime, $required_width, $required_height);
    }
    
	public function storeGraphics($imageFile) {
		
		$mime = $this->getMIME($imageFile);
		$original = $this->createImageString($imageFile);
		$thumbnail = $this->resizeImageString($original, $mime, 150, 150);
		
		$extension = pathinfo($imageFile, PATHINFO_EXTENSION);
		$filename = null;
		
		while(!$filename) {
			$filename = Utilities::generateRandomString().'.'.strtolower($extension);
			if(file_exists($this::STORE.$filename)) $filename = null;
			else break;
		}
		
		$result = file_put_contents($this::STORE.$filename.'_original.'.$extension, $original) &
			file_put_contents($this::STORE.$filename.'_thumbnail.'.$extension, $thumbnail);
		
		if($result === FALSE) return FALSE;
		
		@unlink($imageFile);
		
		$graphic = R::dispense('graphic');
		
		$graphic->mime = $mime;
		$graphic->original = $filename.'_original.'.$extension;
		$graphic->thumbnail = $filename.'_thumbnail.'.$extension;
		
		return R::store($graphic);
	}
    
	public function deleteGraphics($graphicsID) {
		
		$graphic = R::load('graphic', $graphicsID);
		
		$original_file = $this::STORE.$graphic->original;
		$thumbnail_file = $this::STORE.$graphic->thumbnail;
		
		unlink($original_file);
		unlink($thumbnail_file);
		
		R::trash($graphic);
	}
	
}

?>
