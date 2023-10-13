<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	// Format json ajax response
	public function response($data = null, $status = 200, $message = '')
	{
		return response()->json([
			'data' => $data,
			'status' => $status,
			'message' => $message
		]);
	}
}
