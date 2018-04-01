<?php

namespace yii2module\profile\domain\v2\repositories\fly;

use creocoder\flysystem\Filesystem;
use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\helpers\TempHelper;
use yii2lab\helpers\yii\FileHelper;
use yii2module\profile\domain\v2\interfaces\repositories\AvatarInterface;
use yii\imagine\Image;

class AvatarUploadRepository extends BaseRepository implements AvatarInterface {
	
	public $quality = 90;
	public $size = 256;
	public $format = 'png';
	public $pathName = 'images/avatars';
	
	/**
	 * @var Filesystem
	 */
	private $storeInstance;
	
	public function save($tempName, $userId) {
		$name = $this->getNameOfUploaded($userId, $tempName);
		$originalFile = $this->getFileNameOfUploaded($userId, $tempName, 'original');
		$thumbFile = $this->getFileNameOfUploaded($userId, $tempName);
		$staticFs = $this->storeInstance();
		if($staticFs->has($originalFile)) {
			$staticFs->delete($originalFile);
		}
		$staticFs->write($originalFile, file_get_contents($tempName));
		$tempFile = TempHelper::fullName($this->getBaseFileName($name));
		FileHelper::copy($tempName,  $tempFile);
		$thumbTempName = $this->saveThumb($tempFile);
		$staticFs->write($thumbFile, file_get_contents($thumbTempName));
		TempHelper::clearAll();
		return $name;
	}
	
	public function delete($fileName) {
		$staticFs = $this->storeInstance();
		$originalFile = $this->getFileName($fileName, 'original');
		$thumbFile = $this->getFileName($fileName);
		if($staticFs->has($originalFile)) {
			$staticFs->delete($originalFile);
		}
		if($staticFs->has($thumbFile)) {
			$staticFs->delete($thumbFile);
		}
	}
	
	private function saveThumb($originalFile) {
		$fullThumbFileName = TempHelper::fullName('thumb' . DS . basename($originalFile));
		Image::thumbnail($originalFile, $this->size, $this->size)
			->save($fullThumbFileName, ['quality' => $this->quality]);
		return FileHelper::normalizePath($fullThumbFileName);
	}
	
	private function storeInstance() {
		if($this->storeInstance instanceof Filesystem) {
			return $this->storeInstance;
		}
		$definition = env('servers.static.connection');
		$driver = env('servers.static.driver');
		$driver = ucfirst($driver);
		$definition['class'] = 'creocoder\flysystem\\' . $driver . 'Filesystem';
		$this->storeInstance = Yii::createObject($definition);
		return $this->storeInstance;
	}
	
	private function getFileName($fileName, $subDirectory = null) {
		$basePath = $this->getFilePath($subDirectory);
		$baseFileName = $this->getBaseFileName($fileName);
		return $basePath . SL . $baseFileName;
	}
	
	private function getFileNameOfUploaded($userId, $fileName, $subDirectory = null) {
		$basePath = $this->getFilePath($subDirectory);
		$name = $userId . BL . $this->getHashFromFileName($fileName);
		$baseFileName = $this->getBaseFileName($name);
		return $basePath . SL . $baseFileName;
	}
	
	private function getNameOfUploaded($userId, $fileName) {
		return $userId . BL . $this->getHashFromFileName($fileName);
	}
	
	private function getBaseFileName($fileName) {
		$fileBaseName = $fileName . DOT . $this->format;
		return $fileBaseName;
	}
	
	private function getFilePath($subDirectory = null) {
		$basePath = $this->pathName;
		if($subDirectory) {
			$basePath .= SL . $subDirectory;
		}
		return $basePath;
	}
	
	private function getHashFromFileName($fileName) {
		return hash_file('crc32b', $fileName);
	}
}