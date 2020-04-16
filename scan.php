<?php
    
    // sudo apt-get install php7.0-gd
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    
    
    if ($handle = opendir('.')) {
        
        while (false !== ($entry = readdir($handle))) {
            
            if ($entry != "."
                && $entry != ".."
                && strpos($entry, '.') == false
                ) {
                
                if ($handle2 = opendir('./' . $entry )) {
                    
                    while (false !== ($entry2 = readdir($handle2))) {
                        
                        if ($entry2 != "." && $entry2 != ".." && strpos($entry2, '.png') !== false ) {
                            
                            $basic = dirname(__FILE__) . "/";
                            
                            $mySize = human_filesize2(filesize($basic.$entry."/".$entry2), 2);
                            
                            // If image have size more than 1MB
                            if ( $mySize > 1 ) {
                                
                                $newimg = resize_image($basic.$entry."/".$entry2, 800, 800, FALSE);
                                imagepng( $newimg, $basic.$entry."/".$entry2, 3);
                                echo $basic.$entry."/".$entry2 . " - $mySize MB \n";
                                
                            }
                            
                        }
                    }
                    closedir($handle2);
                }
            }
        }
        
        closedir($handle);
    }
    
    
    function resize_image($file, $w, $h, $crop=FALSE) {
        
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        
        $src = imagecreatefrompng($file);
        // echo $file."\n";
        // $src = imagecreatefromstring(file_get_contents($file));
        
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        
        return $dst;
    }
    
    function human_filesize2($bytes, $decimals = 2) {
        return ceil ( $bytes / pow(1024, 2) );
    }
    
    ?>
