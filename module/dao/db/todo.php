<?php
/*
	David Bray
	BrayWorth Pty Ltd
	e. david@brayworth.com.au

	This work is licensed under a Creative Commons Attribution 4.0 International Public License.
		http://creativecommons.org/licenses/by/4.0/
	*/

namespace dvc\module\dao;
use dvc\module\config;

/* ========================================================================================= */
$dbc = 'sqlite' == config::$DB_TYPE ?
	new \dvc\sqlite\dbCheck( $this->db, 'todo' ) :
	new \dao\dbCheck( $this->db, 'todo' );

$dbc->defineField( 'description', 'varchar');
$dbc->check();

