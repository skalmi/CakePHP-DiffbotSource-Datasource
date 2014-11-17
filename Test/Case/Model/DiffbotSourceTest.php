<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 18.11.2012
 * Time: 22:03:38
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */
App::uses('DiffbotModel', 'DiffbotSource.Model');
App::uses('DiffbotSource', 'DiffbotSource.Model/Datasource/Http');
App::uses('DiffbotTestSource', 'DiffbotSource.Model/Datasource/Http');
App::uses('HttpSourceConnection', 'HttpSource.Model/Datasource');
App::uses('DiffbotConnection', 'DiffbotSource.Model/Datasource');
App::uses('HttpSocketResponse', 'Network/Http');

/**
 * DiffbotSourceTest
 * 
 * @package DiffbotSourceTest
 * @subpackage Model
 */
class DiffbotSourceTest extends CakeTestCase {

	/**
	 * DiffbotSource Model
	 *
	 * @var AppModel
	 */
	public $Model = null;

	/**
	 * {@inheritdoc}
	 */
	public function setUp() {
		parent::setUp();
		$this->Model = new DiffbotModel(false, false, 'diffbotTest');
	}

	/**
	 * Test article
	 * 
	 * @param array $request
	 * @param string $response
	 * @param float $result
	 * 
	 * @dataProvider getArticleProvider
	 */
	public function testArticle(array $request, $response, $result) {
		$this->_mockConnection($request, $response);

		$this->Model->setSource('article');

		$res = $this->Model->find('first',
			array(
				'conditions' =>
				array(
					'token' => 'token',
					'url' => 'http://headlines.example.com/hl?a=20141106-00000032-rcdc-cn',
					'fields' => 'text'
					)
				)
			);
		$this->assertSame($result, $res[$this->Model->alias]['title']);
	}

	/**
	 * Test article2
	 * 
	 * @param array $request
	 * @param string $response
	 * @param float $result
	 * 
	 * @dataProvider getArticleErrorProvider
	 */
	public function testArticleError(array $request, $response, $result) {
		$this->_mockConnection($request, $response);

		$this->Model->setSource('article');

		$res = $this->Model->find('first',
			array('conditions' =>
				array('token' => 'token',
					'url' => 'http://headlines.example.com/hl?a=20141106-00000032-rcdc-cn',
					'fields' => 'text'
					)
				)
			);
		$this->assertSame($result, $res);
	}

	/**
	 * Data provider for testArticleError
	 * 
	 * @return array
	 */
	public function getArticleProvider() {
		return array(
			//set #0
			array(
				//request
				array(
					'method' => 'GET',
					'body' => array(),
					'uri' => array(
						'host' => 'api.diffbot.com',
						'port' => 80,
						'path' => '/v3/article',
						'query' => array('token' => 'token',
									'url' => 'http://headlines.example.com/hl?a=20141106-00000032-rcdc-cn',
									'fields' => 'text'
									)
					)
				),
				//response
				'HTTP/1.1 200 OK' .
				"\r\n" .
				'Server: nginx/1.6.0' .
				"\r\n" .
				'Date: Wed, 12 Nov 2014 16:07:53 GMT' .
				"\r\n" .
				'Content-Type: application/json;charset=utf-8' .
				"\r\n" .
				'Content-Length: 4695' .
				"\r\n" .
				'Connection: keep-alive' .
				"\r\n" .
				'Vary: Accept-Encoding' .
				"\r\n" .
				'Access-Control-Allow-Origin: *' .
				"\r\n" . "\r\n" .
				'{"objects": [{"date": "Thu, 06 Nov 2014 00:00:00 GMT", "title": "Title for the example", "text": "Example description", "pageUrl": "http://headlines.example.com/hl?a=20141106-00000032-rcdc-cn", "diffbotUri": "article|3|-1912116724", "images": [{"url": "http://amd.c.example.com/amd/20141106-00000032-rcdc-000-0-thumb.jpg", "naturalWidth": 200, "primary": true, "naturalHeight": 148, "diffbotUri": "image|3|1169107753"} ], "html": "<p><br>\n Example description</p>", "humanLanguage": "ja", "type": "article"} ], "request": {"fields": "title", "version": 3, "api": "article", "pageUrl": "http://headlines.example.com/hl?a=20141106-00000032-rcdc-cn"} }',
				//result
				'Title for the example'
			)
		);
	}

	/**
	 * Data provider for testArticleError
	 * 
	 * @return array
	 */
	public function getArticleErrorProvider() {
		return array(
			//set #0
			array(
				//request
				array(
					'method' => 'GET',
					'body' => array(),
					'uri' => array(
						'host' => 'api.diffbot.com',
						'port' => 80,
						'path' => '/v3/article',
						'query' => array('token' => 'token',
									'url' => 'http://headlines.example.com/hl?a=20141106-00000032-rcdc-cn',
									'fields' => 'text'
									)
					)
				),
				//response
				'HTTP/1.1 200 OK' .
				"\r\n" .
				'Server: nginx/1.6.0' .
				"\r\n" .
				'Date: Wed, 12 Nov 2014 16:07:53 GMT' .
				"\r\n" .
				'Content-Type: application/json;charset=utf-8' .
				"\r\n" .
				'Content-Length: 4695' .
				"\r\n" .
				'Connection: keep-alive' .
				"\r\n" .
				'Vary: Accept-Encoding' .
				"\r\n" .
				'Access-Control-Allow-Origin: *' .
				"\r\n" . "\r\n" .
				'{"errorCode": 401,"error": "Not authorized API token."}',
				//result
				array()
			)
		);
	}

	/**
	 * Mock connection for test purposes
	 * 
	 * @param array $request
	 * @param string $response
	 */
	protected function _mockConnection($request, $response) {
		ConnectionManager::create('diffbotTest', array(
			'datasource' => 'DiffbotSource.DiffbotTestSource',
			'host' => 'api.diffbot.com',
			'path' => '/v3/article',
			'prefix' => '',
			'port' => 80,
			'timeout' => 5
		));
		$this->Model = new DiffbotModel(false, false, 'diffbotTest');

		$DS = $this->Model->getDataSource();
		$Connection = $this->getMock('DiffbotTestConnection', array(
			'_request'
				), array($DS->config));
		$Connection->expects($this->once())->method('_request')->with($request)->will($this->returnValue(new HttpSocketResponse($response)));
		$DS->setConnection($Connection);
	}

}

/**
 * Source class for tests
 */
class DiffbotTestSource extends DiffbotSource {

	/**
	 * {@inheritdoc}
	 * 
	 * @param array $config
	 * @param HttpSourceConnection $Connection
	 */
	public function __construct($config = array(), HttpSourceConnection $Connection = null) {
		parent::__construct($config, $Connection);
	}

	/**
	 * Method for inject mocked connection
	 * 
	 * @param HttpSourceConnection $Connection
	 */
	public function setConnection(HttpSourceConnection $Connection) {
		parent::__construct($this->config, $Connection);
	}

}

/**
 * Connection class for tests
 */
class DiffbotTestConnection extends DiffbotConnection {

}