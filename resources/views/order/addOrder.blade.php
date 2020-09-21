@extends('layouts.app_dashbord') @section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
   <h1 class="h3 mb-0 text-gray-800">Commande</h1>
</div>
<div class="row">
   <div class="col-md-12">
      <!-- Panel order -->
      <div class="card shadow mb-4 p-0" >
         <div class="card-header py-3">
            <div class="profile-description"></div>
            <h6 class="m-0 titre-panel">Ajouter un commande</h6>
         </div>
      
         <div class="card-body">
           <form action="{{ url('order')}}" method="POST" id="FormOrder" onsubmit="return validateForm();">
               {{ csrf_field() }}
            <div class="row">
               <div class="col-md-12">
             
                  <label for="titre" class="label-p">Date de commande  </label>
                  <input type="date" name="date_commande" class="form-control input-product">
               </div>
               <div class="col-md-12 pt-2">
                  <div class="half-form pr-3">
                     <label for="quantite" class="label-p">Nom de client </label>
                     <select id="valueclient" onchange="getphone()" class="js-example-basic-single form-control input-product" style="width: 100%" name="idclient" required>
                      <option class="select2-results__group"  value="">Selectionner le Client</option>
                      @foreach ($clients as $client)
                      <option  value="{{$client->id}}">{{$client->nom}}</option>
                      @endforeach
                   </select>
                  </div>
                  <div class="half-form pl-3">
                     <label for="taux" class="label-p">Numero Telephone de client </label>
                     <input type="text" id="phone_client" name="taux" class="form-control input-product" disabled required>
                  </div>
               </div>
               <div class="col-md-12 pt-2">
                
                  <div class="col-md-12 pt-2">
                     <table class="table table-bordered" id="table">
                        <thead>
                           <tr >
                              <th style="width:30%" scope="col">Produit</th>
                              <th scope="col">Taux</th>
                              <th scope="col">Quantite</th>
                              <th scope="col">Total</th>
                              <th>
                              </th>
                           </tr>
                        </thead>
                        <tr id='row1'>
                           <td>
                              <select  id="productName1" onchange="getProductData(1)" class="js-example-basic-single form-control input-product" style="width: 100%" name="product[]" required>
                                 <option class="select2-results__group"  value="">Selectionner le produit</option>
                                 @foreach ($products as $product)
                                 <option  value="{{$product->id}}">{{$product->titre}}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td id="col2"><input type="number"  id="rate1" class="form-control input_or"  disabled required >
                            <input type="hidden" id="rateValue1" name="rate[]" class="form-control input_or" required>
                           </td>
                           <td id="col3"><input type="number" onclick="calcul_total(1)" id="quantite1" name="quantite[]" class="form-control input_or" required>
                           
                           </td>
                           <td id="col4"><input type="number" id="total1" name="total[]" class="form-control input_or" disabled required>
                            <input type="hidden" id="totalValue1" name="totalp[]" class="form-control input_or" required>
                           </td>
                           <td >
                              <a href="#" class="btn btn-danger btn-circle btn-remove" onClick="removeRow(1)" required>
                              <i class="fa fa-trash"></i>
                              </a>
                           </td>
                        </tr>
                     </table>
                     <div class="d-block text-right">
                      <a href="#" class="btn-add btn-add" >
                      <i class="zmdi zmdi-plus-circle btn-success1"></i>
                      <span class="text-add-row">ajouter nouveau ligne</span>
                      </a>
                   </div>
                  </div>
                  <div class="col-md-12 pt-2">
                     <div class="half-form pr-3">
                        <label for="quantite" class="label-p">Sous Total </label>
                        <input type="text" id="subTotal" name="subTotal" class="form-control input-product" disabled required>
                        <input type="hidden" id="subTotalvalue" name="subTotalvalue" class="form-control input-product" required>
                        <label for="taux" class="label-p">Tva </label>
                        <input type="text" id="tva" name="tva" class="form-control input-product" disabled required>
                        <input type="hidden" id="tvavalue" name="tvavalue"  >
                        <label for="taux" class="label-p">Total </label>
                        <input type="text" id="total" name="total" class="form-control input-product" disabled required>
                        <input type="hidden" id="totalvalue" name="total" >
                     </div>
                     <div class="half-form pl-3">
                        <label for="taux" class="label-p">Type de paiement </label>
                        <select  class="form-control input-product" style="width: 100%" name="typepaiement" required>
                           <option  value="">Selectionner </option>
                           <option value="Cheque">Cheque</option>
                           <option value="Cash">Cash</option>
                           <option value="Credit Card">Credit Card</option>
                           <option  value="Cash">Cash</option>
                        </select>
                        <label for="taux" class="label-p ">Statut de paiement </label>
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
        
            <div class="col-md-12 pt-3">
               <div class="text-center">
                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fa fa-check"></i>
                  </span>
                  <span class="text mr-2">Validé</span>
                </button>
                <a href="#" id="" class="btn btn-secondary btn-icon-split btn-reset" onclick="resetOrderForm()">
                  <span class="icon text-white-50">
                    <i class="fa fa-arrow-right"></i>
                  </span>
                  <span class="text mr-2">Effacer</span>
                </a>
               </div>
            </div>
          </form>
         </div>
      </div>
   </div>
</div>
<script>
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}
</script>
<script src="{{ asset('js/order_script.js') }}"></script>
@endsection