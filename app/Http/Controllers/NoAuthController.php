<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class NoAuthController extends Controller
{
	public function getInitialData(){
		$categories = Category::get();
		
		if($categories){
			$data['categories'] = $categories;
			return sendSuccess('success.', $data);
		}
		return sendError('No Record Found !', null);
	}

}