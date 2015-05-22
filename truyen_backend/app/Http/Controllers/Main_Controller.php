<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;

class Main_Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title_top = 'Administrator Control Panel';
		$title_name = 'Main Panel';
	//	$data['title_top'] = $title_top;
		//$data['title_name'] = $title_name;
 		//$time_now_vietnam = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
 		//format('D, M j, Y);
 		$time_now_vietnam = Carbon::now('Asia/Ho_Chi_Minh')->format('D, M j, Y');
		return view("pages/admin_main")->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'time_now_vietnam' => $time_now_vietnam
			]);
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
