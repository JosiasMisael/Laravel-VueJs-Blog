<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allowed()->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $user = new User();
         $this->authorize('create',$user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.create', compact( 'user','roles','permissions') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);
           $data = $request->validate([

            'name' => 'required',
            'email' =>'required|email|unique:users,email|max:255',

           ]);

        $data['password'] = uniqid();


          $user = User::create($data); //Guardamos Los datos
           $user->assignRole($request->roles); //Asignamos roles
           $user->givePermissionTo($request->permissions); //Asignamos permisos

          UserWasCreated::dispatch($user, $data['password']); //Disparamos en evento para enviar password, asignando, el usuario y su password
          return  redirect()->route('admin.users.index');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   $this->authorize('view', $user);
        return view('admin.users.show', compact('user') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.edit', compact('user','roles','permissions') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user )
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        return  redirect()->route('admin.users.edit', $user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();
        return redirect()->route('admin.users.index');
    }

}
