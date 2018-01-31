<?php
		  
namespace Kptec\KpBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Config;
use Ynfinite\ContaoComBundle\EventListener\YnfiniteCommunicationService;

class ExtYnfiniteCommunicationService extends YnfiniteCommunicationService {

	// Alterations to the caching methode for FlowFact images
	public function cacheData($url, $httpMethod, $data, $result){
		$result = json_decode($result);
		if($result) {
			if($result->hits) {
				if(count($result->hits->hits) > 0) {
					foreach($result->hits->hits as $key => $value) {
						$allImages = array();
						if($value->content->gallerie) {
							$allImages = array_merge($allImages, $value->content->gallerie);
						}

						if($value->content->grundriss) {
							$allImages = array_merge($allImages, $value->content->grundriss);
						}

						if($value->content->titelbild) {
							$allImages = array_merge($allImages, $value->content->titelbild);
						}

						$finalImages = $this->finalizeImages($allImages);

						$result->hits->hits[$key]->allImages = (object)$finalImages;
						
					}
				}
			}
			else {
				$allImages = array();
				
				if($result->content->gallerie) {
					$allImages = array_merge($allImages, $result->content->gallerie);
				}
				if($result->content->grundriss) {
					$allImages = array_merge($allImages, $result->content->grundriss);
				}
				if($result->content->titelbild) {
					$allImages = array_merge($allImages, $result->content->titelbild);
				}

				$finalImages = $this->finalizeImages($allImages);

				$result->allImages = $finalImages;
			}

			$cache = parent::cacheData($url, $httpMethod, $data, json_encode($result));
			return $cache;
		}
		return $result;
	}

	public function finalizeImages($allImages){
		$finalImages = array();

		foreach($allImages as $image) {
			$path = $image->path;

			// Search for the fieldName in the filename
			$splittedPath = explode("/", $path);
			$splittedFile = explode("-", $splittedPath[count($splittedPath)-1]);			
			$fieldName = explode("_", $splittedFile[1])[0];

			$finalImages[$fieldName] = $image;
		}

		return $finalImages;
	}

}