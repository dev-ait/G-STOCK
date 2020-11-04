


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
   <h1>  La liste des Commandes </h1>
</div>
<div class=" border-top"></div>
<div id="app_order" data-app>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header  gradient-purple-indigo  0-hidden pb-80">
               <div class="pt-4">
                  <div class="row">
                     <h4 class="col-md-4 text-white">Commandes</h4>
                     <input v-model="search" type="text" class="form-control form-control-rounded col-md-4 ml-3 mr-3"  append-icon="mdi-magnify" placeholder="Rechercher Commandes ...">
                     <i aria-hidden="true" class="v-icon notranslate btn_search mdi mdi-magnify theme--light"></i>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="ul-contact-list-body">
                  <div class="ul-contact-main-content">
                     <div class="ul-contact-left-side">
                        <div class="card">
                           <div class="card-body">
                              <div class="ul-contact-list">
                                 <div class="contact-close-mobile-icon float-right mb-2">
                                    <i class="i-Close-Window text-15 font-weight-600"></i>
                                 </div>
                                 <!-- modal  -->
                                 <button class="btn btn-outline-secondary btn-block mb-4" >
                                 Parametres
                                 </button>
                           
                                 <!-- end:modal  -->
                                 <div class="list-group" id="list-tab" role="tablist">
                                   
                                    <a  @click="remove_item" class="list-group-item list-group-item-action border-0" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings" aria-selected="false">
                                    <i class="nav-icon i-Remove"></i>
                                    Supprimer</a>
                                    <label for="" class="text-muted font-weight-600 py-8">MEMBERS</label>
                                    <a class="list-group-item list-group-item-action border-0 " id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                    <i class="nav-icon i-Arrow-Next"></i>
                                    Contact List</a>
                                    <a class="list-group-item list-group-item-action border-0 active show" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile" aria-selected="true">
                                    <i class="nav-icon i-Arrow-Next"></i>
                                    Conected</a>
                                    <a class="list-group-item list-group-item-action border-0" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings" aria-selected="false">
                                    <i class="nav-icon i-Arrow-Next"></i>
                                    Settings</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="ul-contact-content">
                        <div class="card">
                           <v-card>
                              <v-card-title>
                                 la liste des Commandes                                 <v-spacer></v-spacer>
                              </v-card-title>
                              <v-data-table  @input="item($event)" :headers="headers" :items="orders" :search="search" :value="selectedRows" v-model="selected" :items-per-page="10"  :sort-by.sync="sortBy"
                              :sort-desc.sync="sortDesc" show-select   item-key="id"
                              :expanded.sync="expanded" @click:row="clicked">

                              <template v-slot:item.print="{ item }">

                                 <v-btn  class="mx-1"  small  fab dark color="purple" @click="print(item)">
                                    <v-icon dark>mdi-printer</v-icon>
                                  </v-btn>

                              </template>


                              <template v-slot:item.validate ="{ item }">



                                  <v-btn
                                  depressed
                                  color="purple"   small   dark  @click="valide_commande(item)"
                                >
                                  Validé
                                </v-btn>

                              </template>


                              <template v-slot:item.action="{ item }" >
                              
                                 
                                 <v-btn align-center  class="mx-0"  small  fab dark color="teal" @click="show_order_product(item)">
                                    <v-icon dark>mdi-format-list-bulleted-square</v-icon>
                                  </v-btn>
                                 
                              
                                 <v-dialog v-model="dialog" max-width="500px">
                                    <v-card>
                                       <v-card-title>
                                          <span class="headline">Les produits commandes</span>
                                       </v-card-title>
                              
                                       <v-data-table :headers="subHeaders"
                                       :items="product_order"
                                       item-key="color"
                                       hide-actions
                                       class="elevation-10">
                              
                                            </v-data-table>
                              
                                       </v-card-title>
                                       <v-card-actions>
                                          <v-spacer></v-spacer>
                                          <v-btn color="blue darken-1" text @click="close">Annuler</v-btn>
                                     
                                       </v-card-actions>
                                    </v-card>
                                 </v-dialog>
                              </template>
                              
                              
                              </template>
                              </v-data-table>
                              
                           </v-card>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('page-js')
<script src="{{ asset('js/plugins/vue.js') }}"></script>
<script src="{{ asset('js/plugins/vee-validate.js') }}"></script>
<script src="{{ asset('js/plugins/axios.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2@9.js') }}"></script>
<script src="{{ asset('js/plugins/vuetify.js') }}"></script>
<script>
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}
</script>
<script src="{{ asset('js/app_order.js') }}"></script>
@endsection


