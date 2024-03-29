@extends('layouts.master')
@section('page-css')
<link href="{{asset('assets/styles/css/select2.min.css')}}" rel="stylesheet" />
<style>
   button.select2-selection__choice__remove {
    border: none;
    background: no-repeat;
    
   }

</style>
@endsection
@section('main-content')
<div class="breadcrumb">
   <h1>Contact Details</h1>
   <ul>
      <li><a href="">Apps</a></li>
      <li>Contacts</li>
   </ul>
</div>
<div class="separator-breadcrumb border-top"></div>
<!-- content goes here -->
<section class="ul-contact-detail">
   <div class="row">
      <div class="col-lg-12 col-xl-12">
         <!-- begin::basic-tab -->
         <div class="card mb-4 mt-4">
            <div class="card-header bg-transparent">Modifier l'utilisateur</div>
            <div class="card-body">
               <div >
                  <div id="msg"></div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Nom</label>
                     <div class="col-sm-10">
                        <input id="id_user" type="hidden" value="{{ $user['id'] }}">
                        <input id="nom" type="text" class="form-control"  value="{{ $user['nom'] }}" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                     <div class="col-sm-10">
                        <input id="email" type="email" class="form-control" id="inputEmail3" value="{{ $user['email'] }}" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                     <div class="col-sm-10">
                        <input id="password" type="password" class="form-control"  >
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2">Role</div>
                     <div class="col-sm-10">
                        <select id="role_id" class=" form-control" >
                           <option value="" >Selectionner</option>
                           @foreach ($roles as $role)
                           <option value="{{$role->id}}" {{ $user['role'] == $role->name ? 'selected' : '' }} >{{$role->name}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2">projets</div>
                     <div class="col-sm-10">

                        <?php $count =0;   ?>

                        <select id="project_id" multiple="multiple"  class="js-select-project form-control input-product" style="width: 100%" name="product[]" required>
                           <option   value="">Selectionner le produit</option>
                           @foreach ($clients as $client)
                             
                          
                                 
                            <option value="{{$client->id}}" @isset($project[$count]['id']) {{ $client->id == $project[$count]['id'] ? 'selected' : '' }}  @endisset >{{$client->nom}}  </option>
                             
                            <?php $count++;   ?>

                           @endforeach
                     
                        </select>
                   
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-6">
                        <a href="javascript:;"  class="update btn btn-primary">Validé</a>
                        <a href="/users" type="submit" class="btn btn-primary">Annuler</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end::basic-tab -->
      </div>
   </div>
</section>
@endsection
@section('page-js')
<script src="{{ asset('js/plugins/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('js/user_update.js') }}"></script>
@endsection