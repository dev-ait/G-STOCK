<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Site;
use App\Models\Order;
use App\Models\User;
use App\Models\Product_order;

use Illuminate\Support\Facades\Auth;


use Sentinel;

class OrderController extends Controller
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

        $this->authorize('view_all_page_order');
     
        return view('order.indexOrder');
    }


    public function create()
    {
        $this->authorize('view_page_create_order');
        $this->authorize('view_all_page_order');

        $products= Product::all();

        $id = Auth::id();
        $user = User::find($id);

        $clients= [];
         

        if(!empty($user->project[0]->clients_id)){
            $project = $user->project[0]->clients_id;
            
            $arry_project = json_decode($project, true);

            for ($i = 0;$i < count($arry_project);$i++)
            {

                $clients[] = array(
                    'id'   =>   Site::find((int)$arry_project[$i]['id'])->id,
                    'name' => Site::find((int)$arry_project[$i]['id'])->nom,

                );
            }

        }
       
         

        $data = array( 'products'=> $products , 'clients'=> $clients);
        return view('order.addOrder',$data);
    }

    public function create_superviseur()
    {
        $this->authorize('view_page_create_order');
        $this->authorize('view_all_page_order');

        $products= Product::all();

        $id = Auth::id();
        $user = User::find($id);

        $clients= [];
         

        if(!empty($user->project[0]->clients_id)){
            $project = $user->project[0]->clients_id;
            
            $arry_project = json_decode($project, true);

            for ($i = 0;$i < count($arry_project);$i++)
            {

                $clients[] = array(
                    'id'   =>   Client::find((int)$arry_project[$i]['id'])->id,
                    'name' => Client::find((int)$arry_project[$i]['id'])->nom,

                );
            }

        }
       
         

        $data = array( 'products'=> $products , 'clients'=> $clients);
        return view('order.addOrderSuperviseur',$data);
    }

    public function getorder(){


        $id = Auth::id();
        $user = Sentinel::findById($id);


        $role = $user->roles[0]->slug;


        if ( $user->inRole('admin') or $id == 1 )
        {
                $orders= Order::all();                
            
        }else if ($user->inRole($role) && $role != "admin" ) {

            if ($user->hasAccess(['order.delete_validation']))
            {
                $orders = Order::where('status', '=', '1' )->get();

            }  else  if ($user->hasAccess(['order.view']))
            {
                $orders = Order::where('status', '=', '2' )->get();
                
            } else  if ($user->hasAccess(['order.create']))
            {
                $user = User::find($id) ;   

                $orders = $user->order()->get();
            } 
                      
        }

   


        
     

        

       


        for($i=0;$i<count($orders);$i++)
        {
            $order= Order::find($orders[$i]->id);
            $site= Site::find($orders[$i]->site_id);
            
            $att[] =  [ 'id'=>  $orders[$i]->id , 'site'=> $site->nom  
        
             ,'product_order'=> $order->orderproduct()->get()  ,
          
             'status'=> $orders[$i]->status,
  
            ];
        
         

    
        }
        



        $data = array( 'orders'=> $att , 'user' => $user );
        return $data;

        echo json_encode($data);
        exit;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_phone_client(Request $request)
    {

        $client   = Client::find($request->clientId);

        $data = array( 'client'=> $client);

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
        $id_user = Auth::id();

        if($request->isMethod('post')){

            $add_order= new Order();
            $add_order->site_id= $request->input('site_id');
            $add_order->user_id = $id_user;  
            $add_order->status = '1';  

            $add_order->save();

            for($i=0;$i<count($request->product);$i++){
                $products_item = new Product_order();
                $id = $request->product[$i];
                $nom_produit =  Product::find($id);
                $products_item->nom_produit = $nom_produit->designation;
                $products_item->id_product = $id ;
                $products_item->prix = $nom_produit->prix;
                $products_item->quantite = $request->quantite[$i];
                $products_item->order_id = $add_order->id;
                $products_item->save();
            }

            return redirect('order');
        
        }

    

    }



    public function store_s(Request $request)
    {
        $id_user = Auth::id();

        if($request->isMethod('post')){

            $add_order= new Order();
            $add_order->site_id= $request->input('site_id');
            $add_order->user_id = $id_user;  
            $add_order->status = '2';  

            $add_order->save();

            for($i=0;$i<count($request->totalp);$i++){
                $products_item = new Product_order();
                $id = $request->product[$i];
                $nom_produit =  Product::find($id);
                $products_item->nom_produit = $nom_produit->titre;
                $products_item->id_product = $id ;
                $products_item->total = $request->totalp[$i];
                $products_item->prix = $request->rate[$i];
                $products_item->quantite = $request->quantite[$i];
                $products_item->order_id = $add_order->id;
                $products_item->save();

                $up_product =  Product::find($id);
                $quantite_product = $up_product->quantite;
                $up_product->quantite =  $quantite_product  - $request->quantite[$i];
                $up_product->save();

          

            }

            return redirect('order');
        
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

        $sites = Site::all();
        $products = Product::all();

        $order= Order::find($id);
        $site= Site::find($order->site_id);
        
        $att[] =  [ 'id'=>  $order->id ,
         'id_site'=> $site->id , 
         'nom_site'=> $site->nom , 
         'created_at'=> $order->created_at , 
         'product_order'=> $order->orderproduct()->get()  ,
     
         'status'=> $order->status,

        ];

        $data = array( 'orders'=> $att , 'sites' =>  $sites  , 'products' =>  $products);
  



        return view('order.invoice',$data);
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
        $order = Order::find($request->input('id_order'));
    
        $order->client_id= $request->input('idclient');
        $order->subtotal= $request->input('subTotalvalue');
        $order->tva= $request->input('tvavalue');
        $order->date_create= $request->input('date_commande');
        $order->total= $request->input('total');    
        $order->typepaiement= $request->input('typepaiement');
        $order->save();

        $product_order_delete = Product_order::where('order_id', '=', $request->input('id_order'));
       
        $product_order_delete->delete();

        for($i=0;$i<count($request->totalp);$i++){
            $products_item = new Product_order();
            $id = $request->product[$i];

            if(is_numeric($id)){
                $nom_produit =  Product::find($id);
                $products_item->nom_produit = $nom_produit->titre;
            }else{
                $products_item->nom_produit = $id;
            }
            
           
            $products_item->total = $request->totalp[$i];
            $products_item->prix = $request->rate[$i];
            $products_item->quantite = $request->quantite[$i];
            $products_item->order_id = $request->input('id_order');
            $products_item->save();
            if(is_numeric($id)){
                $up_product =  Product::find($id);
                $quantite_product = $up_product->quantite;
                $up_product->quantite =  $quantite_product  - $request->quantite[$i];
                $up_product->save();

            }
           
        }

        return redirect('order/'.$request->input('id_order').'/edit');
    }



    public function validation_commande(Request $request)
    {
           
           $id    = $request->id;
           $order =  Order::find($id);



          $product_order = $order->orderproduct()->get();




           if($request->action == 'valider') {

            $order->status = '2';

           }

           if($request->action == 'reject') {

            $order->status = '3';

           }


             $order->save();


           
          for($i=0;$i<count($product_order);$i++){

            $up_product =  Product::find($product_order[$i]->id_product);
            $quantite_product = $up_product->quantite;
            $up_product->quantite =  $quantite_product  - $product_order[$i]->quantite;
            $up_product->save(); 
        
           }

      
           return Response()->json([ 'etat' => true , 'id' => $id   ]);
           exit;



    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete_Product= Order::find($id);  
        $delete_Product->delete();
      
        $delete_Product_item = Product_order::where('order_id', $id);
        $delete_Product_item->delete();

     


    }
    
}
