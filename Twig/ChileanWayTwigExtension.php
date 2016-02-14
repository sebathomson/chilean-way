<?php

namespace SebaThomson\ChileanWay\Twig;

class ChileanWayTwigExtension extends \Twig_Extension
{
	private $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	public function getFunctions() {
		$cwUtilsService = $this->container->get('chilean_way_service.utils');

		$arrFunciones = array();

		$arrFunciones[ 'cw_getParameter' ]         = new \Twig_Function_Method($cwUtilsService, 'getParameter');
		$arrFunciones[ 'cw_getAge' ]               = new \Twig_Function_Method($cwUtilsService, 'getAge');
		$arrFunciones[ 'cw_getRutFormatted' ]      = new \Twig_Function_Method($cwUtilsService, 'getRutFormatted');
		$arrFunciones[ 'cw_getDateFormatted' ]     = new \Twig_Function_Method($cwUtilsService, 'getDateFormatted');
		$arrFunciones[ 'cw_getDateTimeFormatted' ] = new \Twig_Function_Method($cwUtilsService, 'getDateTimeFormatted');
		$arrFunciones[ 'cw_getTimeFormatted' ]     = new \Twig_Function_Method($cwUtilsService, 'getTimeFormatted');
		$arrFunciones[ 'cw_isObject' ]             = new \Twig_Function_Method($cwUtilsService, 'isObject');

		return $arrFunciones;
	}

	public function getName()
	{
		return 'chilean_way_base_extension';
	}
}
