<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = null;
        return view('dashboard.roles.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            Role::create($input);
            DB::commit();

            return redirect()->route('dashboard.roles.index')->with('info', trans('lang.role_created'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('dashboard.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        try {
            $request->validate([
                'name' => 'required'
            ]);

            DB::beginTransaction();
            $role->update($request->all());
            DB::commit();

            return redirect()->route('dashboard.roles.index')->with('info', trans('lang.role_updated'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('lang.user_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();

            return redirect()->route('dashboard.roles.index')->with('info', trans('lang.role_deleted'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
        }
    }
}
