

<?php
// Target folder
$target_dir = "d://docvault/"; //change to d://docvault/ for shared drive

$download_file = $_GET['file'];
$download_file_with_path = $target_dir . $download_file;
						
		
			//download target file
			header('Content-Description: File Transfer');
			header('Content-Type: ' . mime_content_type($download_file_with_path));
			header('Content-Disposition: inline; filename="'.basename($download_file_with_path).'"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($download_file_with_path));
			ob_clean();
			flush();
			readfile($download_file_with_path);
			die();
	
		
		
?>