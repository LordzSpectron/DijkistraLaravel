<?php

namespace App\Http\Controllers;

use App\Models\arver;
use View;
use Request;
use Session;
use Redirect;

use Illuminate\Support\Facades\Validator;

class arverController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the arver
        $arvers = arver::all();

        // load the view and pass the sharks
        return View::make('arvers.index')
            ->with('arvers', $arvers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('arvers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
                // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'arestas'       => 'required',
            'vertices'      => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('arvers/create')
                ->withErrors($validator)
                ->withInput(Request::except('_token'));
        } else {
            // store
            $arver = new arver;
            $arver->arestas       = Request::get('arestas');
            $arver->vertices      = Request::get('vertices');
            $arver->save();

            // redirect
            Session::flash('message', 'Dados Adicionados com Sucesso');
            return Redirect::to('arvers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arvers = arver::find($id);

        // show the view and pass the shark to it
        return View::make('arvers.show')
            ->with('arvers', $arvers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $arvers = arver::find($id);
        $arvers->delete();

        // redirect
        Session::flash('message', 'Dado deletado com sucesso');
        return Redirect::to('arvers');
    }
}
