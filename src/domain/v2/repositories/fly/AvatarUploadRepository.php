<?php

namespace yii2module\profile\domain\v2\repositories\fly;

use yii\web\UploadedFile;
use yii2lab\domain\repositories\StaticServerRepository;
use yii2lab\helpers\TempHelper;
use yii2lab\helpers\yii\FileHelper;
use yii2module\profile\domain\v2\interfaces\repositories\AvatarInterface;
use yii\imagine\Image;

class AvatarUploadRepository extends StaticServerRepository implements AvatarInterface {
	
	public $quality = 90;
	public $size = 256;
	public $format = 'png';
	public $pathName = 'images/avatars';
	
	public function save(UploadedFile $uploaded, $userId) {
		$tempFile = TempHelper::copyUploadedToTemp($uploaded);
		$name = $this->getNameOfUploaded($userId, $tempFile);
		$thumbTempName = $this->saveTempThumb($tempFile);
		$thumbBaseFileName = $this->getBaseFileName($name);
		$thumbTempContent = FileHelper::load($thumbTempName);
		$this->writeFile($thumbBaseFileName, $thumbTempContent);
		TempHelper::clearAll();
		return $name;
	}
	
	public function delete($fileName) {
		$thumbFile = $this->getBaseFileName($fileName);
		$this->removeFile($thumbFile);
	}
	
	private function saveTempThumb($tempFile) {
		$baseName = $this->pureFileNameWithFormat($tempFile);
		$blob = $this->convertThumb($tempFile);
		$tempFileName = 'thumb' . DS . $baseName;
		TempHelper::save($tempFileName, $blob);
		$tempThumbFileName = TempHelper::fullName($tempFileName);
		return FileHelper::normalizePath($tempThumbFileName);
	}
	
	private function convertThumb($fileName) {
		$image = Image::thumbnail($fileName, $this->size, $this->size);
		$blob = $image->get($this->format, ['quality' => $this->quality]);
		return $blob;
	}
	
	private function pureFileNameWithFormat($fileName) {
		$name = basename($fileName);
		$name = FileHelper::fileRemoveExt($name);
		$name = $this->getBaseFileName($name);
		return $name;
	}
	
	private function getNameOfUploaded($userId, $fileName) {
		return $userId . BL . $this->getHashFromFileName($fileName);
	}
	
	private function getBaseFileName($fileName) {
		$fileBaseName = $fileName . DOT . $this->format;
		return $fileBaseName;
	}
	
	private function getHashFromFileName($fileName) {
		return hash_file('crc32b', $fileName);
	}
}