@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">

<style>
  .table-product.active{
   display: none;
  }
  td.row_p {
    width: 214px;
  }
  .btn-calendrier {
    position: relative;
    left: -40px;
}
  
</style>

@endsection

@section('main-content')


<div class="breadcrumb">
    <h1>Nouvelle Commandes</h1>
  
</div>
<div class="separator-breadcrumb border-top"></div>

<form action="{{ url('order')}}" method="POST" id="FormOrder" onsubmit="return validateForm();">
  {{ csrf_field() }}
  
<section class="chekout-page">
    <div class="row">
      <div class="col-lg-6 mb-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="card-title">Panier de produit</div>
              
              <div class="headder-elements tt">
                <div class="list-icons">
                    <a href="" class="ul-task-manager__list-icon " id="arrow-down"><i class="i-Arrow-Down"></i></a>
                    <a href="" class="ul-task-manager__list-icon btn-add"><i class="i-Add"></i></a>

                </div>
            </div>
             
            </div>
           


            <div class="table-responsive table-product ">
              <table id="table_product" class="table">
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col"></th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id='row1'>
                    <td scope="row" class="row_p">
                      <select  id="productName1" onchange="getProductData(1)" class="js-example-basic-single form-control input-product" style="width: 100%" name="product[]" required>
                        <option   value="">Selectionner le produit</option>
                        @foreach ($products as $product)
                        <option  value="{{$product->id}}">{{$product->titre}}</option>
                        @endforeach
                     </select>
                    </td>
                    <td> <div class="d-flex "> <div id="price1" class="d-none"> 0  </div>    </div> 
                      <input type="hidden" id="priceValue1" name="rate[]" class="form-control input_or" >
                    </td>
                    <td>
                       <input type="number" onclick="calcul_total(1)" value="0" id="quantite1" name="quantite[]" class="form-control input_or" required>
                      
                    </td>
                    <td><div class="d-flex "> <div id="total_product1" class="d-none" > 0.00  </div>  
                      <input type="hidden" id="total_productValue1" name="totalp[]" class="form-control input_or">
                     </td>
                    <td>
                      <a href="" onClick="removeRow(event,1)" ><i class="i-Close-Window text-19 text-danger font-weight-700 prevent-default"></i></a>
                    
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="row ">
              <div class="col-lg-12 mt-5">
                <div class="ul-product-cart__invoice">
                  <div class="card-title d-none">
                    <h4 class="heading text-primary">Total Payment</h4>
                  </div>
                  <table class="table d-none">
                    <tbody>
                      <tr>
                        <th scope="row" class="text-16">Sous Total</th>
                        <td class="text-16 text-success font-weight-700">
                          <div class="d-flex "> <div id="subTotal"> 0.00  </div>  <span class=" pl-1">DH</span>  </div>
                          <input type="hidden" id="subTotalValue" name="subTotalvalue" class="form-control input-product" required>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="text-16">Tva</th>
                        <td>
                           <span>
                           <div class="d-flex "> <div id="tva"> 0.00  </div>  <span class="text-muted pl-1">DH</span> 
                           </div>
                          </span>
                          <input type="hidden" id="tvaValue" name="tvavalue">
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="text-primary text-16">
                          Total:
                        </th>
                        <td class="font-weight-700 text-16">
                          <div class="d-flex "> <div id="total"> 0.00  </div>  <span class="text-muted pl-1">DH</span> 
                          <input type="hidden" id="totalValue" name="total" >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
              </div>
              
            </div>
          </div>
          <div class="card-footer">
            <div class="row text-right">
              <div class="col-lg-12 ">
                <button type="submit" class="btn btn-success m-1">
                 Validé
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
         
              <div class="card-body">
                <div class="card-title">Les informations Supplémentaire de Commandes</div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputtext11" class="ul-form__label">Date de commande:</label>
                    <div class="row">
                    <div class="col-md-11">
                    <input id="picker3" name="date_commande" class="form-control" placeholder="yyyy-mm-dd"  >
                     </div>
                    <div class="input-group-append col-md-1">
                      <button class="btn btn-secondary btn-calendrier"  type="button">
                          <i class="icon-regular i-Calendar-4"></i>
                      </button>
                     </div>
                    </div>

                     
                    

                  
                  </div>
                </div>


              

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputtext14" class="ul-form__label">Nom de client:</label>
                    <select id="valueclient" onchange="getphone()" class="select-js-client form-control input-product" style="width: 100%" name="idclient" required>
                     <option class="select2-results__group"  value="">Selectionner le Client</option>
                     @foreach ($clients as $client)
               <option  value="{{$client['id']}}">{{$client['name']}}</option>
                     @endforeach
                  </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail15" class="ul-form__label">Numero Telephone de client :</label>
                    <input type="text" id="phone_client"  class="form-control" disabled required>
                  </div>

                 
                </div>
              </div>
            
          </div>
        </div>

        <div class="card mt-4">
          <div class="card-body">
            <div class="card-title">Mode de Paiment</div>
            
            <div class="half-form pl-3 pb-3">
               <label for="typepaiement" class="label-p">Type de paiement </label>
               <select  class="form-control input-product" style="width: 100%" name="typepaiement" required>
                  <option  value="">Selectionner </option>
                  <option value="Cheque">Cheque</option>
                  <option value="Cash">Cash</option>
                  <option value="Credit Card">Credit Card</option>
                  <option  value="Cash">Cash</option>
               </select>
               <label for="statutpaiement" class="label-p ">Statut de paiement </label>
               <select  class="form-control input-product" style="width: 100%" name="statutpaiement" required>
                  <option  value="">Selectionner</option>
                  <option value="Règlement de la totalité">Règlement de la totalité</option>
                  <option value="paiement anticipét">paiement anticipét</option>
                  <option value="aucun paiement">aucun paiement</option>
               </select>
            </div>
            
           
          </div>
        
        </div>
      </div>
    </div>
  </section>

</form>



@endsection

@section('page-js')

<script src="{{ asset('js/plugins/jquery-3.5.1.min.js') }}"></script>
<link href="{{asset('assets/styles/css/select2.min.css')}}" rel="stylesheet" />
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>

<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>


<script>
  window.laravel ={!! json_encode([
    'token' => csrf_token(),
    'url'   => url('/'),
    'date'   => date('Y-m-d'),
  
  
  ]) !!}
</script>

<script src="{{ asset('js/order_script.js') }}"></script>


@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>


@endsection