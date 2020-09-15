@extends('layouts.app_dashbord') @section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/css_vue/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/css_vue/vuetify.min.css') }}>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Commande</h1>
</div>
<div class="row">
   <div class="col-md-12">

         <!-- Panel order -->
         <div class="card shadow mb-4 p-0">
           <div class="card-header py-3">
             <h6 class="m-0 titre-panel">Ajouter un commande</h6>
           </div>
           <div class="card-body">
              <div class="row">
               <div class="col-md-12">
                  <label for="titre" class="label-p">Date de commande  </label>
                  <input type="date" name="titre" class="form-control input-product">
               </div>
               <div class="col-md-12 pt-3">
                  <div class="half-form pr-3">
                     <label for="quantite" class="label-p">Nom de client </label>
                     <input type="text" name="quantite" class="form-control input-product">
                  </div>
                  <div class="half-form pl-3">
                     <label for="taux" class="label-p">Numero Telephone de client </label>
                     <input type="text" name="taux" class="form-control input-product">
                  </div>
               </div>

              </div>
       
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

@endsection