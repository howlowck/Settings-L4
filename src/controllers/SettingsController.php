<?php

class SettingsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Setting::all();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($name)
	{
		$name = snake_case($name);
		return View::make('settings-l4::settings')->with(compact('name'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($name)
	{
		Setting::save($name, Input::get($name));
		return Input::get($name);
	}

}
