@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
<div class="breadcrumb">
   <h1>Lists</h1>
   <ul>
      <li><a href="">Tables</a></li>
      <li>Utilisateurs</li>
   </ul>
</div>
<div class="separator-breadcrumb border-top"></div>
@include('layouts.common.flash_message_user')
<section class="contact-list">
   <div class="row">
      <div class="col-md-12 mb-4">
         <div class="card text-left">
            <div class="card-header text-right bg-transparent">
               <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-primary btn-md m-1"><i class="i-Add-User text-white mr-2"></i>    Ajouter utilisateur</button>
            </div>
            <!-- begin::modal -->
            <div class="ul-card-list__modal">
               <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="modal-body">
                           <form  >
                              <div id="msg"> </div>
                              <div class="form-group row">
                                 <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                                 <div class="col-sm-10">
                                    <input id="nom" type="text" class="form-control"  placeholder="Nom" >
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                 <div class="col-sm-10">
                                    <input id="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" >
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                 <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control"  placeholder="" >
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-2">Role</div>
                                 <div class="col-sm-10">
                                    <select id="role_id" class=" form-control" >
                                       <option value="" >Selectionner</option>
                                       @foreach ($roles as $role)
                                       <option value="{{$role->id}}"  >{{$role->name}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-10">
                                    <a id="submit-all"  class="btn btn-success">Créer</a>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end::modal -->
            <div class="card-body">
               <div class="table-responsive">
                  <table id="ul-contact-list" class="display table " style="width:100%">
                     <thead>
                        <tr>
                           <th>id</th>
                           <th>Nom</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th>Date de creation</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($users as $user)
                        <tr>
                           <td>  {{$user->id}}  </td>
                           <td>
                              <a href="">
                                 <div class="ul-widget-app__profile-pic">
                                    <img class="profile-picture avatar-sm mb-2 rounded-circle img-fluid" src="{{ asset('assets/images/faces/1.jpg') }}" alt="">
                                    {{$user->name}}
                                 </div>
                              </a>
                           </td>
                           <td>  {{$user->email}} </td>
                           <td>
                              <?php foreach($user->roles as $role){  ?>
                              <a href="#" class="badge badge-primary  m-2 p-2"  style="background-color: {{ $role->color }};"> 
                              <?php  echo $role->name ;  ?>        
                              </a> 
                              <?php break; } ?>
                           </td>
                           <td>April 25, 2019</td>
                           <td>
                              <a href="/user/{{$user->id}}/edit" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Edit">
                              <i class="i-Edit"></i>
                              </a>
                              <input id="id_user" type="hidden" value="{{$user->id}}">
                              <a href="javascript:;"  class="delete ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Want To Delete !!!">
                              <i class="i-Eraser-2"></i>
                              </a>  
                              <input id="id_user" type="hidden" value="{{$user->id}}">
                           </td>
                        </tr>
                        @endforeach                            
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@section('page-js')
<script src="{{ asset('js/plugins/jquery-3.5.1.min.js') }}"></script> 
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<!-- page script -->
<script src="{{ asset('assets/js/tooltip.script.js') }}"></script>
<script src="{{ asset('js/user_add.js') }}"></script>
<script>
   $('#ul-contact-list').DataTable( {
           "order": [[ 0, "desc" ]]
       } );
   
</script>
@endsection