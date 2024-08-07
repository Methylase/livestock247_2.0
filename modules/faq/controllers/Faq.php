<?php
class Faq extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
		$data['title'] = 'Faq';
		$data['view_module'] = 'faq'; // Indicates the module where the view file exists.
		$data['view_file'] = 'faq'; // Specifies the base name of the target PHP view file.
		$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	}
}
