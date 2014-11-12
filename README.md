DiffbotSource Plugin
==========================
[![Build Status](https://travis-ci.org/skalmi/CakePHP-DiffbotSource-Datasource.png)](https://travis-ci.org/skalmi/CakePHP-DiffbotSource-Datasource) [![Coverage Status](https://travis-ci.org/skalmi/CakePHP-DiffbotSource-Datasource/badge.png?branch=master)](https://travis-ci.org/skalmi/CakePHP-DiffbotSource-Datasource?branch=master)[![Latest Stable Version](https://poser.pugx.org/skalmi/cakephp-diffbot-datasource/v/stable.png)](https://packagist.org/packages/skalmi/cakephp-diffbot-datasource) [![Total Downloads](https://poser.pugx.org/skalmi/cakephp-diffbot-datasource/downloads.png)](https://packagist.org/packages/imsamurai/elasticsearch-source) [![Latest Unstable Version](https://poser.pugx.org/skalmi/cakephp-diffbot-datasource/v/unstable.png)](https://packagist.org/packages/skalmi/cakephp-diffbot-datasource) [![License](https://poser.pugx.org/skalmi/cakephp-diffbot-datasource/license.png)](https://packagist.org/packages/skalmi/cakephp-diffbot-datasource)


CakePHP DiffbotSource is DataSource Plugin  for [Diffbot](http://www.diffbot.com/)

## Installation

### Step 1: Clone or download [HttpSource](https://github.com/imsamurai/cakephp-httpsource-datasource)

### Step 2: Clone or download to `Plugin/DiffbotSource`

  cd my_cake_app/app git://github.com/skalmi/CakePHP-DiffbotSource-Datasource.git Plugin/DiffbotSource

or if you use git add as submodule:

	cd my_cake_app
	git submodule add "git://github.com/skalmi/CakePHP-DiffbotSource-Datasource.git" "app/Plugin/DiffbotSource"

then update submodules:

	git submodule init
	git submodule update

### Step 3: Add your configuration to `database.php` and set it to the model

```
:: database.php ::
```
```php
public $diffbot = array(
  'datasource' => 'DiffbotSource.Http/DiffbotSource',
  'host' => 'example.com',
  'port' => 'some port'
);
public $diffbotTest = array(
  'datasource' => 'ElasticsearchSource.Http/ElasticsearchSource',
  'host' => 'www.diffbot.com',
  'prefix' => '',
  'port' => 80,
  'timeout' => 5
);
```
Then make model

```
:: Diffbot.php ::
```
```php
public $useDbConfig = 'diffbot';
public $useTable = '<desired endpoint, for ex: "article">';
```

### Step 4: Load plugin

```
:: bootstrap.php ::
```
```php
CakePlugin::load('HttpSource', array('bootstrap' => true, 'routes' => true));
CakePlugin::load('DiffbotSource', array('bootstrap' => false, 'routes' => false));
```
#Tests

To run tests add and fill $diffbotTest in `database.php`

#Usage

You can use elasticsearch almost as db tables:
```php
$this->Diffbot->setSource('article');
	$params = array(
		'conditions' => array(
			'query' => array(
				"term" => array("title" => "apple")
			)
		),
		'fields' => array('title', 'rank'),
		'order' => array('rank' => 'desc'),
		'offset' => 2
	);

$result = $this->Diffbot->find('first', $params);
```

#Documentation

Please read [HttpSource Plugin README](https://github.com/imsamurai/cakephp-httpsource-datasource/blob/master/README.md)
