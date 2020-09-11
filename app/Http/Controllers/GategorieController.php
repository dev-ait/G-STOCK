<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gategorie;

class GategorieController extends Controller
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
        return view('gategorie.indexGategorie');
    }


    public function get_gategorie()
    {
        $gategories= Gategorie::all(); 
        $data = array( 'gategories'=> $gategories);
       return  $data ;
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

           $gategorie_check = Gategorie::where('nom', '=', $request->nom)->first();
           if ($gategorie_check === null) {
               
                if($request->isMethod('post')){
                   $gategorie = new Gategorie; 
                   $gategorie->nom = $request->nom;
                   $gategorie->date_create = $request->date_create;
                   $gategorie->save();
               
                   return Response()->json(['etat' => true  , 'id_cate' => $gategorie->id ]);
                }


            } else{
             
                return Response()->json(['etat' => false  ]);

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
            $gategorie = Gategorie::find($request->id);
            $gategorie->nom = $request->nom;
           
            $gategorie->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {


        $delete_gategorie= Gategorie::find($id);  

        $delete_gategorie->delete();
  
    }
}
