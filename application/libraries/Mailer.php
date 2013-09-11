<?php if (! defined ('BASEPATH')) exit ('No direct script access allowed');

class Mailer {
	public function __construct()
	{
		require_once ('class.phpmailer.php');
	}
}