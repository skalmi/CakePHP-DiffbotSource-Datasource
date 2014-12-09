<?php

/**
 * Author: skuridin <skuridin-alex@ya.ru>
 * Date: Nov 11, 2014
 * Time: 13:59:16 PM
 * Format: http://book.cakephp.org/2.0/en/models.html
 */
App::uses('DiffbotModel', 'DiffbotSource.Model');

/**
 * DiffbotArticle Model
 * 
 * @package DiffbotSource
 */
class DiffbotArticle extends DiffbotModel {

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	public $name = 'DiffbotArticle';

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	public $useTable = 'article';

	/**
	 * Get description and status by link
	 * 
	 * @param string $link
	 * @param string $status 1 = ok, 2 = fail
	 * @return string
	 * @throws Exception
	 */
	public function getDescriptionByLink($link, &$status) {
		$result = $this->find('first', array(
			'conditions' => array(
				'url' => $link,
				'fields' => 'text'
			)
				)
		);

		if (empty($result)) {
			throw new Exception(__('Diffbot could not download page %s', $link));
		}

		$description = Hash::get((array)$result, "{$this->alias}.text");
		$status = !empty($description) ? 1 : 2;

		return $description;
	}

}
