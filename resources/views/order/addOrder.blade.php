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
                    
                    <th scope="col">Quantity</th>
                    <th scope="col">Site</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id='row1'>
                    <td scope="row" class="row_p">
                      <select  id="productName1" onchange="getProductData(1)" class="js-example-basic-single form-control input-product" style="width: 100%" name="product[]" required>
                        <option   value="">Selectionner le produit</option>
                        @foreach ($products as $product)
                        <option  value="{{$product->id}}">{{$product->designation}}</option>
                        @endforeach
                     </select>
                    </td>
                  
                    <td>
                       <input type="number" onclick="calcul_total(1)" value="0" id="quantite1" name="quantite[]" class="form-control input_or" required>
                      
                    </td>
                    <td>
                    <select id="valueclient" onchange="getphone()" class="select-js-client form-control input-product" style="width: 100%" name="idclient" required>
                     <option class="select2-results__group"  value="">Selectionner le Site</option>
                     @foreach ($clients as $client)
                      <option  value="{{$client['id']}}">{{$client['name']}}</option>
                     @endforeach
                  </select>
                 
                     </td>
                    <td>
                      <a href="" onClick="removeRow(event,1)" ><i class="i-Close-Window text-19 text-danger font-weight-700 prevent-default"></i></a>
                    
                    </td>
                  </tr>
                </tbody>
              </table>
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
                <div class="card-title">Les informations Supplémentaire de Commandes </div>

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