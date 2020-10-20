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


<style>
   .dropzone .dz-preview .dz-image img {
    width: 150px;
    height: 150px;
    }
    .dz-max-files-reached {
    pointer-events: none ;
    cursor: default;
       }
</style>

   <div class="card mt-3">
      <!--begin::form-->
      <div class="card-header bg-transparent">
         <p class="submit_mandatory ">* Le champ Description ne pas obligatoire </p>
      </div>

   <input type="hidden" value="{{ $product['id'] }}" id="id">
     
      <div class="card-body">
         <div class="row">
            <div class="col-md-2"> <label for="name" class="product-label text-dark">Description de produit</label></div>
            <div class="col-md-10">
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputtext11" class="ul-form__label">Titre*</label>
                     <input value='{{  $product['titre'] }}' id="titre" type="text"  name="titre" class="form-control input-product"  >
                     <small  class="ul-form__text form-text ">
                     Please enter your full name
                     </small>
                  </div>
                  @isset($modeles)
                  <div id="modele" class="form-group col-md-12 ">
                     <label for="inputtext11" class="ul-form__label">Modele de produit</label>
                     <select id="modele_id" class="form-control "  id="type_modele">
      
                        @foreach($modeles as $modele)   
                        <option value="{{$modele->id}} " {{ $product['modele_id']  == $modele->id ? 'non_disponible' : '' }}>{{$modele->nom}} </option>
                        @endforeach 
                     </select>
                  </div>
                  @endisset
                  <div class="form-group col-md-12 pb-5">
                     <label for="inputtext11" class="ul-form__label">Description</label>
                     <div id="full-editor">
            
                     </div>
          
                  </div>
                  <div class="col-md-12 mt-5">
                     <div class="half-form pr-3">
                        <label for="quantite" class="label-p">Quantite* </label>
                        <input value="{{  $product['quantite'] }}"  type="number" id="quantite" class="form-control input-product">
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
                           <input value="{{  $product['prix'] }}" type="number" step="0.01" id="prix" class="form-control input-product" >
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
                        <option value="Disponible" {{ $product['statut'] == 'Disponible' ? 'selected' : '' }} >Disponible</option>
                  <option value="Non Disponible" {{ $product['statut'] == 'Non Disponible' ? 'non_disponible' : '' }}>Non Disponible</option>
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
                     <option value="{{$gategorie->id}} " {{ $product['gategorie_id']  == $gategorie->id ? 'non_disponible' : '' }}>{{$gategorie->nom}} </option>
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
                     <option value="{{$marque->id}} " {{ $product['marque_id']  == $marque->id ? 'non_disponible' : '' }}>{{$marque->nom}} </option>
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
                  <button onclick="clickbtn(this)"  type="submit" id="submit-all" class="btn  btn-primary m-1">Save</button>
                  <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
               </div>
            </div>
         </div>
      </div>
      <!-- end::form 3-->
   </div>


@endsection
@section('page-js')
<script>

   window.img ={!! json_encode([
     'id' => csrf_token(),
     'url'=>  url('/'),
     'photo_nom'   => $product['photo_nom'],
     'photo_id'   => $product['photo_id'],
   ]) !!}

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="<?php echo e(asset('assets/js/vendor/quill.min.js')); ?>"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>
<script src="<?php echo e(asset('assets/js/vendor/dropzone.min.js')); ?>"></script>
<script src="{{ asset('js/dropezone_add.js') }}"></script>
<script src="{{ asset('js/product_update.js') }}"></script>

<script>
 quill.clipboard.dangerouslyPasteHTML(1, {!! json_encode($product['description']) !!} );
</script>


@endsection

