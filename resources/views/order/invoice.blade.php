@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">



@endsection

@section('main-content')
    <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab"
                                aria-controls="invoice" aria-selected="true">Facture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit"
                                aria-selected="false">Modifier</a>
                        </li>

                    </ul>
                    <div class="card">

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                <div class="d-sm-flex mb-5" data-view="print">
                                    <span class="m-auto"></span>
                                    <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Imprimer la facture</button>
                                </div>
                                <!---===== Print Area =======-->
                                <div id="print-area">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="font-weight-bold">Informations de commande</h4>



                                   

                                        <p>#{{$orders[0]['id']}}</p>
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                            <p><strong>Statut de la commande: </strong>{{$orders[0]['statutpaiement']}}</p>
                                            <p><strong>Date de commande: </strong> {{$orders[0]['date_create']}} </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-6 mb-3 mb-sm-0">
                                            <h5 class="font-weight-bold">Nom de Client</h5>
                                            <p>{{$orders[0]['nom_client']}}</p>
                                        
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                            <h5 class="font-weight-bold">Telephone de client </h5>
                                            <p>{{$orders[0]['client_telephone']}}</p>
                                            <span style="white-space: pre-line">
                                                <h5 class="font-weight-bold">Type de paiement </h5>
                                                <p>{{$orders[0]['typepaiement']}}</p>
                                         
                                            </span>
                                        </div>
                                    </div>
                                <?php $count =1 ;?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-hover mb-4">
                                                <thead class="bg-gray-300">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nom produit</th>
                                                        <th scope="col">Prix</th>
                                                        <th scope="col">Quantite</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders[0]['product_order'] as $product_order)

                                                    <tr>
                                                    <th scope="row">{{$count}}</th>
                                                        <td>{{$product_order['nom_produit']}}</td>
                                                        <td>{{$product_order['prix']}} DH</td>
                                                        <td>{{$product_order['quantite']}}</td>
                                                        <td>{{$product_order['total']}} DH</td>
                                                    </tr>

                                                    <?php $count++ ;?>
                                                        
                                                    @endforeach
                                                  
                                                  
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="invoice-summary">
                                                <p>Sous total: <span>{{$orders[0]['subtotal']}} DH</span></p>
                                                <p>Tva: <span>{{$orders[0]['tva']}} DH</span></p>
                                                <h5 class="font-weight-bold"> Total: <span>{{$orders[0]['total']}} DH</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--==== / Print Area =====-->
                            </div>
                            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                <!--==== Edit Area =====-->
                                <div class="d-flex mb-5">
                                    <span class="m-auto"></span>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                                <form >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="font-weight-bold">Informations de commande</h4>
                                            <div class="col-sm-4 form-group mb-3 pl-0">
                                                <label for="orderNo">Numero de commande</label>
                                                <input type="text" class="form-control"
                                                    id="orderNo" placeholder="Enter order number" value=" {{$orders[0]['id']}}" disabled>
                                            </div>
                                        </div>
                                        
                                            
                                       
                                        <div class="col-md-3 offset-md-3 text-right">
                                            <label class="d-block text-12 text-muted">Order Status</label>
                                            <select class="form-control input-product" style="width: 100%" name="typepaiement" required="">
                                                <option value=""  >Selectionner </option>
                                                <option value="Règlement de la totalité" @if ($orders[0]['statutpaiement'] =='Règlement de la totalité') selected  @endif>Règlement de la totalité</option>
                                                <option value="paiement anticipét" @if ($orders[0]['statutpaiement'] =='paiement anticipét') selected  @endif>paiement anticipét</option>
                                                <option value="aucun paiement" @if ($orders[0]['statutpaiement'] =='aucun paiement') selected  @endif>aucun paiement</option>
                                               
                                             </select>
                                            <div class="form-group mb-3">
                                                <label for="order-datepicker">Date de commande</label>
                                                    <input id="order-datepicker" class="form-control text-right"
                                                        placeholder="yyyy-mm-dd" name="dp" value="{{$orders[0]['date_create']}}">


                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-6" >
                                            <h5 class="font-weight-bold">Nom client</h5>
                                            <div class="col-md-10 form-group mb-3 pl-0">
                                              
                                                <select id="valueclient" onchange="getphone()" class="select-js-client form-control input-product" style="width: 100%" name="idclient" required>
                                                    <option class="select2-results__group"  value="">Selectionner le Client</option>
                                                    @foreach ($clients as $client)
                                                    <option  value="{{$client->id}}">{{$client->nom}}</option>
                                                    @endforeach
                                                 </select>
                                            </div>
                                        
                                        </div>

                                        <div class="col-md-6 text-right" >
                                            <h5 class="font-weight-bold">Numero Telephone de client :</h5>
                                            <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                             
                                                
                                                    <input type="text" id="phone_client"  class="form-control" disabled required>
                                                  
                                            </div>
                                         
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-hover mb-3">
                                                <thead class="bg-gray-300">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nom produit</th>
                                                        <th scope="col">Prix</th>
                                                        <th scope="col">Quantite</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                  
                                                </thead>

                                                <?php $count_edit =1 ;?>
                                             
                                                    @foreach ($orders[0]['product_order'] as $product_order)

                                                    <tr>
                                                    <th scope="row">{{$count_edit}}</th>
                                                        <td>{{$product_order['nom_produit']}}</td>
                                                        <td>{{$product_order['prix']}} DH</td>
                                                        <td>{{$product_order['quantite']}}</td>
                                                        <td>{{$product_order['total']}} DH</td>
                                                        <td>
                                                            <button class="btn btn-outline-secondary float-right">Supprimer</button>
                                                        </td>
                                                    </tr>

                                                    <?php $count_edit   ++ ;?>
                                                        
                                                    @endforeach
                                                  
                                                  
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary float-right mb-4">Ajouter un produit</button>
                                        </div>

                                        <div class="col-md-12">

                                            <div class="invoice-summary invoice-summary-input">
                                                <p>Sous total: <span>{{$orders[0]['subtotal']}} DH</span></p>
                                                <p>Tva: <span>{{$orders[0]['tva']}} DH</span></p>
                                                <h5 class="font-weight-bold"> Total: <span>{{$orders[0]['total']}} DH</span></h5>
                                            </div>



                                        </div>

                                    </div>
                                </form>
                                <!--==== / Edit Area =====-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>



@endsection

@section('page-js')

<script src="{{ asset('js/plugins/jquery-3.5.1.min.js') }}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>



@endsection

