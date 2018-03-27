<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRolesRequest;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->authorize('view', new Role);

      return view('admin.roles.index', [
        'roles' => Role::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $role = new Role);

        return view('admin.roles.create', [
          'role' => $role,
          'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolesRequest $request)
    {
        // $data = $request->validate([
        //   'name' => 'required|unique:roles',
        //   'display_name' => 'required'
        // ],
        // [
        //   'name.required' => 'Поле Identificator обязательно для заполнения.',
        //   'name.unique' => 'Этот Identificator уже зарегистрирован.',
        //   'display_name.required' => 'Поле Nombre обязательно для заполнения.'
        // ]);
        $this->authorize('create', new Role);

        $role = Role::create($request->validated());

        if ($request->has('permissions')) {
          $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.index')
                ->withFlash('The role created correct');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        return view('admin.roles.edit', [
          'role' => $role,
          'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolesRequest $request, Role $role)
    {
      // $data = $request->validate(['display_name' => 'required'],
      // [
      //   'display_name.required' => 'Поле Имя обязательно для заполнения.'
      // ]
      //
      // );
      $this->authorize('update', $role);

      $role->update($request->validated());

      $role->permissions()->detach();

      if ($request->has('permissions')) {
        $role->givePermissionTo($request->permissions);
      }

      return redirect()->route('admin.roles.edit', $role)
              ->withFlash('The role updated correct');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // if ( $role->id === 1 ) {
        //   throw new \Illuminate\Auth\Access\AuthorizationException('Эту роль удалить нельзя!');
        // }

        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('admin.roles.index')->withFlash('Роль удалена');
    }
}
