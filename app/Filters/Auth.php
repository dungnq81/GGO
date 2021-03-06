<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface {

	/**
	 * @param RequestInterface $request
	 * @param null $arguments
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse|mixed|void
	 */
	public function before( RequestInterface $request, $arguments = null ) {

		//$auth = service('auth');

		// Do something here
		if ( ! session()->get( 'isLoggedIn' ) ) {
			return redirect()->to( '/users/login' );
		}
	}

	//--------------------------------------------------------------------

	public function after( RequestInterface $request, ResponseInterface $response, $arguments = null ) {

		// Do something here
	}
}