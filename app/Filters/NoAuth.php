<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAuth implements FilterInterface
{
	/**
	 * @param RequestInterface $request
	 * @param null $arguments
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse|mixed|void
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
		// Do something here
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}