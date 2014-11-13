<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 10.10.2013
 * Time: 18:00:00
 */

App::uses('HttpSourceConnection', 'HttpSource.Model/Datasource');

/**
 * Elasticsearch Connection
 *
 * @package ElasticsearchSource
 * @subpackage Model.Datasource
 */
class DiffbotConnection extends HttpSourceConnection {

/**
 * Issue the specified request and get error from response
 *
 * @param array $request request parameters
 * @return mixed false on error, decoded response array on success
 */
	public function request($request = array()) {
		$response = parent::request($request);
		$this->_error = Hash::get((array)$response, 'error');
		if ($this->_error) {
			$errorCode = Hash::get((array)$response, 'errorCode');
			$this->_error .= "\n<br/>errorCode:" . (empty($errorCode) ? 'unknown' : $errorCode);
		}
		return $response;
	}
}
