<?php

/**
 * Author: skuridin <skuridin-alex@ya.ru>
 * Date: Nov 12, 2014
 * Time: 5:42:11 PM
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */

/**
 * AllDiffbotSourceTest
 * 
 * @package DiffbotSourceTest
 * @subpackage Test
 */
class AllDiffbotSourceTest extends PHPUnit_Framework_TestSuite {

/**
 * 	All DiffbotSource tests suite
 *
 * @return PHPUnit_Framework_TestSuite the instance of PHPUnit_Framework_TestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All DiffbotSource Tests');
		$basePath = App::pluginPath('DiffbotSource') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($basePath);

		return $suite;
	}

}
