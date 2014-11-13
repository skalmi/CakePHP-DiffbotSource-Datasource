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

	/**
	 * Diffbot API Datasource
	 *
	 * @var string
	 */
	public $description = 'DiffbotSource DataSource';

	/**
	 * Constructor
	 * 
	 * @param array $config configuration parameters
	 * @param HttpSourceConnection $Connection connection resource
	 * @throws RuntimeException
	 */
	public function __construct($config = array(), HttpSourceConnection $Connection = null) {
		$Connection = $Connection ? $Connection : new DiffbotConnection($config);
		parent::__construct($config, $Connection);
	}
}
