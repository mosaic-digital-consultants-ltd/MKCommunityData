<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// MapsAPIkey = AIzaSyBuZG8QnItRMSpVlZkemQf7xtKqEC4_SWM  registered to mark@mosaicdigital.tech

		// Load the library
		$this->load->library('googlemaps');

		// Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
		$this->googlemaps->initialize();

		// Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be placed where we want the map to appear.
		$data['map'] = $this->googlemaps->create_map();

		// Load our view, passing the map data that has just been created
		$this->load->view('welcome_message', $data);

	}
}
