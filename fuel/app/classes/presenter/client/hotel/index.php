<?php

class Presenter_Client_Hotel extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        Debug::dump($this->request()->param('id'));
        exit();
		// $this->name = $this->request()->param('name', 'World');
	}
}
