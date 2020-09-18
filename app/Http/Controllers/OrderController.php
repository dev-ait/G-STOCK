<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Order;
use App\Product_order;

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
        
        return view('order.indexOrder');
    }

    public function create()
    {
        $products= Product::all();
        $clients= Client::all();
        $data = array( 'products'=> $products , 'clients'=> $clients);
        return view('order.addOrder',$data);
    }

    public function getorder(){

        $orders= Order::all(); 
     

     


        for($i=0;$i<count($orders);$i++)
        {
            $order= Order::find($orders[$i]->id);
            $client= Client::find($orders[$i]->client_id);
            
            $att[] =  [ 'id'=>  $orders[$i]->id , 'nom_client'=> $client->nom , 
            'client_telephone'=> $client->telephone
             ,'product_order'=> $order->orderproduct()->get()  ,
             'subtotal'=>  $orders[$i]->subtotal,
             'tva'=>  $orders[$i]->tva,
             'total'=> $orders[$i]->total,
             'typepaiement'=> $orders[$i]->typepaiement,
             'statutpaiement'=> $orders[$i]->statutpaiement,
  
            ];
        
         

    
        }
        



        $data = array( 'orders'=> $att);
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
        

        if($request->isMethod('post')){

            $add_order= new Order();
            $add_order->client_id= $request->input('idclient');
            $add_order->subtotal= $request->input('subTotalvalue');
            $add_order->tva= $request->input('tvavalue');
            $add_order->total= $request->input('total');    
            $add_order->typepaiement= $request->input('typepaiement');
            $add_order->statutpaiement= $request->input('statutpaiement');  
            $add_order->save();

            for($i=0;$i<count($request->totalp);$i++){
                $products_item = new Product_order();
                $id = $request->product[$i];
                $nom_produit =  Product::find($id);
                $products_item->nom_produit = $nom_produit->titre;
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
        //
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
        //
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