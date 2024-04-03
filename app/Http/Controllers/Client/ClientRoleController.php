<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\RoleRequest;
use App\Mail\CreateClientRoleMail;
use App\Models\ClientInvitation;
use  App\Models\RoleHasPermissions;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClientRoleController extends Controller
{


   public function __construct()
   {
       $this->middleware('auth');
   }

   public function index()
   {
      $roles = Role::where('status',1)->get();
      $permissions = Permission::where('status',1)->get();
      return view('client.role-permission.index',compact('roles','permissions'));
   }

   public function create()
   {
      $permissions = Permission::where('status',1)->get();
      return view('client.role-permission.createrole',compact('permissions'));
   }

   public function store(RoleRequest $request)
   {
      $roles = Role::create([
         'name' => $request->name,
         'guard_name' => "web"
       ]);
       foreach($request->permission as $perm)
       {
         $permission = permission::find($perm);
         $roles->givePermissionTo($permission);
       }
       return redirect()->route('roles.index')->with('status','Role has been created with its permission');
   }

   public function show($id)
   {
      $roles = Role::find($id);
      $permissions = Permission::where('status',1)->get();
      $rolehaspermission = RoleHasPermissions::where('role_id',$id)->get();
      return view('client.role-permission.show', compact('roles','permissions','rolehaspermission'));
   }


   public function edit($id)
   {
      $role = Role::find($id);
      $permissions = Permission::where('status',1)->get();
      $rolehaspermission = RoleHasPermissions::where('role_id',$id)->get();
      return view('client.role-permission.edit', compact('role', 'permissions','rolehaspermission'));
   }

   public function update(Request $request, $id)
   {
      $roles = Role::find($id);
      $roles->syncPermissions($request->permission);
      return redirect()->route('roles.index')->with('status','Role has been updated with its permission');
   }

   public function destroy($id)
   {
      $roles = Role::find($id);
      $roles->delete();
      return redirect()->route('roles.index')->with('error','Role has been deleted with its permission');
   }

   public function showDescription($id)
   {
      $role = RoleHasPermissions::where('role_id',$id)->get();
      return $role;
   }
   //
   public function createClient(CreateClientRequest $request)
   {
      $client = ClientInvitation::where('email',$request->email)->first();
      if($client == null)
      {
         $user = Auth::user();
         $password = substr($request->email,0,5)."@123";
         $clientinvite = ClientInvitation::create([
            'sender_id'=>$user->id,
            'email'=>$request->email,
            'password'=>$password,
            'user_role_id'=>$request->role,
            'status'=>0,
            'send_date'=>Carbon::now()->toDateString(),
            'expired_date'=>Carbon::now()->addDay(15)->toDateString(),
         ]);
         Mail::to($request->email)->send(new CreateClientRoleMail($clientinvite));
         return back()->with('success','Request has been sent successfully...!!');
      }
      else{
         if($client->expired_date >date('Y-m-d'))
         {
            return back()->with('error','Request already exists');
         }
         else{
            $client->user_role_id = $request->role;
            $client->send_date = Carbon::now()->toDateString();
            $client->expired_date= Carbon::now()->addDay(15)->toDateString();
            $client->update();
            return back()->with('success','Request has been sent successfully...!!');
         }
      }
   }
   public function updateClientRole(Request $request)
   {
      $roles = Role::find( $request->role);
      $user = User::findOrFail($request->userid);
      $user->user_role = $request->role;
      $user->update();
      $user->syncRoles($roles);
      return back()->with('success','Client role has been updated successfully...!!');
   }

   public function editClientRole($id)
   {
      $pendingclient = ClientInvitation::findOrFail($id);
      $userroles = Role::where('status',1)->get();
      return view('client.profile.editclientrole',compact('pendingclient','userroles'));
   }
   public function updatePendingClientRole(Request $request,$id)
   {
      $pendingclient = ClientInvitation::findOrFail($id);
      $pendingclient->email = $request->email;
      $pendingclient->user_role_id = $request->role;
      $pendingclient->send_date= Carbon::now()->toDateString();
      $pendingclient->expired_date= Carbon::now()->addDay(15)->toDateString();
      $pendingclient->update();
      Mail::to($request->email)->send(new CreateClientRoleMail($pendingclient));
      return redirect()->route('client.profile.roles')->with('success','Client role has been updated successfully...!!');
   }

   public function deleteClient($id)
   {
      $user = User::findOrFail($id);
      $roles = Role::find( $user->user_role);
      $user->delete();
      $user->syncRoles($roles);
      return back()->with('error','Client role has been deleted successfully...!!');
   }

   public function deletePendingClientRole($id)
   {
      $pendingclient = ClientInvitation::findOrFail($id);
      $pendingclient->delete();
      return back()->with('error','Pending Client has been deleted successfully...!!');
   }
}
