<?php 
class FileUploader {
	
	public $filePath;
	public $isCreated;
	
	function createFile($filePostName,$fileLocation = "", $fileType = "-1")
	{
		if(isset($_FILES[$filePostName]))
		{
			if($fileLocation == "")
				$this->filePath = getcwd() . "/" . $_FILES[$filePostName]["name"];
			else
				$this->filePath = $fileLocation ."/" . $_FILES[$filePostName]["name"];

			if($fileType == "-1")
			{
				
				if( !file_exists($filePath) && move_uploaded_file($_FILES[$filePostName]["tmp_name"], $this->filePath))
					$this->isCreated = true;
				else
					$this->isCreated = false;
			}
			else
			{
				$file_ext= strtolower(end(explode('.',$_FILES[$filePostName]['name'])));
				
				if($file_ext == $fileType && !file_exists($this->filePath) && move_uploaded_file($_FILES[$filePostName]["tmp_name"], $this->filePath))
					$this->isCreated = true;
				else
					$this->isCreated = false;
			}
		}
	}
	
	
	function deleteFile()
	{
		unlink($this->filePath);
	}
}

?>