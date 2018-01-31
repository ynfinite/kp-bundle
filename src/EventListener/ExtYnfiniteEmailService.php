<?php

namespace KpTec\KpBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Config;
use Ynfinite\ContaoComBundle\EventListener\YnfiniteEmailService;

use Ynfinite\YnfiniteCacheModel;

use \DateTime;

class ExtYnfiniteEmailService extends YnfiniteEmailService{

	public function pre_send_change_data($emailData) {
		$emailData = parent::pre_send_change_data($emailData);
		var_dump($emailData);
		return $emailData;
	}
}