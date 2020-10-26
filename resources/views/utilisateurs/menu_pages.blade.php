@extends('layouts.master')
@section('page-css')
@endsection
@section('main-content')
<div class="breadcrumb">
   <h1>Menu des pages</h1>

</div>
<div class="separator-breadcrumb border-top"></div>

@include('layouts.common.flash_message_menu')
<!-- begin::modal -->
<div class="ul-card-list__modal">
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-body">
               <form   action="{{ url('postmenu')}}" method="POST" >
                  {{ csrf_field() }}
                  <div id="msg"> </div>

                  <div class="form-group row">
                     <label for="inputName"  class="col-sm-2 col-form-label" >Nom</label>
                     <div class="col-sm-10">
                        <input name='nom' type="text" class="form-control"  placeholder="Nom" required>
                     </div>
                  </div>
              
                 
                  <div class="form-group row">
                     <div class="col-sm-10">
                        <button  type="submit"  class="btn btn-success">Créer</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end::modal -->
<!-- content goes here -->
<section class="ul-contact-detail">
   <div class="row">
      <div class="col-md-12">
          <div class="card o-hidden mb-4">
              <div class="card-header d-flex align-items-center border-0">
                  <h3 class="w-50 float-left card-title m-0">Nouveau Page</h3>
                  <div class="dropdown dropleft text-right w-50 float-right ">
                      <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <i class="nav-icon i-Gear-2"></i>
                      </button>
                      <div class="dropdown-menu " aria-labelledby="dropdownMenuButton1" x-placement="left-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(93px, 0px, 0px);">
                          <a href ='' class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-lg">Ajouter une page </a>
             
                      </div>
                  </div>
              </div>

              <div class="">
                  <div class="table-responsive">
                      <table id="user_table" class="table  text-center">
                          <thead>
                            
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Nom</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                           @foreach ($menu_pages as $menu_page)
                                 
                           
                              <tr>
                              <th scope="row">{{$menu_page->id}}</th>
                                  <td>{{$menu_page->nom}}</td>
                  
                               
                                  <td>
                                    <form id="delete"  action="{{ url('/deletemodele/'.$menu_page->id)}}" method="POST" >
                                       {{ csrf_field() }}
                                      <a href="javascript:;" onclick="document.getElementById('delete').submit();" class="text-danger mr-2">
                                          <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                      </a>
                                    </form>
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


@endsection