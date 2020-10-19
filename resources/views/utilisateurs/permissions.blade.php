<?php 
   foreach ($roles as $role){
   
   $json_permissions = json_encode($role->permissions, true);
   
   $permissions[]  = array('role_slug' => $role->slug , $role->slug => json_decode( $json_permissions,true) , 'role_nom' => $role->name );   ;
   
   }


 
   

   
   


   
   ?>

   @section('page-css')
   <link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
   @endsection

@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<style>
   .theme--light .teal {
   background-color: #009688!important;
   border-color: #009688!important;
   }
</style>
<div class="breadcrumb">
   <h1>  Assigner Permission </h1>
</div>
<div class=" border-top"></div>
<style>
   table.blueTable {
   border: 1px solid #1C6EA4;
   background-color: #EEEEEE;
   width: 100%;
   text-align: left;
   border-collapse: collapse;
   }
   table.blueTable td, table.blueTable th {
   border: 1px solid #AAAAAA;
   padding: 3px 2px;
   }
   table.blueTable tbody td {
   font-size: 13px;
   }
   table.blueTable tr:nth-child(even) {
   background: #D0E4F5;
   }    
   table.blueTable thead {
   background: #1C6EA4;
   background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
   background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
   background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
   border-bottom: 2px solid #444444;
   }
   table.blueTable thead th {
   font-size: 15px;
   font-weight: bold;
   color: #FFFFFF;
   border-left: 2px solid #D0E4F5;
   }
   table.blueTable thead th:first-child {
   border-left: none;
   }
   table.blueTable tfoot {
   font-size: 14px;
   font-weight: bold;
   color: #FFFFFF;
   background: #D0E4F5;
   background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
   background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
   background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
   border-top: 2px solid #444444;
   }
   table.blueTable tfoot td {
   font-size: 14px;
   }
   table.blueTable tfoot .links {
   text-align: right;
   }
   table.blueTable tfoot .links a{
   display: inline-block;
   background: #1C6EA4;
   color: #FFFFFF;
   padding: 2px 8px;
   border-radius: 5px;
   }
   .text-center{
   text-align: center;
   }
   .checkbox, .radio {
   display: initial !important;
   }
   .checkbox_pos {
   MARGIN-TOP: 5PX;
   MARGIN-BOTTOM: -12PX;
   }
</style>
<body>
   <table class="blueTable">
      <thead>
         <tr>
            <th><div class="pl-1">Role</div></th>
            <th><div class="pl-1"> Page </div></th>
            <th class="text-center">Créer</th>
            <th class="text-center">Accéder a la page</th>
            <th class="text-center">Modifier</th>
            <th class="text-center">Supprimer</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($permissions as $permission)
          @foreach ($menu as $menu_page)
         
         
         <tr>
            <td><div class="pl-1"> {{$permission["role_nom"]}}</div></td>
            <td><div class="pl-1"> <strong>{{$menu_page->nom}}</strong> </div></td>
            <td class="text-center">
               <div class="checkbox_pos">
                  <label class="checkbox checkbox-outline-primary">
                  <input type="checkbox" class="role-permission" data-page="{{$menu_page->nom}}" data-key="create" data-role="{{$permission["role_slug"]}}" @isset($permission[$permission["role_slug"]][$menu_page->nom.".create"])  @if ($permission[$permission["role_slug"]][$menu_page->nom.".create"]) checked  @endif @endisset >
                  <span class="checkmark"></span>
                  </label>
               </div>
               <br>
            </td>
            <td class="text-center">
               <div class="checkbox_pos">
                  <label class="checkbox checkbox-outline-primary">
                  <input type="checkbox" class="role-permission" data-page="{{$menu_page->nom}}" data-key="read" data-role="{{$permission["role_slug"]}}" @isset($permission[$permission["role_slug"]][$menu_page->nom.".read"]) @if ($permission[$permission["role_slug"]][$menu_page->nom.".read"]) checked  @endif @endisset    >
                  <span class="checkmark"></span>
                  </label>
               </div>
               <br>
            </td>
            <td class="text-center">
               <div class="checkbox_pos">
                  <label class="checkbox checkbox-outline-primary">
                  <input type="checkbox" class="role-permission" data-page="{{$menu_page->nom}}" data-key="update" data-role="{{$permission["role_slug"]}}" @isset($permission[$permission["role_slug"]][$menu_page->nom.".update"]) @if ($permission[$permission["role_slug"]][$menu_page->nom.".update"]) checked  @endif @endisset >
                  <span class="checkmark"></span>
                  </label>
               </div>
               <br>
            </td>
            <td class="text-center">
               <div class="checkbox_pos">
                  <label class="checkbox checkbox-outline-primary">
                  <input type="checkbox" class="role-permission" data-page="{{$menu_page->nom}}" data-key="delete" data-role="{{$permission["role_slug"]}}" @isset($permission[$permission["role_slug"]][$menu_page->nom.".delete"]) @if ($permission[$permission["role_slug"]][$menu_page->nom.".delete"]) checked  @endif @endisset >
                  <span class="checkmark"></span>
                  </label>
               </div>
               <br>
            </td>
         </tr>

          @endforeach
         @endforeach
        
    
         <tr>
      </tbody>
   </table>

   @include('utilisateurs.script_permission');
  
   
   @endsection
   @section('page-js')
   <script>
      window.laravel ={!! json_encode([
        'token' => csrf_token(),
        'url'   => url('/'),
        'date'   => date('Y-m-d'),
      
      
      ]) !!}
   </script>
   <script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
   @endsection