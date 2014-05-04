<?php

class Graphics {

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
    
}

?>
