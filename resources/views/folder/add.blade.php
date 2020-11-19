@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<!-- include Vue 2.x -->
<script src="https://cdn.jsdelivr.net/npm/vue@^2"></script>
<!-- include vue-treeselect & its styles. you can change the version tag to better suit your needs. -->
<script src="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.min.css">
<div class="breadcrumb">
   <h1>  Gestion des fichiers </h1>
</div>
<div id="app_folder" data-app>
   <div class="row">
      <div class="col-md-12">
         <v-card
            class="mx-auto"
            >
         <v-sheet class="pa-4 p-3 primary lighten-2">
            <div class="row">
               <div class="col-md-6">
                  <div class="my-4 subtitle-1 white--text">
                     Ajouter Fichiers
                  </div>
                  <v-text-field
                     v-model="name_folder"
                     label="Nom de Fichiers"
                     dark
                     flat
                     solo-inverted
                     hide-details
                     clearable
                     clear-icon="mdi-close-circle-outline"
                     ></v-text-field>
                  <treeselect 
                     class="mt-3"
                     v-model="select_item"
                     :multiple="false" 
                     :options="items"
                     :load-options="loadOptions" />
                  </treeselect>
                  <v-switch
                     color="primary"
                     label="joindre fichier"
                     value=""
                     persistent-hint
                     ></v-switch>
                  <template>
                     <v-file-input
                        v-model="files"
                        color="deep-purple accent-4"
                        counter
                        label="File input"
                        multiple
                        placeholder="Select your files"
                        prepend-icon="mdi-paperclip"
                        outlined
                        :show-size="1000"
                        >
                        <template v-slot:selection="{ index, text }">
                           <v-chip
                              v-if="index < 2"
                              color="deep-purple accent-4"
                              dark
                              label
                              small
                              >
                              @{{ text }}
                           </v-chip>
                           <span
                              v-else-if="index === 2"
                              class="overline grey--text text--darken-3 mx-2"
                              >
                           +@{{ files.length - 2 }} File(s)
                           </span>
                        </template>
                     </v-file-input>
                  </template>
                  <v-btn
                     class="ma-2 mt-3"
                     :loading="loading2"
                     :disabled="loading2"
                     color="success"
                     @click="add_item"
                     >
                     Ajouter
                  </v-btn>
               </div>
            </div>
         </v-sheet>
         <template>
            <v-card>
               <v-toolbar
                  color="cyan"
                  dark
                  flat
                  >
                  <template v-slot:extension>
                     <v-tabs
                        v-model="tab"
                        align-with-title
                        >
                        <v-tabs-slider color="yellow"></v-tabs-slider>
                        <v-tab
                           v-for="item_tab in item_tabs"
                           :key="item_tab"
                           >
                           @{{ item_tab }}
                        </v-tab>
                     </v-tabs>
                  </template>
               </v-toolbar>
               <v-tabs-items v-model="tab">
                  <v-tab-item
                     v-for="item_tab in item_tabs"
                     :key="item_tab"
                     >
                     <v-card flat>
                        <v-card-text v-text="text"></v-card-text>
                     </v-card>
                  </v-tab-item>
               </v-tabs-items>
            </v-card>
         </template>
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
<script src="{{ asset('js/plugins/select_free.js') }}"></script>
<script>
   window.laravel ={!! json_encode([
     'token' => csrf_token(),
     'url'   => url('/'),
     'date'   => date('Y-m-d'),
   
   
   ]) !!}
</script>
<script src="{{ asset('js/add_file_parent.js') }}"></script>
<script src="{{ asset('js/select_free.js') }}"></script>
@endsection