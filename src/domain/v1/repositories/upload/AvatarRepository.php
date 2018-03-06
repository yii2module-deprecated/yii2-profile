<?php

namespace yii2module\profile\domain\v1\repositories\upload;

use yii2lab\domain\helpers\ErrorCollection;
use yii2lab\domain\repositories\FileRepository;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

class AvatarRepository extends FileRepository {
	
	public $quality = 90;
	public $defaultName = 'default';
	public $size = 256;
	public $format = 'png';
	public $pathName = 'avatar';
	
	public function save($avatar, $userId) {
		$originalFileName = $this->saveOriginal($avatar, $userId);
		if(filesize($originalFileName) < 1024) {
			$error = new ErrorCollection;
			$error->add('imageFile', 'profile/avatar', 'file_size_small');
			throw new UnprocessableEntityHttpException($error);
		}
		$this->deleteThumbList($userId);
		$this->saveThumbList($originalFileName, $userId);
		$pureName = $this->getThumbFileName($originalFileName, $userId);
		$this->deleteOriginal($avatar, $userId);
		return $pureName;
	}
	
	public function delete($userId) {
		$this->deleteThumbList($userId);
	}
	
	private function deleteThumbList($userId) {
		$files = $this->findByUserId($userId);
		foreach($files as $file) {
			unlink($file);
		}
	}
	
	private function findByUserId($userId) {
		$directory = $this->getDirectory();
		$options['only'][] = '/' . $userId. '_*';
		$files = FileHelper::findFiles($directory, $options);
		return $files;
	}
	
	private function saveOriginal(UploadedFile $avatar, $userId) {
		$path = $this->getPath('original');
		$this->createDirectory('original');
		$originalFileName = $path . $userId . '.' . $avatar->extension;
		$avatar->saveAs($originalFileName);
		return $originalFileName;
	}
	
	private function getThumbFileName($fileName, $userId) {
		$hash = $this->getHash($fileName);
		$fileName = $userId . BL . $hash;
		return $fileName;
	}
	
	private function deleteOriginal(UploadedFile $avatar, $userId) {
		$path = $this->getPath('original');
		$originalFileName = $path . $userId . '.' . $avatar->extension;
		unlink($originalFileName);
	}
	
	private function saveThumbList($fileName, $userId) {
		$size = $this->size;
		$thumbFileName = $this->getThumbFileName($fileName, $userId);
		$fullThumbFileName = $this->getFilePath($thumbFileName);
		Image::thumbnail($fileName, $size, $size)
			->save($fullThumbFileName, ['quality' => $this->quality]);
	}
	
	private function getHash($fileName) {
		return hash_file('crc32b', $fileName);
	}
	
}