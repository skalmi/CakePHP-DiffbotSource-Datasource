<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 09.12.2014
 * Time: 13:52:32
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */

/**
 * DiffbotArticleTest
 * 
 * @package DiffbotSourceTest
 * @subpackage Model
 */
class DiffbotArticleTest extends CakeTestCase {

	/**
	 * Test get description by link
	 * 
	 * @param string $link
	 * @param int $status
	 * @param string $result
	 * @param string $exception
	 * 
	 * @dataProvider getDescriptionByLinkProvider
	 */
	public function testGetDescriptionByLink($link, $status, $result, $exception) {
		if ($exception) {
			$this->expectException($exception);
		}

		$Model = $this->getMockForModel('DiffbotSource.DiffbotArticle', array('find'));
		$findParam = array(
			'conditions' => array(
				'url' => $link,
				'fields' => 'text'
			)
		);

		$Model->expects($this->once())
				->method('find')
				->with('first', $findParam)
				->willReturn($result !== false ? array(
							$Model->alias => array(
								'text' => $result
							)
								) : false);

		$this->assertSame($result, $Model->getDescriptionByLink($link, $resultStatus));
		$this->assertSame($status, $resultStatus);
	}

	/**
	 * Data provider for testGetDescriptionByLink
	 * 
	 * @return array
	 */
	public function getDescriptionByLinkProvider() {
		return array(
			//set #0
			array(
				//link
				'http://google.com',
				//status
				1,
				//$result
				'some text',
				//exception
				null
			),
			//set #1
			array(
				//link
				'http://google.com',
				//status
				2,
				//$result
				'',
				//exception
				null
			),
			//set #2
			array(
				//link
				'http://google.com',
				//status
				null,
				//$result
				false,
				//exception
				'Exception'
			),
		);
	}

}
