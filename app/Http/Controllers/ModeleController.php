<?php

namespace App\Http\Controllers;


use App\Models\Modele;

use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {  

        return view('modele.indexModele');

    }
    

    public function get_modele()
    {
        $modeles= Modele::all();

   
        $att=[];
    

        for($i=0;$i<count($modeles);$i++)
        {
            $att[] =  [ 'id'=> $modeles[$i]->id , 
            'nom'=> $modeles[$i]->nom , 
             'date_create'=> $modeles[$i]->date_create , 
             'total'=> $modeles[$i]->product()->count() ,
            
            ];
        
         

    
        }
        
    
       $data = array( 'modeles'=> $att);
       return $data;

       echo json_encode($data);
       exit;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $modele = new Modele; 
            $modele->nom = $request->nom;
            $modele->date_create = $request->date_create;
            $modele->save();
        
            return Response()->json(['etat' => true  , 'id_mode' => $modele->id ]);
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
    public function update(Request $request)
    {
            $modele = Modele::find($request->id);
            $modele->nom = $request->nom;
           
            $modele->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_modele= Modele::find($id);  

        $delete_modele->delete();
    }
}
