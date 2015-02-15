<?php
App::uses('AnnouncementComment', 'Model');

/**
 * AnnouncementComment Test Case
 *
 */
class AnnouncementCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.announcement_comment',
		'app.announcement',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AnnouncementComment = ClassRegistry::init('AnnouncementComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AnnouncementComment);

		parent::tearDown();
	}

}
