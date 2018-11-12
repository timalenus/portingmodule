<?php
namespace Drupal\weather\Tests;

/**
 * Tests parsing of XML weather forecasts.
 *
 * @group weather
 */
class WeatherParserTestCase extends \Drupal\simpletest\WebTestBase {

  protected $profile = 'standard';

  /**
   * General information.
   */
  public static function getInfo() {
    return [
      'name' => 'Parser',
      'description' => 'Tests parsing of XML weather forecasts.',
      'group' => 'Weather',
    ];
  }

  /**
   * Set up testing environment.
   */
  public function setUp() {
    parent::setUp('weather');
    module_load_include('inc', 'weather', 'weather_parser');
  }

  /**
   * Internal helper function for getting information about a forecast.
   */
  private function _getInfoAboutForecast($time) {
    // Set the testing time.
    \Drupal::configFactory()->getEditable('weather.settings')->set('weather_time_for_testing', $time)->save();
    // Fetch weather forecasts for Hamburg.
    $weather = weather_get_weather('geonames_2911298', 1, FALSE);
    // Return the parsed information.
    return db_query('SELECT * FROM {weather_forecast_information} WHERE geoid=:geoid', [
      ':geoid' => 'geonames_2911298'
      ])->fetchObject();
  }

  /**
   * Test parsing of information about a forecast.
   */
  public function testParsingOfInformation() {
    // 2013-10-07 20:00:00 UTC
    $info = $this->_getInfoAboutForecast(1381176000);
    // Check that the information has been parsed correctly.
    $this->assertEqual($info->geoid, 'geonames_2911298');
    $this->assertEqual($info->last_update, '2013-10-07 15:30:00');
    $this->assertEqual($info->next_update, '2013-10-08 04:00:00');
    $this->assertEqual($info->next_download_attempt, '2013-10-08 04:00:00');
    $this->assertEqual($info->utc_offset, 120);
    // Set later times and check next download attempt.
    $info = $this->_getInfoAboutForecast(1381204800);
    $this->assertEqual($info->next_download_attempt, '2013-10-08 04:11:15');
    $info = $this->_getInfoAboutForecast(1381205500);
    $this->assertEqual($info->next_download_attempt, '2013-10-08 04:22:30');
    $info = $this->_getInfoAboutForecast(1381215500);
    $this->assertEqual($info->next_download_attempt, '2013-10-08 07:00:00');
    $info = $this->_getInfoAboutForecast(1381247999);
    $this->assertEqual($info->next_download_attempt, '2013-10-08 16:00:00');
    $info = $this->_getInfoAboutForecast(1381248000);
    $this->assertEqual($info->next_download_attempt, '2013-10-09 04:00:00');
    $info = $this->_getInfoAboutForecast(1381248001);
    $this->assertEqual($info->next_download_attempt, '2013-10-09 04:00:00');
    $info = $this->_getInfoAboutForecast(1381291199);
    $this->assertEqual($info->next_download_attempt, '2013-10-09 04:00:00');
    $info = $this->_getInfoAboutForecast(1381291200);
    $this->assertEqual($info->next_download_attempt, '2013-10-10 04:00:00');
    $info = $this->_getInfoAboutForecast(1381291201);
    $this->assertEqual($info->next_download_attempt, '2013-10-10 04:00:00');
    $info = $this->_getInfoAboutForecast(1381294500);
    $this->assertEqual($info->next_download_attempt, '2013-10-10 04:00:00');
    $info = $this->_getInfoAboutForecast(1381380000);
    $this->assertEqual($info->next_download_attempt, '2013-10-11 04:00:00');
  }

  /**
   * Test the parser with different days of forecast data.
   */
  public function testDifferentDaysOfForecasts() {
    // These are all days from the forecast.
    $days = [
      '2013-10-07',
      '2013-10-08',
      '2013-10-09',
      '2013-10-10',
      '2013-10-11',
      '2013-10-12',
      '2013-10-13',
      '2013-10-14',
      '2013-10-15',
      '2013-10-16',
      '2013-10-17',
    ];
    // Set a fixed time for testing to 2013-10-07 20:00:00 UTC
    \Drupal::configFactory()->getEditable('weather.settings')->set('weather_time_for_testing', 1381176000)->save();
    // Fetch all weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 0, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), $days);
    // Fetch all (= 11) weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 11, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), $days);
    // Fetch more than available weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 12, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), $days);
    // Fetch 6 weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 6, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), array_slice($days, 0, 6));
    // Fetch 2 weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 2, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), array_slice($days, 0, 2));
    // Fetch 1 weather forecast for Hamburg
    // and check the correct day of forecasts.
    $weather = weather_get_weather('geonames_2911298', 1, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), array_slice($days, 0, 1));
    // Go a few days forward ...
    // Set a fixed time for testing to 2013-10-12 10:00:00 UTC
    \Drupal::configFactory()->getEditable('weather.settings')->set('weather_time_for_testing', 1381572000)->save();
    // Fetch all weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 0, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), array_slice($days, 5));
    // Fetch all weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 12, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), array_slice($days, 5));
    // Fetch 2 weather forecasts for Hamburg
    // and check the correct days of forecasts.
    $weather = weather_get_weather('geonames_2911298', 2, TRUE);
    $this->assertIdentical(array_keys($weather['forecasts']), array_slice($days, 5, 2));
  }

}
