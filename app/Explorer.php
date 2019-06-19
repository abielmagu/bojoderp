<?php

class	Explorer
{		
	public static function createGallery($path)
	{
		$folder = GALLERY.$path;
		if( !is_dir($folder) )
		{
			return mkdir($folder, 0777);
		}
		return false;
	}
	
	public static function getGallery($idclient, $idwork)
	{
		$pathGallery = GALLERY.$idclient.DS.$idwork.DS;
		return self::listGallery($pathGallery, ['jpg']);
	}
	
	private static function listGallery($path, $extensions = false)
	{
		if(is_dir($path) && is_array($extensions))
		{
			$files = array();
			$pathOpen = opendir($path);
			while($file = readdir($pathOpen))
			{
				$split = explode('.', $file);
				foreach($extensions as $extension)
				{
					if($extension === end($split))
					{
						array_push($files, $file);
					}
				}
			}
			return $files;
		}
		return false;
	}
	
	public static function removeDirectory($id)
  {
    #return rmdir($id);
  }
	
	public static function uploadToGallery($file, $photoname, $ids)
  {
		$path = GALLERY.$ids['client'].DS.$ids['work'];
		$pathPhoto = $path.DS.$photoname.'.jpg';
		return move_uploaded_file($file, $pathPhoto);
  }
	
	/*
	public static function counterFiles($path = null, $fileTypes = null)
  {
		$validExtensions = implode( ',' , $fileTypes );
		$validPath = $path . '{' . $validExtensions . '}';
		$pathGlob = glob( $validPath , GLOB_BRACE );
		return count( $pathGlob );
  }
	*/
	
/********************************************************************************************/
	
  public static function putContent($route, $file, $content)
  {
		if( is_dir($route) )
		{
			$path  = $route.'/'.$file;
			$fopen = fopen($path, 'w');
			fputs($fopen, $content);
			fclose($fopen);
			return $fopen;
		}
		return false;
  }

  public static function getContent($route, $file)
  {
		$path = $route.'/'.$file;
		if( is_file($path) )
		{
			$fopen 	 = fopen($path, 'r');
			$content = fgets($fopen);
			fclose($fopen);
			return $content;
		}
		return false;
  }
}