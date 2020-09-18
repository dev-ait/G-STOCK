<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gategorie;
use App\Marque;

use App\Product;



class ProductController extends Controller
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
       return view('product.indexProduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gategories= Gategorie::all(); 
        $marques = Marque::all(); 
        $data = array( 'gategories'=> $gategories , 'marques'=> $marques  );
       
        return view('product.add_Product',$data); 
    }

    


    public function get_product()
    {
        $products= Product::all(); 
   
        $att=[];
    

        for($i=0;$i<count($products);$i++)
        {
            $att[] =  [ 'titre'=> $products[$i]->titre , 
            'id'=> $products[$i]->id ,
             'gategorie_id'=> $products[$i]->gategorie->nom,
             'quantite'=> $products[$i]->quantite ,
             'taux'=> $products[$i]->taux ,
             'statut'=> $products[$i]->statut ,
             'marque_id'=> $products[$i]->marque_id ,
             'photo'=> $products[$i]->photo ,   
            ];
        
         

    
        }

        $data = array( 'products'=> $att);
        return $data;

        echo json_encode($data);
        exit;
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
            $add_Product= new Product();
            $add_Product->titre = $request->input('titre');
            $add_Product->description = $request->input('description');
            $add_Product->quantite = $request->input('quantite');
            $add_Product->taux = $request->input('taux');
            $add_Product->prix = $request->input('prix');
            $add_Product->statut = $request->input('statut');
            $add_Product->gategorie_id = $request->input('gategorie');
            $add_Product->marque_id = $request->input('marque');
            if($request->hasFile('photo')){
            $name_img = $request->photo->store('public/image');
            $add_Product->photo = substr($name_img, 6);
            
            }
            $add_Product->save();

           
             
            return redirect('product');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_data_product(Request $request)
    {
        $product   = Product::find($request->productId);

        $data = array( 'product'=> $product);

        echo json_encode($data);
        exit;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product   = Product::find($id);
        $gategorie   = Gategorie::all();
        $marque   = Marque::all();


    
     
        $data = array('product' => $product , "gategories" => $gategorie  , "marques" => $marque);
        return view('product.update_Product',$data); 
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
        $update_Product = product::find($id); 

        $update_Product->titre = $request->input('titre');
        $update_Product->description = $request->input('description');
        $update_Product->quantite = $request->input('quantite');
        $update_Product->taux = $request->input('taux');
        $update_Product->prix = $request->input('prix');
        $update_Product->statut = $request->input('statut');
        $update_Product->gategorie_id = $request->input('gategorie');
        $update_Product->marque_id = $request->input('marque');
        if($request->hasFile('photo')){
        $name_img = $request->photo->store('public/image');
        $update_Product->photo = substr($name_img, 6);
        
        }

            $update_Product->save();
           
            return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_Product= Product::find($id);  

        $delete_Product->delete();
    }
}
