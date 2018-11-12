<?php
namespace Drupal\weather\Tests;

/**
 * Tests functions of weather.module.
 *
 * @group weather
 */
class WeatherFunctionsTestCase extends \Drupal\simpletest\WebTestBase {

  protected $profile = 'standard';

  /**
   * General information.
   */
  public static function getInfo() {
    return [
      'name' => 'Functions',
      'description' => 'Tests functions of weather.module.',
      'group' => 'Weather',
    ];
  }

  /**
   * Set up testing environment.
   */
  public function setUp() {
    parent::setUp('weather');
    module_load_include('inc', 'weather', 'weather.common');
  }

  /**
   * Test _weather_get_link_for_geoid().
   */
  public function testFunction_weather_get_link_for_geoid() {
    // Test different numbers for system-wide displays
    $link = _weather_get_link_for_geoid('geonames_2596934', 'system-wide');
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla/1');
    $link = _weather_get_link_for_geoid('geonames_2596934', 'system-wide', 1);
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla/1');
    $link = _weather_get_link_for_geoid('geonames_2596934', 'system-wide', 7);
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla/7');
    // Test different numbers for default displays
    $link = _weather_get_link_for_geoid('geonames_2596934', 'default');
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla');
    $link = _weather_get_link_for_geoid('geonames_2596934', 'default', 5);
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla');
    // Test different numbers for user displays
    $link = _weather_get_link_for_geoid('geonames_2596934', 'user');
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla/u');
    $link = _weather_get_link_for_geoid('geonames_2596934', 'user', 3);
    $this->assertEqual($link, 'weather/Côte_d’Ivoire/Worodougou/Séguéla/u');
    // Test different numbers for yr links
    $link = _weather_get_link_for_geoid('geonames_2596934', 'yr');
    $this->assertEqual($link, 'http://www.yr.no/place/C%C3%B4te_d%E2%80%99Ivoire/Worodougou/S%C3%A9gu%C3%A9la/forecast.xml');
    $link = _weather_get_link_for_geoid('geonames_2596934', 'yr', 8);
    $this->assertEqual($link, 'http://www.yr.no/place/C%C3%B4te_d%E2%80%99Ivoire/Worodougou/S%C3%A9gu%C3%A9la/forecast.xml');
    // Test different numbers for yr.no links
    $link = _weather_get_link_for_geoid('geonames_2596934', 'yr.no');
    $this->assertEqual($link, 'http://www.yr.no/place/Côte_d’Ivoire/Worodougou/Séguéla/');
    $link = _weather_get_link_for_geoid('geonames_2596934', 'yr.no', 8);
    $this->assertEqual($link, 'http://www.yr.no/place/Côte_d’Ivoire/Worodougou/Séguéla/');
    // Test autocomplete link
    $link = _weather_get_link_for_geoid('geonames_2596934', 'autocomplete');
    $this->assertEqual($link, 'Côte_d’Ivoire/Worodougou/Séguéla');
    // Test undefined link keyword, should return the bare link.
    $link = _weather_get_link_for_geoid('geonames_2596934', 'no known keyword');
    $this->assertEqual($link, 'Côte_d’Ivoire/Worodougou/Séguéla');
    // Test some special case geoids
    $link = _weather_get_link_for_geoid('geonames_2979036', 'system-wide');
    $this->assertEqual($link, 'weather/France/Limousin/Saint-Junien~2979036/1');
    $link = _weather_get_link_for_geoid('geonames_4795467', 'system-wide');
    $this->assertEqual($link, 'weather/Virgin_Islands,_U.S_/Saint_Thomas_Island/Charlotte_Amalie/1');
  }

}
