<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Marque;
use App\Test;

class MarqueController extends Controller
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

        return view('marque.indexMarque');

    }
    

    public function get_marque()
    {
        $marques= Marque::all();

   
        $att=[];
    

        for($i=0;$i<count($marques);$i++)
        {
            $att[] =  [ 'id'=> $marques[$i]->id , 
            'nom'=> $marques[$i]->nom , 
             'date_create'=> $marques[$i]->date_create , 
             'total'=> $marques[$i]->product()->count() ,
            
            ];
        
         

    
        }
        
    
       $data = array( 'marques'=> $att);
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
            $marque = new Marque; 
            $marque->nom = $request->nom;
            $marque->date_create = $request->date_create;
            $marque->save();
        
            return Response()->json(['etat' => true  , 'id_marq' => $marque->id ]);
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
            $marque = Marque::find($request->id);
            $marque->nom = $request->nom;
           
            $marque->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_marque= Marque::find($id);  

        $delete_marque ->delete();
    }

}
