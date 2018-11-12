<?php
namespace Drupal\weather\Tests;

/**
 * Tests configuration of weather displays.
 *
 * @group weather
 */
class WeatherConfigurationTestCase extends \Drupal\simpletest\WebTestBase {

  protected $profile = 'standard';

  /**
   * General information.
   */
  public static function getInfo() {
    return [
      'name' => 'Configuration',
      'description' => 'Tests configuration of weather displays.',
      'group' => 'Weather',
    ];
  }

  /**
   * Set up testing environment
   */
  public function setUp() {
    parent::setUp('weather', 'block');
  }

  /**
   * Tests configuration of weather block.
   */
  public function testConfiguration() {
    // Set a fixed time for testing to 2013-10-07 20:00:00 UTC
    \Drupal::configFactory()->getEditable('weather.settings')->set('weather_time_for_testing', 1381176000)->save();
    // This user may setup a system-wide weather block.
    $admin_user = $this->drupalCreateUser([
      'access content',
      'administer custom weather block',
      'administer site configuration',
      'administer blocks',
    ]);
    // Test with admin user
    $this->drupalLogin($admin_user);
    // Enable a system-wide weather block
    $this->drupalPost('admin/config/user-interface/weather/system-wide/add', [], t('Save'));
    // Configure the default place
    $this->drupalPost('admin/config/user-interface/weather/system-wide/1/add', [], t('Save'));
    // Enable block
    $edit = [
      'blocks[weather_system_1][region]' => 'sidebar_second'
      ];
    $this->drupalPost('admin/structure/block', $edit, t('Save blocks'));
    // Make sure that the weather block is displayed with correct test forecast data
    $this->drupalGet('node');
    $this->assertRaw('<div class="weather">');
    $this->assertLink('Hamburg');
    $this->assertLinkByHref('weather/Germany/Hamburg/Hamburg/1');
    $this->assertText('23:00-00:00');
    $this->assertText(t('Clear sky'));
    $this->assertRaw('9&thinsp;°C');
    $this->assertText('12:00-18:00');
    $this->assertText(t('Fair'));
    $this->assertRaw('13&thinsp;°C');
    // Change temperature units to Fahrenheit.
    $edit = [
      'config[temperature]' => 'fahrenheit'
      ];
    $this->drupalPost('admin/config/user-interface/weather/system-wide/1', $edit, t('Save'));
    // Make sure that the weather block now shows different temperatures.
    $this->drupalGet('node');
    $this->assertRaw('48&thinsp;°F');
    $this->assertRaw('55&thinsp;°F');
    // Logout current user
    $this->drupalLogout();
  }

}
