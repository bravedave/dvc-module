<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * This work is licensed under a Creative Commons Attribution 4.0 International Public License.
 * 		http://creativecommons.org/licenses/by/4.0/
 *
 * */

namespace dvc\module;

class controller extends \Controller {
	public $route = 'module';	// change this to the public controllers name

	protected function before() {
		if ( $app = \application::app()) {
            $app->addPath( __DIR__ );

        }

		config::module_checkdatabase();
		parent::before();

	}

	protected function _index() {
		$this->render([
			'title' => $this->title = $this->label,
			'primary' => 'readme',
			'secondary' => [ 'index', 'todo']

		]);

	}

	protected function getView( $viewName = 'index', $controller = null, $logMissingView = false ) {
		$ext = [
			'php',
			'md',
		];

		foreach ($ext as $x) {
			if ( file_exists( $view = sprintf( '%s/views/%s.%s', __DIR__, $viewName, $x )))
				return ( $view);

		}

		return parent::getView( $viewName, $controller, $logMissingView = false);

	}

	protected function posthandler() {
		$action = $this->getPost('action');

		if ( 'todo-add-item' == $action) {
			$a = [
				'description' => (string)$this->getPost('description')

			];

			if ( $a['description']) {
				$dao = new dao\todo;
				$dao->Insert( $a);

				\Json::ack( $action);

			}
			else {
				\Json::nak( $action);

			}

		}
		elseif ( 'todo-delete-item' == $action) {
			if ( $id = (int)$this->getPost( 'id')) {
				$dao = new dao\todo;
				$dao->delete( $id);
				\Json::ack( $action);

			}
			else {
				\Json::nak( $action);

			}

		}
		elseif ( 'todo-get-items' == $action) {
			/*
			_brayworth_.post({
				url : _brayworth_.url('<?= $this->route ?>'),
				data : { action : 'todo-get-items' },

			}).then( function( d) { console.log( d.data) });

			 */
			$dao = new dao\todo;
			if ( $res = $dao->getAll()) {
				\Json::ack( $action)
					->add( 'data', $res->dtoSet());

			}
			else {
				\Json::nak( $action);

			}

		}
		else {
			parent::postHandler();

		}

	}

	function __construct( $rootPath ) {
		$this->label = config::$WEBNAME;
		parent::__construct( $rootPath);

	}

	function changes() {
		$this->render([
			'title' => $this->title = $this->label,
			'primary' => 'changes',
			'secondary' => [ 'index', 'todo']

		]);

	}

	function images( $file) {
		if ( $file = trim( $file, '/ .')) {
			$_f = implode( DIRECTORY_SEPARATOR, [
				__DIR__,
				'images',
				$file

			]);

			if ( \file_exists( $_f)) {
				// \sys::logger( sprintf('<%s> %s', $_f, __METHOD__));
				\sys::serve( $_f);

			}
			else {
				\sys::logger( sprintf('missing <%s> %s', $_f, __METHOD__));

			}

		}

	}

}