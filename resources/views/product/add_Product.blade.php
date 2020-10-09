@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_style.css') }}>
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/dropzone.min.css')); ?>">
@endsection
@section('main-content')
<div class="breadcrumb">
   <h1>  Ajouter un produit</h1>
</div>
<div id="msg"></div>
<div class=" border-top"></div>

   <div class="card mt-3">
      <!--begin::form-->
      <div class="card-header bg-transparent">
         <p class="submit_mandatory ">* Le champ Description ne pas obligatoire </p>
      </div>
     
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Description de produit</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">Titre*</label>
                     <input id="titre" type="text"  name="titre" class="form-control input-product"  >
                     <small  class="ul-form__text form-text ">
                     Please enter your full name
                     </small>
                  </div>
                  <div class="form-group col-md-12 pb-3">
                     <div id="full-editor">
            
                     </div>
                  </div>
                  <div class="col-md-12 mt-4">
                     <div class="half-form pr-3">
                        <label for="quantite" class="label-p">Quantite* </label>
                        <input  type="number" id="quantite" class="form-control input-product">
                        <small  class="ul-form__text form-text ">
                        Please enter your full name
                        </small>
                     </div>
                     <div class="half-form pl-3">
                        <label for="taux" class="label-p">Prix* </label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text">$</span>
                           </div>
                           <input type="number" step="0.01" id="prix" class="form-control input-product" >
                           <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                           </div>
                        </div>
                        <small  class="ul-form__text form-text ">
                        Please enter your full name
                        </small>
                     </div>
                  </div>
                  <div class="col-md-12 pt-3">
                     <label for="statut" class="label-p">Statut* </label>
                     <select id="statut" class="form-control input-product">
                        <option value="Disponible">Disponible</option>
                        <option value="Non Disponible">Non Disponible</option>
                     </select>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end::form 3-->
   </div>
   <div class="card mt-3">
      <!--begin::form-->
      <div class="card-body row">
         <div class="col-md-2">  <label for="name" class="product-label text-dark">Gategorie de produit</label> </div>
         <div class="col-md-10">
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="title" class="label-p">Gategorie* </label>
                  <select id="gategorie" class=" form-control input-product">
                     @foreach($gategories as $gategorie)   
                     <option value="{{$gategorie->id}} ">{{$gategorie->nom}} </option>
                     @endforeach 
                  </select>
               </div>
            </div>
         </div>
      </div>
      <!-- end::form 3-->
   </div>
   <div class="card mt-3">
      <!--begin::form-->
      <div class="card-body row">
         <div class="col-md-2"> <label for="name" class="product-label text-dark">Marque de produit</label> </div>
         <div class="col-md-10">
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="title" class="label-p">Marque* </label>
                  <select id="marque" class="js-single form-control input-product">
                     @foreach($marques as $marque)   
                     <option value="{{$marque->id}} ">{{$marque->nom}} </option>
                     @endforeach 
                  </select>
               </div>
            </div>
         </div>
      </div>
      <!-- end::form 3-->
   </div>
   <div class="card mt-3">
      <div class="card-body row">
         <div class="col-md-2"> <label for="name" class="product-label text-dark">Image de produit</label> </div>
         <div class="col-md-10">
            <div class="form-row">
               <div class="form-group col-md-12">
                  <div class="col-md-6 mb-4">
                     <form action="{{ url('product/store_img')}}" method="POST" enctype="multipart/form-data" id="mydropzone" class="dropzone" >
                        {{ csrf_field() }}
                        <div class="dz-default dz-message">
                           <h3 class="sbold">Déposer des fichiers ici pour télécharger</h3>
                           <span>Vous pouvez également cliquer pour ouvrir le navigateur de fichiers</span>
                          
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>

                    
                     <!-- You can add extra form fields here -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card-footer">
         <div class="mc-footer">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <button  type="submit" id="submit-all" class="btn  btn-primary m-1">Save</button>
                  <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
               </div>
            </div>
         </div>
      </div>
      <!-- end::form 3-->
   </div>


@endsection
@section('page-js')
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="<?php echo e(asset('assets/js/vendor/quill.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/vendor/dropzone.min.js')); ?>"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
<script src="{{ asset('js/product_add.js') }}"></script>


@endsection

@section('bottom-js')

<script src="{{asset('assets/js/quill.script.js')}}"></script>


@endsection