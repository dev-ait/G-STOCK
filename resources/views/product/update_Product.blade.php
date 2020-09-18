@extends('layouts.app_dashbord')
@section('content')
<script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
<script src="{{ asset('css/style_uploud.css') }}"></script>
<div class="d-sm-flex align-items-center justify-content-between mb-2">
   <div class="row">
      <div class="col-md-12">
         <h1 class="h3 mb-0 text-gray-800">Modifier le produit</h1>
      </div>
   </div>
</div>
<form  action="/product/{{$product->id}}" method="POST" enctype="multipart/form-data">
   <input type="hidden" name='_method' value="PUT">
   {{ csrf_field() }}
   <div class="row" >
      <div class="col-md-12 card mb-4 py-3 border-left-secondary  ">
         <div class="row  pb-3">
            <div class="col-md-4">
               <label for="name" class="product-label text-dark">Description de produit</label>
            </div>
            <div class="col-md-8 row ">
               <div class="col-md-12">
                  <label for="titre" class="label-p">Titre* </label>
                  <input type="text" value='{{  $product->titre }}'  name="titre" class="form-control input-product"  >
               </div>
               <div class="col-md-12 pt-3">
                  <label for="description"  class="label-p">La description</label>
                  <textarea name="description"  class="form-control">{{  $product->description }}</textarea>
               </div>
               <div class="col-md-12 pt-3">
                  <div class="half-form pr-3">
                     <label for="quantite" class="label-p">Quantite* </label>
                     <input type="number" value="{{  $product->quantite }}"  name="quantite" class="form-control input-product">
                  </div>
                  <div class="half-form pl-3">
                     <label for="taux" class="label-p">Taux* </label>
                     <input type="number" value="{{  $product->taux }}" name="taux" class="form-control input-product" >
                  </div>
               </div>
               <div class="col-md-12 pt-3">
                  <label for="prix" class="label-p">Prix* </label>
                  <input type="number" value="{{  $product->prix }}" name="prix" class="form-control input-product" >
               </div>
               <div class="col-md-12 pt-3">
                  <label for="statut" class="label-p">Statut* </label>
                  <select name="statut" class="form-control input-product">
                  <option value="Disponible" {{ $product->statut == 'Disponible' ? 'selected' : '' }} >Disponible</option>
                  <option value="Non Disponible" {{ $product->statut == 'Non Disponible' ? 'non_disponible' : '' }}>Non Disponible</option>
                  </select>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 card mb-4 py-3 border-left-secondary  ">
         <div class="row pt-2 pb-3">
            <div class="col-md-4">
               <label for="name" class="product-label text-dark">Gategorie de produit</label>
            </div>
            <div class="col-md-8 row ">
               <div class="col-md-12">
                  <label for="title" class="label-p">Gategorie* </label>
                  <select name="gategorie" class="form-control input-product">
                  @foreach($gategories as $gategorie)   
                  <option value="{{$gategorie->id}} " {{ $product->gategorie_id == $gategorie->id ? 'non_disponible' : '' }}>{{$gategorie->nom}} </option>
                  @endforeach 
                  </select>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 card mb-4 py-3 border-left-secondary  ">
         <div class="row pt-2 pb-3">
            <div class="col-md-4">
               <label for="name" class="product-label text-dark">Marque de produit</label>
            </div>
            <div class="col-md-8 row ">
               <div class="col-md-12">
                  <label for="title" class="label-p">Marque* </label>
                  <select name="marque" class="form-control input-product">
                  @foreach($marques as $marque)   
                  <option value="{{$marque->id}} " {{ $product->marque_id == $marque->id ? 'non_disponible' : '' }}>{{$marque->nom}} </option>
                  @endforeach 
                  </select>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 card mb-4 py-3 border-left-secondary  ">
         <div class="row pt-2 pb-3">
            <div class="col-md-4">
               <label for="name" class="product-label text-dark">Photo de produit</label>
            </div>
            <div class="col-md-8 row ">
               <div class="col-md-12">
                  <div id="form1" >
                     <div id='img_contain'><img class="img-thumbnail" id="blah"  src="{{ asset('storage/'.$product->photo) }}" alt="your image" title=''/></div>
                     <div class="input-group">
                        <div class="custom-file">
                           <input type="file" name="photo" id="inputGroupFile01" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                           <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 ">
         <div class="text-center pb-5">
            <button type="submit" class="btn btn-primary mr-3 btn-product">Sauvgarder</button>
            <button type="submit" class="btn btn-primary btn-product">Annuler</button>
         </div>
      </div>
      <script src="{{ asset('js/uploud.js') }}"></script>
   </div>
</form>
</div>
@endsection