<?php
	class CommentsEventsTest extends CakeTestCase {
		var $fixtures = array(
			'plugin.configs.config',
			'plugin.themes.theme',
			'plugin.routes.route',
			'plugin.view_counter.view_counter_view',

			'plugin.comments.infinitas_comment',
			'plugin.comments.infinitas_comment_attribute'
		);

		public function startTest() {
			$this->Event = EventCore::getInstance();
		}

		public function endTest() {
			unset($this->Event);
			ClassRegistry::flush();
		}

		public function testGenerateSiteMapData() {
			$this->assertInstanceOf('EventCore', $this->Event);
		}
	}