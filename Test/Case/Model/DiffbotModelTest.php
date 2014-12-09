<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 09.12.2014
 * Time: 13:52:32
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */

/**
 * DiffbotModelTest
 */
class DiffbotModelTest extends CakeTestCase {

	/**
	 * {@inheritdoc}
	 */
	public function setUp() {
		parent::setUp();
		Configure::write('DiffBot.token', '123');
	}

	/**
	 * Test beforeFind callback
	 * 
	 * @param array $query
	 * @param array $result
	 * @dataProvider beforeFindProvider
	 */
	public function testBeforeFind(array $query, array $result) {
		$Model = ClassRegistry::init('DiffbotSource.DiffbotModel');
		$this->assertSame($result, $Model->beforeFind($query));
	}

	/**
	 * Data provider for testBeforeFind
	 * 
	 * @return array
	 */
	public function beforeFindProvider() {
		return array(
			//set #0
			array(
				//query
				array(),
				//result
				array(
					'conditions' => array(
						'token' => '123'
					)
				)
			),
			//set #1
			array(
				//query
				array(
					'conditions' => array(
						'token' => '456'
					)
				),
				//result
				array(
					'conditions' => array(
						'token' => '456'
					)
				)
			),
			//set #2
			array(
				//query
				array(
					'limit' => 10,
					'conditions' => array(
						'a' => '1'
					)
				),
				//result
				array(
					'limit' => 10,
					'conditions' => array(
						'a' => '1',
						'token' => '123'
					)
				)
			),
			//set #3
			array(
				//query
				array(
					'limit' => 10,
					'conditions' => array(
						'token' => '456',
						'a' => '1',
					)
				),
				//result
				array(
					'limit' => 10,
					'conditions' => array(
						'token' => '456',
						'a' => '1',
					)
				)
			),
		);
	}

}
