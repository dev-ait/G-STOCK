@extends('layouts.app_dashbord')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Gérer les produits</h1>
</div>
<link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/css_vue/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/css_vue/vuetify.min.css') }}>
<div class="row">
   <div class="col-md-12">
      <div id="app_product">
         <template>
            <v-row>
               <v-col cols="12" sm="12">
                  <v-card>
                     <v-btn onclick="window.location.href='{{route('product.create')}}'" class="ma-2 mt-2 ml-3" tile color="indigo" dark>Nouveau produit</v-btn>
                     <v-card-title>
                        La liste des produits
                        <v-spacer></v-spacer>
                        <v-text-field  v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                     </v-card-title>
                     <v-col cols="12" class="pl-remove" sm="3" pb="2"  v-if="btn_control">
                        <v-btn class="btn_remove" depressed @click="deleteItem()">
                           <v-icon class="color-icon-remove  ">mdi-delete</v-icon>
                        </v-btn>
                     </v-col>
                     <v-data-table  @input="item($event)" :headers="headers" :items="products" :search="search" :value="selectedRows" v-model="selected" :items-per-page="10"  :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc" show-select   item-key="id"
                        :expanded.sync="expanded" @click:row="clicked">
                        <template v-slot:item.img="{ item }">
                           <img :src="'storage/' + item.photo" style="width: 55px; height: 55px" />
                        </template>
                        <template v-slot:item.action="{ item }">
                           <v-btn color="purple" fab small dark  @click="editItem(item)">
                              <v-icon>mdi-pencil</v-icon>
                           </v-btn>
                        </template>
         </template>
         </v-data-table>
         </v-card>
         </v-col>
         </v-row>
         </template>
      </div>
   </div>
</div>
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
<script src="{{ asset('js/app_product.js') }}"></script>
@endsection