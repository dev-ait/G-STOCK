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
                  <div class="my-4 subtitle-1 white--text h5">
                     Ajouter Fichiers
                  </div>
                  <v-text-field  
                     v-model="folder.name_item"
                     label="Nom de Fichiers ou Dossiers"
                     dark
                     flat
                     solo-inverted
                     hide-details
                     clearable
                     clear-icon="mdi-close-circle-outline"
                     ></v-text-field>

                  
                        <div class="mt-3 white--text ">Choisir le répertoire de  <strong>Fichiers ou Dossiers</strong></div>
                   
                  <treeselect 
                     
                     class="mt-1"
                     v-model="folder.id_item"
                     :multiple="false" 
                     :options="items_label"
                     :load-options="loadOptions" />
                  </treeselect>
              

                     <v-switch
                    
                     v-model="switch2"
                     color="primary"
                     @change="changeState()"
                     label="joindre fichier"
                     value=""
                     persistent-hint
                     ></v-switch>

                  
                
                  <template v-if="show_input_file">
                     <v-file-input
                        v-model="folder.file"
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
           
              <v-tabs vertical>
                <v-tab>
                  <v-icon left>
                     mdi-server-network   
                  </v-icon>
                  Option 1
                </v-tab>
                <v-tab>
                  <v-icon left>
                     mdi-folder-multiple-outline
                  </v-icon>
                  Répertoire
                </v-tab>
                <v-tab>
                  <v-icon left>
                    mdi-access-point
                  </v-icon>
                  Option 3
                </v-tab>
          
                <v-tab-item>
                  <v-card flat>
                    <v-card-text>
                      <p>
                        Sed aliquam ultrices mauris. Donec posuere vulputate arcu. Morbi ac felis. Etiam feugiat lorem non metus. Sed a libero.
                      </p>
          
                      <p>
                        Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Aliquam lobortis. Aliquam lobortis. Suspendisse non nisl sit amet velit hendrerit rutrum.
                      </p>
          
                      <p class="mb-0">
                        Phasellus dolor. Fusce neque. Fusce fermentum odio nec arcu. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Phasellus blandit leo ut odio.
                      </p>
                    </v-card-text>
                  </v-card>
                </v-tab-item>
                <v-tab-item>
                  <v-card flat>
                     <h5 class="mt-3">  Répertoire des Fichiers</h5>
                     <v-app id="inspire">
                     <v-treeview v-model="tree" :open="open" :items="items" item-key="name">
             



                        <template v-slot:prepend="{ item, open }">
                          <v-icon v-if="!item.file">
                            @{{ open ? 'mdi-folder-open' : 'mdi-folder' }}          
                          </v-icon>
                          <v-icon v-else @click="buscaBlob(item)">
                            @{{ files[item.file] }}
                          </v-icon>
                        </template>
                        
                  
          
                        
                      </v-treeview>
                     </v-app>
                  </v-card>
                </v-tab-item>
                <v-tab-item>
                  <v-card flat>
                    <v-card-text>
                      <p>
                        Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et, tempor auctor, justo.
                      </p>
          
                      <p class="mb-0">
                        Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum sagittis.
                      </p>
                    </v-card-text>
                  </v-card>
                </v-tab-item>
              </v-tabs>
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