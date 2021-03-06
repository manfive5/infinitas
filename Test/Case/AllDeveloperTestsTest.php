<?php
class AllDeveloperTestsTest extends PHPUnit_Framework_TestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Developer plugins test');
		$plugins = App::objects('plugin', APP . 'Developer', false);
		foreach ($plugins as $plugin) {
			if (CakePlugin::loaded($plugin)) {
				$file = CakePlugin::path($plugin) . 'Test' . DS . 'Case' . DS . 'All' . $plugin . 'TestsTest.php';
				if (file_exists($file)) {
					$suite->addTestFile($file);
				}
			}
		}
		return $suite;
	}
}
