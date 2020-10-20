<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;

use App\Models\User;

use App\Models\Role_user;
use App\Models\Menu;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    
    
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function form(){

        
        $user = Sentinel::findById(1);


        $data = array( 'user'=> $user);
        return view('form', $data );


    }

    public function permissions(){

        $roles = Sentinel::getRoleRepository()->get();
        $menu = Menu::all();

        $this->authorize('admin_access_all_page_utilisateurs');

        $data = array( 'roles'=> $roles ,'menu'=> $menu );

        return view('utilisateurs.permissions',$data );
    }


    public function menu_pages(){
        $menu_page = Menu::all();
        $data = array('menu_pages'=>$menu_page );
        return view('utilisateurs.menu_pages', $data);
      
    }

    public function create_name_page(Request $request){
        $new_page = new Menu();

        $new_page->nom = $request->input('nom');

        $new_page->save();

        session()->flash('succes_menu','La page '.$new_page->nom.' a été bien enregistré');
        return redirect("menu_pages");

    }

    

    public function destroy($id)
    {
        $delete_user= User::find($id);  

        $delete_user->delete();

        return Response()->json([ 'etat' => true ]);

    }

    public function update(Request $request)
    {
        

        if( $request->input('nom') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Nom' ]);
            exit;
        }
        if( $request->input('email') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Email' ]);
            exit;
        }


        if( $request->input('role_id') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Role' ]);
            exit;
        }
       
        if($request->isMethod('post')){

            $user = Sentinel::findById($request->input('id'));
        
            $user->name = $request->input('nom');
            $user->email = $request->input('email');
                if($request->input('password') != ""){
                    $user->password = Hash::make($request->input('password'));
                }
            $user->save();  
            
            
            $user_role  = Role_user::where('user_id', '=',$request->input('id'))->first();
            $user_role->role_id = $request->input('role_id');
            $user_role->save();
            return Response()->json(['etat' => true ]);
        }

    }

    public function  edit($id)
    {

      

        $user = Sentinel::findById($id);

        $att =  array( 
            'id'=> $user->id ,
            'nom'=>  $user->name , 
            'email'=>  $user->email , 
            'role'=>  $user->roles[0]->name ,
                  ) 
            ; 

            $data = array( "user" => $att  );

     
        return view('utilisateurs.contact_details',$data );



    }
 
    public function delete_user($id){
        
        $delete_Menu= Menu::find($id);  

        $delete_Menu->delete();

        return redirect('menu_pages');
    }


    public function create_user(Request $request){

        if (User::where('email', '=', $request->input('email'))->count() > 0) {
            return Response()->json([ 'email' => true  ]);
         }

        if( $request->input('nom') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Nom' ]);
            exit;
        }
        if( $request->input('email') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Email' ]);
            exit;
        }

        if( $request->input('password') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Password' ]);
            exit;
        }

        if( $request->input('role_id') == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Role' ]);
            exit;
        }


        $new_user = new User();

        $new_user->name = $request->input('nom');
        $new_user->email = $request->input('email');
        $new_user->password = Hash::make($request->input('password'));

        $new_user->save();

        $role_user = new Role_user();
        $role_user->user_id = $new_user->id;
        $role_user->role_id = $request->input('role_id');
        $role_user->save(); 

        session()->flash('succes_user',$new_user->name);

        return Response()->json(['etat' => true ]);




    }

    public function users(){

        $users = Sentinel::getUserRepository()->with("roles")->get();

 
        $data = array( 'users'=> $users);
        
        return view('utilisateurs.users',$data );
    }



}
