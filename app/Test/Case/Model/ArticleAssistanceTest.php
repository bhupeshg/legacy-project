<?php
App::uses('ArticleAssistance', 'Model');

/**
 * ArticleAssistance Test Case
 *
 */
class ArticleAssistanceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.article_assistance',
		'app.article',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArticleAssistance = ClassRegistry::init('ArticleAssistance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArticleAssistance);

		parent::tearDown();
	}

}
