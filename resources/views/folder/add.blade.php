@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
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
          <v-text-field
            v-model="search"
            label="Search Company Directory"
            dark
            flat
            solo-inverted
            hide-details
            clearable
            clear-icon="mdi-close-circle-outline"
          ></v-text-field>


          
        <div class="row">
          <div class="col-md-6">
            <div class="my-4 subtitle-1 white--text">
             Ajouter Fichiers
            </div>
            <v-text-field
            v-model="search"
            label="Nom de Fichiers"
            dark
            flat
            solo-inverted
            hide-details
            clearable
            clear-icon="mdi-close-circle-outline"
          ></v-text-field>
          <v-btn
          class="ma-2 mt-3"
          :loading="loading2"
          :disabled="loading2"
          color="success"
          @click="loader = 'loading2'"
        >
          Ajouter
          <template v-slot:loader>
            <span>Loading...</span>
          </template>
        </v-btn>
          </div>
        </div>
     
        </v-sheet>

        
        <v-tabs
        v-model="tab"
        background-color="transparent"
        color="basil"
        grow
      >
        <v-tab
          v-for="item in items"
          :key="item"
        >
        <v-tabs
        v-model="tab"
        background-color="transparent"
        color="basil"
        grow
      >
        <v-tab
          v-for="item_tab in item_tabs"
          :key="item_tab"
        >
          @{{ item_tab }}
        </v-tab>
      </v-tabs>
  
      <v-tabs-items v-model="tab">
        <v-tab-item
          v-for="item in items"
          :key="item"
        >
          <v-card
            color="basil"
            flat
          >
            <v-card-text> @{{ text }}</v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items> @{{ item }}
        </v-tab>
      </v-tabs>
  
      <v-tabs-items v-model="tab">
        <v-tab-item
          v-for="item in items"
          :key="item"
        >
          <v-card
            color="basil"
            flat
          >
            <v-card-text>@{{ text }}</v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>

        <v-card-text>
          <v-treeview
            :items="items"
            :search="search"
            :filter="filter"
            :open.sync="open"
          >
            <template v-slot:prepend="{ item }">
              <v-icon
                v-if="item.children"
                v-text="`mdi-${item.id === 1 ? 'home-variant' : 'folder-network'}`"
              ></v-icon>
            </template>
          </v-treeview>
        </v-card-text>

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
<script src="{{ asset('js/add_file_parent.js') }}"></script>
@endsection


