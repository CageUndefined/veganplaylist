<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Make the changes to the user for the given fields, validating piece-meal

        if (!empty($request->input('name'))) {
            Validator::make($request->all(), [
                'name' => ['string', 'max:255']
            ])->validate();

            $user->name = $request->input('name');
        }

        if (!empty($request->input('email'))) {
            // If the user attempts to change their email address, make sure that the target email is not already taken.

            if ($user->email != $request->input('email')) {
                Validator::make($request->all(), [
                    'email' => ['string', 'email', 'max:255', 'unique:users'],
                ])->validate();
            } else {
                Validator::make($request->all(), [
                    'email' => ['string', 'email', 'max:255'],
                ])->validate();
            }

            $user->email = $request->input('email');
        }

        if (!empty($request->input('password'))) {
            Validator::make($request->all(), [
                'password' => ['string', 'min:8', 'confirmed'],
            ])->validate();

            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        $request->session()->flash('alert-success', 'Account updated.');

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
