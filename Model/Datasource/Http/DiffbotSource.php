<?php
/**
 * Author: skuridin <skuridin-alex@ya.ru>
 * Date: 11.11.2014
 * Time: 15:33:48
 * Format: https://github.com/imsamurai/cakephp-httpsource-datasource
 */
App::uses('HttpSource', 'HttpSource.Model/Datasource');
App::uses('DiffbotConnection', 'DiffbotSource.Model/Datasource');

/**
 * Diffbot DataSource
 *
 * @package DiffbotSource
 * @subpackage Model.Datasource.Http
 */
class DiffbotSource extends HttpSource {
	const HTTP_METHOD_READ = 'GET';

	/**
	 * Diffbot API Datasource
	 *
	 * @var string
	 */
	public $description = 'DiffbotSource DataSource';
	/**
	 * Constructor
	 * 
	 * @param array $config
	 * @param HttpSourceConnection $Connection
	 * @throws RuntimeException
	 */
	public function __construct($config = array(), HttpSourceConnection $Connection = null) {
		$Connection = $Connection ? $Connection : new DiffbotConnection($config);
		//var_dump($Connection); exit;
		parent::__construct($config,  $Connection);

	}

}