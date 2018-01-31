<?php

namespace Kptec\KpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DebugController extends Controller {

	public function indexAction(Request $request){
		
		$loadDataService = $this->get("ynfinite.contao-com.listener.communication");

		return new JsonResponse($returnData);
	}
}