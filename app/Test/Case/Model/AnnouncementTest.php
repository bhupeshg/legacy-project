<?php
App::uses('Announcement', 'Model');

/**
 * Announcement Test Case
 *
 */
class AnnouncementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.announcement',
		'app.user',
		'app.announcement_comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Announcement = ClassRegistry::init('Announcement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Announcement);

		parent::tearDown();
	}

}
