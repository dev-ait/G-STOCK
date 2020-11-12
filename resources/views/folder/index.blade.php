@extends('layouts.master')
@section('main-content')
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('css_vuetify/vuetify.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets/styles/css/custom_vuetify.css') }}>
<div class="breadcrumb">
   <h1>  Gestion des fichiers </h1>
</div>
<div class=" border-top"></div>
<div id="app_folder" data-app>
   <div class="row">
      <div class="col-md-12">
         <v-text-field v-model="search" label="Items Search" clearable clear-icon="mdi-close-circle-outline"></v-text-field>
         <v-app id="inspire">
           
            <v-treeview v-model="tree" :open="open" :items="items" item-key="name">
              <template v-slot:prepend="{ item, open }">
                <v-icon v-if="!item.file">
                  @{{ open ? 'mdi-folder-open' : 'mdi-folder' }}          
                </v-icon>
                <v-icon v-else @click="buscaBlob(item)">
                  @{{ files[item.file] }}
                </v-icon>       
                <v-btn v-if="!item.file" color="primary" class="ma-2" dark @click="addFile(item)">add file</v-btn>
                <v-btn v-if="!item.file" color="primary" class="ma-2" dark @click="addFolder(item)">add folder</v-btn>
              </template>
              
            </v-treeview>
            
            <v-dialog v-model="dialog" max-width="500px">
              <v-card>
                <v-card-title>
                  New document
                </v-card-title>
                <v-card-text>
                  <v-file-input
                                type="file"
                                v-model="selectedFile"
                                color="ivory accent-4"
                                counter
                                label="Anexo de Propostas"
                                multiple
                                v-on:change="onFileSelected()"
                                placeholder="Select your files"
                                prepend-icon="mdi-paperclip"
                                outlined
                                hint="Na edição, caso um arquivo ja tenha sido enviado, ele será substituido."
                                persistent-hint
                                :show-size="1000"
                                requeired
                                >
                    <template v-slot:fd="{ index, text }">
                      <v-chip
                              v-for="file in fd" :slot="file.name" :key="file.name"
                              color="slategray accent-4"
                              dark
                              label
                              small
                              id = "uploadedFile"
                              >
                              @{{ text }}
                      </v-chip>
                      <span
                            class="overline grey--text text--darken-3 mx-2"
                            >
                        +@{{ files.length - 2 }} File(s)
                      </span>
                    </template>
                  </v-file-input>
                </v-card-text>
                <v-card-actions>
                  <v-btn color="primary" text @click="dialog = false" > Close </v-btn>
                  <v-btn color="primary" text @click="addChildFile()" > Save </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialog2" max-width="500px">
              <v-card>
                <v-card-title>
                  Nova pasta
                </v-card-title>
                <v-card-text>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field v-model="nomePasta" label="Nome da pasta"></v-text-field>
                  </v-col>
                </v-card-text>
                <v-card-actions>
                  <v-btn color="primary" text @click="dialog2 = false" > Close </v-btn>
                  <v-btn color="primary" text @click="addChildFolder()" > Save </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            
          </v-app>
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
<script src="{{ asset('js/folder_vue.js') }}"></script>
@endsection


