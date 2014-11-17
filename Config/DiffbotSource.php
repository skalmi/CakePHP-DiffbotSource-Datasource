<?php

/**
 * Author: skuridin <skuridin-alex@ya.ru>
 * Date: 11.11.2014
 * Time: 13:45:00
 * Format: https://github.com/imsamurai/cakephp-httpsource-datasource
 */
$config['DiffbotSource']['config_version'] = 2;

$CF = HttpSourceConfigFactory::instance();
$Config = $CF->config();

/*
$TimeIdField = $CF->field()
		->name('id')
		->map(function() {
			return microtime(true) . '.' . mt_srand();
		});
*/
$Config
		/*
		 * Article api
		 *
		 * @link https://www.diffbot.com/dev/docs/article/
		 */
		->add(
				$CF->endpoint()
				->id(1)
				->methodRead()
				->table('article')
				->path('')
				->addCondition($CF->condition()->name('token')->sendInQuery()->required())
				->addCondition($CF->condition()->name('url')->sendInQuery()->required())
				->addCondition($CF->condition()->name('fields')->sendInQuery())
				->addCondition($CF->condition()->name('timeout')->sendInQuery())
				->addCondition($CF->condition()->name('callback')->sendInQuery())
				->result($CF->result()
						->map(function ($data) {
							return isset($data['objects']) ? $data['objects'] : null;
						})
				)
		);

$config['DiffbotSource']['config'] = $Config;
