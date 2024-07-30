<?php
class Livestock247 extends Trongate {

	/**
	 * Renders the (default) 'livestock247' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
		$data['title'] = 'Home';
		$data['view_module'] = 'livestock247'; // Indicates the module where the view file exists.
		$data['view_file'] = 'index'; // Specifies the base name of the target PHP view file.
		$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	}
}
