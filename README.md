# scan_and_reszie_image_auto

1. Install lib 
ON Ubuntu
	php -v 
if version php is 7.0
	sudo apt-get install php7.0-gd
if version php is 7.2
	sudo apt-get install php7.2-gd

2. Copy to folde scan
3. run with "php scan.php"



Folded like

	| folder_upload 
		| scan.php
		|______ 01
		|______ 02
		|______ 03


scan.php will scan image.png in sub folder folder_upload ( 01, 02, 03 ) and if size of image > 1Mb -> Resize to 1024px 