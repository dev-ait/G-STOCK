<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File; 

use App\Models\Gategorie;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Product;
use App\Models\Image;

use Illuminate\Support\Facades\Auth;

use Gate;

use Sentinel;






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
        
        $this->authorize('view_all_page_product');


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
         $Modeles= Modele::all();
        $data = array( 'gategories'=> $gategories , 'marques'=> $marques ,'modeles'=> $Modeles );
       
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
             'statut'=> $products[$i]->statut ,
             'marque_id'=> $products[$i]->marque->nom ,
             'photo'=> $products[$i]->image->nom ,   
             'prix'=> $products[$i]->prix , 
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
    public function stote_img(Request $request){

        $new_img = new Image();

        if($request->hasFile('file')){

            $file = $request->file;
    
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

           $new_img->nom = $fileName;
        
        }
        $new_img->save();

        return Response()->json([ 'id' => $new_img->id  ]);
    }

    public function dropzoneRemove( $id)
    {
        $photo = Image::find($id);
        $destinationPath = public_path(). "\images" .$photo->nom;
   

        
            

            if(file_exists($destinationPath)) {
                File::delete($destinationPath);
                $photo->delete() ;   //Delete file record from DB

                 return response('Photo deleted', 200); //return success
            }
           

        
      
     }

     

     public function update(Request $request)
     {
        if($request->titre == ''){
            return Response()->json([ 'etat' => false , 'text' => 'Le champs text est obligatoire' ]);
            exit;
        }
        
        if( $request->quantite == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Le champs quantite est obligatoire' ]);
            exit;
        }
        
        if( $request->prix == '' ){
            return Response()->json([ 'etat' => false, 'text' => 'Le champs prix est obligatoire']);
            exit;
        }
        
        if( $request->statut == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Le champs statut est obligatoire' ]);
            exit;
        }
        
        if( $request->gategorie == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Le champs gategorie est obligatoire' ]);
            exit;
        }
        if( $request->marque == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'Le champs marque est obligatoire' ]);
            exit;
        }
        
         if($request->isMethod('post')){
 
         $update_Product = product::find($request->input('id')); 
         $update_Product->titre = $request->input('titre');
         $update_Product->description = $request->input('description');
         $update_Product->quantite = $request->input('quantite');
         $update_Product->prix = $request->input('prix');
         $update_Product->statut = $request->input('statut');
         $update_Product->photo_id =  $request->input('photo');
         $update_Product->gategorie_id = $request->input('gategorie');
         $update_Product->marque_id = $request->input('marque');
      
         $update_Product->save();   
         return Response()->json(['etat' => true ]);
         }
 
     }

    public function store(Request $request)
    {
        if($request->titre == ''){
            return Response()->json([ 'etat' => false , 'text' => 'text' ]);
            exit;
        }
        
        if( $request->quantite == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'quantite' ]);
            exit;
        }
        
        if( $request->prix == '' ){
            return Response()->json([ 'etat' => false, 'text' => 'prix']);
            exit;
        }
        
        if( $request->statut == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'statut' ]);
            exit;
        }
        
        if( $request->gategorie == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'gategorie' ]);
            exit;
        }
        if( $request->marque == '' ){
            return Response()->json([ 'etat' => false , 'text' => 'marque' ]);
            exit;
        }

        if($request->isMethod('post')){
            $add_Product= new Product();
            $add_Product->titre = $request->input('titre');
            $add_Product->description = $request->input('description');
            $add_Product->quantite = $request->input('quantite');
            $add_Product->prix = $request->input('prix');
            $add_Product->statut = $request->input('statut');
            $add_Product->gategorie_id = $request->input('gategorie');
            $add_Product->marque_id = $request->input('marque');
            $add_Product->photo_id =  $request->input('photo');
            $add_Product->modele_id =  $request->input('modele_id');
            $add_Product->save();
            session()->flash('succes','le produit '.$add_Product->titre.' a été bien enregistré');
           return Response()->json(['etat' => true ]);
         
             
            
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

    public function search_product(Request $request)
    {
       $products=  Product::where('titre', 'like', $request->term.'%')->get();
       $output = array();
       if( $products->count() > 0)
       {
           foreach($products as $row)
           {
               $temp_array = array();
               $temp_array['value'] = $row['titre'];
               $temp_array['value_hidden'] = $row['id'];
               $temp_array['label'] = '<img src="/storage'.$row['photo'].'" width="70" />&nbsp;&nbsp;&nbsp;'.$row['titre'].'';
               $output[] = $temp_array;
           }
       }
       else
       {
           $output['value'] = '';
           $output['label'] = 'Aucun Enregistrement Trouvé';
       }
   
       echo json_encode($output);

      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products   = Product::find($id);

        $modele= '';

        if(!empty($products->modele->nom)){
            $modele = $products->modele->nom;
        }

        $product =  array( 
        'id'=> $products->id ,
        'titre'=> $products->titre , 
        'description'=> $products->description , 
         'gategorie_id'=> $products->gategorie->nom,
         'quantite'=> $products->quantite ,
         'statut'=> $products->statut ,
         'marque_id'=> $products->marque->nom ,
         'modele_id'=>  $modele ,
         'photo_nom'=> $products->image->nom ,
         'photo_id'=> $products->photo_id ,      
         'prix'=> $products->prix ,) 
        ;
        
        
        $gategorie   = Gategorie::all();
        $marque   = Marque::all();
        $modeles   = Modele::all();
        


    
     
        $data = array( "product" => $product , "gategories" => $gategorie  , "marques" => $marque  , "modeles" => $modeles);
        return view('product.update_Product',$data)  ; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

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
