<?php
class Hoina extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
		$data['title'] = 'Hoina';
		$data['view_module'] = 'hoina'; // Indicates the module where the view file exists.
		$data['view_file'] = 'hoina'; // Specifies the base name of the target PHP view file.
		$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	}
}
