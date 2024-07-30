<?php
class Meat247 extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
		$data['title'] = 'Meat247';
		$data['view_module'] = 'meat247'; // Indicates the module where the view file exists.
		$data['view_file'] = 'meat247'; // Specifies the base name of the target PHP view file.
		$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	}
}
