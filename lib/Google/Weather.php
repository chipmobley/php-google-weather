<?php
/**
 * Google Weather API Class
 * 
 * @since 1.1
 * @author Rodrigo da Rosa Elesbão <slipknabos@gmail.com>
 * @todo Put your author here
 * @license //put your license here
 */
class Google_Weather
{
	/**
	 * @access private
	 * @var string google weather api url
	 */
	private $_apiUrl = 'http://www.google.com/ig/api?weather=';
	
	/**
	 * @access private
	 * @var string location, use setLocation;
	 */
	private $_location;
	
	/**
	 * @access private
	 * @var object $weather
	 */
	private $_weather;
	
	/**
	 * Magic method to get xml properties
	 *
	 * @param string $property
	 * @return boolean | string
	 */
	public function __get( $property )
	{
		if( $this->_weather->{$property} == NULL ){
			return false;
		}
		return $this->_weather->{$property};
	}
	
	/**
	 * Set the location, actually it can be a city, state, zip code, etc..
	 *
	 * @param string $city
	 * @return Google_Weather
	 */
	public function setLocation( $location )
	{
		$this->_location = preg_replace( '/\s+/', '+', $location );
		return $this;
	}	
	
	/**
	 * Call Google Weather API
	 * 
	 * @return Google_Weather | boolean
	 */
	public function call()
	{
		if( $this->_location == '' )
		{
			//TODO: Manage exceptions
			return false;
		}
		$apiUrl = $this->_apiUrl . $this->_location;
		$result = simplexml_load_file( $apiUrl );
		if( !$result instanceof SimpleXMLElement ){
			return false;
		}
		$this->_weather = $result->weather;
		return $this;
	}
}