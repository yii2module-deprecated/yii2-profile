<?php

namespace yii2module\profile\domain\v2\repositories\fly;

use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\helpers\yii\FileHelper;
use yii2module\profile\domain\v2\interfaces\repositories\AvatarInterface;
use yii\imagine\Image;

class AvatarUploadRepository extends BaseRepository implements AvatarInterface {
	
	public $quality = 90;
	public $size = 256;
	public $format = 'png';
	public $pathName = 'images/avatars';
	
	public function save($tempName, $userId) {
		$originalFile = $this->getFileNameOfUploaded($userId, $tempName, 'original');
		$thumbFile = $this->getFileNameOfUploaded($userId, $tempName);
		$staticFs = $this->storeInstance();
		if($staticFs->has($originalFile)) {
			$staticFs->delete($originalFile);
		}
		$staticFs->write($originalFile, file_get_contents($tempName));
		$thumbTempName = $this->saveThumb($originalFile);
		$staticFs->write($thumbFile, file_get_contents($thumbTempName));
		return $this->getNameOfUploaded($userId, $tempName);
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
		$size = $this->size;
		$fullThumbPath = Yii::getAlias('@runtime/upload_temp');
		FileHelper::createDirectory($fullThumbPath);
		$fullThumbFileName = $fullThumbPath . DS . basename($originalFile);
		Image::thumbnail($originalFile, $size, $size)
			->save($fullThumbFileName, ['quality' => $this->quality]);
		return $fullThumbFileName;
	}
	
	private function storeInstance() {
		/** @var \League\Flysystem\Adapter\Ftp $staticFs */
		$staticFs = Yii::$app->ftpFs;
		return $staticFs;
	}
	
	private function getFileName($fileName, $subDirectory = null) {
		$basePath = $this->getFilePath($subDirectory);
		$baseFileName = $this->getBaseFileName($fileName);
		return $basePath . SL . $baseFileName;
	}
	
	private function getFileNameOfUploaded($userId, $fileName, $subDirectory = null) {
		$basePath = $this->getFilePath($subDirectory);
		$name = $userId . BL . $this->getHash($fileName);
		$baseFileName = $this->getBaseFileName($name);
		return $basePath . SL . $baseFileName;
	}
	
	private function getNameOfUploaded($userId, $fileName) {
		return $userId . BL . $this->getHash($fileName);
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
	
	private function getHash($fileName) {
		return hash_file('crc32b', $fileName);
	}
}