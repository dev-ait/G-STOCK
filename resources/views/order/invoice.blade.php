@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
<link href="{{asset('assets/styles/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('main-content')
    <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab"
                                aria-controls="invoice" aria-selected="true">Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit"
                                aria-selected="false">Edit</a>
                        </li>

                    </ul>
                    <div class="card">

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                <div class="d-sm-flex mb-5" data-view="print">
                                    <span class="m-auto"></span>
                                    <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Imprimer la facture</button>
                                </div>
                                @if ($orders[0]['status'] == "1" )

                                <div class="d-sm-flex mb-5" >
                                 <span class="m-auto"></span>
                                 <button class="btn btn-primary mb-sm-0 mb-3 mr-3 valide_order " data-key="valider" >Valider la commande</button>
                                 <button class="btn btn-primary mb-sm-0 mb-3 reject_order " data-key="reject">Refuser la commande</button>
                              </div>
                                  
                              @endif
                                <!---===== Print Area =======-->
                                <div id="print-area">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <h4 class="font-weight-bold">Informations de commande</h4>
                                          <p>#{{$orders[0]['id']}}</p>
                                       </div>
                                       <div class="col-md-6 text-sm-right">
                                         
                                          <p><strong>Date de commande: </strong> </p>
                                          <p>{{$orders[0]['created_at']}}</p>
                                       </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row mb-5">
                                       <div class="col-md-6 mb-3 mb-sm-0">
                                          <h5 class="font-weight-bold">site D'affectation</h5>
                                          <p>{{$orders[0]['nom_site']}}</p>
                                       </div>
                                   
                                    </div>
                                    <div class="row">
                                       <?php $count =1 ;?>
                                     
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
                                     
                                          </div>
                                     
                                    </div>
                                </div>
                                <!--==== / Print Area =====-->
                            </div>
                            
                            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                              <!--==== Edit Area =====-->
                              <form action="{{ url('update_order')}}" method="POST" id="FormOrder" onsubmit="return validateForm();" >
                                 {{ csrf_field() }}
                              <div class="d-flex mb-5">
                                 <span class="m-auto"></span>
                                 <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <h4 class="font-weight-bold">Informations de commande</h4>
                                    <div class="col-sm-4 form-group mb-3 pl-0">
                                       <label for="orderNo">Numero de commande</label>
                                       <input type="text" class="form-control"  
                                          id="orderNo" placeholder="Enter order number" value=" {{$orders[0]['id']}}" disabled>
                                          <input id='id_order' type="hidden" name="id_order"  value="{{$orders[0]['id']}}">
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
                                          @foreach ($sites as $site)
                                          <option  value="{{$site->id}}"  @isset($orders[0]['site']) {{ $site->id == $orders[0]['site_id'] ? 'selected' : '' }} @endisset  >{{$site->nom}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                       
                              </div>
                              <div class="row">
                                 <div class="col-md-12 table-responsive">
                                    <table id="table_product" class="table table-hover mb-3">
                                       <thead class="bg-gray-300">
                                          <tr>
                                             <th scope="col">Nom produit</th>
                                             <th scope="col">Prix</th>
                                             <th scope="col">Quantite</th>
                                             <th scope="col">Total</th>
                                             <th scope="col"></th>
                                          </tr>
                                       </thead>
                                       <?php $count_edit =1 ;?>
                                       @foreach ($orders[0]['product_order'] as $product_order)
                                       <tr id='row{{$count_edit}}'>
                                          <td>{{$product_order['nom_produit']}}
                                             <input type="hidden"  name="product[]"  value="{{$product_order['nom_produit']}}"  >
                                          </td>
                                          <td>
                                             <div class="d-flex ">
                                                <div id="price{{$count_edit}}"> {{$product_order['prix']}} </div>
                                                <span class="text-muted pl-1">DH</span>
                                                <input type="hidden"  name="rate[]"  value="{{$product_order['prix']}}"  >
                                             </div>
                                          </td>
                                          <td> {{$product_order['quantite']}}
                                             <input type="hidden"  name="quantite[]" id="quantite{{$count_edit}}"  value="{{$product_order['quantite']}}" >
                                          </td>
                                          <td>
                                             <div class="d-flex ">
                                                <div id="total_product{{$count_edit}}"> {{$product_order['total']}}  </div>
                                                <span class="text-muted pl-1">DH</span>
                                                <input type="hidden" id="total_productValue{{$count_edit}}"  name="totalp[]"  value="{{$product_order['total']}}" >
                                             </div>
                                          </td>
                                          <td>
                                             <button class="btn btn-outline-secondary float-right" onClick="removeRow(event,{{$count_edit}})">Supprimer</button>
                                          </td>
                                       </tr>
                                       <?php $count_edit   ++ ;?>
                                       @endforeach
                                       </tbody>
                                    </table>
                                    <button class="btn btn-primary float-right mb-4 btn-add">Ajouter un produit</button>
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
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
<script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
<script src="{{ asset('js/update_order.js') }}"></script>
@endsection
@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>
@endsection
