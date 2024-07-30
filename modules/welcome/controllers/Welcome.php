<?php
class Welcome extends Trongate {

	/**
	 * Renders the (default) homepage for public access.
	 *
	 * @return void
	 */
	function index(): void {
		$data['view_module'] = 'welcome';
		$data['view_file'] = 'welcome';
		$this->template('livestock247', $data);
	}

}