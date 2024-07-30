<?php
class About extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
		$data['title'] = 'About Us';
		$data['view_module'] = 'about'; // Indicates the module where the view file exists.
		$data['view_file'] = 'about'; // Specifies the base name of the target PHP view file.
		$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	}
}
