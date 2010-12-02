<?php
class GoogleWeather {
	private $zip_code;
	private $google_xml;
	private $location;
	private $current_temp;
	private $current_wind;
	
	function __construct($zip_code){
		$this->zip_code = $zip_code;
		$this->google_xml = simplexml_load_file( $this->create_query_url() );
		
		$this->location = (string)$this->google_xml->weather->forecast_information->city->attributes();
		$this->current_temp = (string)$this->google_xml->weather->current_conditions->temp_f->attributes();
		$this->current_wind = (string)$this->google_xml->weather->current_conditions->wind_condition->attributes();
	}
	
	private function create_query_url(){
		return 'http://www.google.com/ig/api?weather='.$this->zip_code;
	}
	
	# returns XML from Google Weather API
	function print_xml(){
		return $this->google_xml;	
	}
	
	# returns City, State
	function getlocation(){
		return $this->location;
	}
	
	# returns current temperature
	function getcurrenttemp(){
		return $this->current_temp;
	}
	
	# returns current wind conditions
	function getcurrentwind(){
		return $this->current_wind;
	}
}
?>
