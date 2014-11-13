<?php

/**
 * Author: skuridin <skuridin-alex@ya.ru>
 * Date: Nov 11, 2014
 * Time: 13:59:16 PM
 * Format: http://book.cakephp.org/2.0/en/models.html
 */
App::uses('HttpSourceModel', 'HttpSource.Model');

/**
 * DiffbotModel Model
 * 
 * @package DiffbotSource
 */
class DiffbotModel extends HttpSourceModel {

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	public $name = 'DiffbotModel';

	/**
	 * {@inheritdoc}
	 *
	 * @var boll
	 */
	public $useTable = false;

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	public $useDbConfig = 'diffBot';


}
