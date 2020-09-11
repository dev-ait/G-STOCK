@extends('layouts.app_dashbord') @section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/css_vue/materialdesignicons.min.css') }}>
<link rel="stylesheet" type="text/css" href={{ asset('assets_dashbord/css_vue/vuetify.min.css') }}>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gérer les gategorie</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="app_table">
            <template>
                <v-row>
                    <v-col cols="4" sm="5">
                      <v-card>
                        <v-toolbar
                          color="pink"
                          dark
                          dense
                          flat
                        >
                          <v-toolbar-title class="body-2">Ajouter un gategorie</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                          <v-form @submit.prevent="add">
                            <v-row>
                                <v-container>
                                    <v-text-field label="Nom" single-line solo v-model="gategorie_a.nom" required></v-text-field>

                                    <v-text-field label="" single-line solo-inverted v-model="gategorie_a.date_create" disabled></v-text-field>

                                    <v-btn color="success" class="mr-4" type="submit">
                                        Ajouter
                                    </v-btn>

                                    <v-btn color="error" class="mr-4" @click="reset">
                                        Effacer
                                    </v-btn>
                                </v-container>
                            </v-row>
                        </v-form>
                        </v-card-text>
                    
                      </v-card>
                        
                    </v-col>
                    <v-col cols="8" sm="7">
                        <v-card>
                            <v-card-title>
                                La liste des gategories
                                <v-spacer></v-spacer>
                                <v-text-field  v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                            </v-card-title>

                            <v-col cols="12" class="pl-remove" sm="3" pb="2"  v-if="btn_control">
                                <v-btn class="btn_remove" depressed @click="deleteItem()">
                                    <v-icon class="color-icon-remove  ">mdi-delete</v-icon>
                                </v-btn>
                            </v-col>

                            <v-data-table  @input="item($event)" :headers="headers" :items="gategorie" :search="search" :value="selectedRows" v-model="selected" :items-per-page="5"  :sort-by.sync="sortBy"
                            :sort-desc.sync="sortDesc" show-select  show-expand  :single-expand="singleExpand" item-key="id"
                            :expanded.sync="expanded" @click:row="clicked">
                            
                            <template  v-slot:expanded-item="{ headers, item }">
                               

                            
                             
                             
                              

                                <div class="pt-2 pb-2 pl-2">
                                   
                              
                                    <v-btn class="ma-2" color="purple" dark @click="editItem(item)">
                                      <v-icon dark>mdi-wrench</v-icon>
                                    </v-btn>

                                    <v-dialog v-model="dialog" max-width="500px">

                        
                                   
                                      <v-card>
                                        <v-card-title>
                                          <span class="headline">Modifier la gategorie</span>
                                        </v-card-title>
                                        
                                          <v-container>
                                            <v-row class="pl-3 pr-3" >
                                              <v-col cols="12" sm="6" md="12">
                                                <v-text-field pl="5" v-model="editedItem.nom"  label="Nom"></v-text-field>
                                              </v-col>
                                              <v-col cols="12" sm="6" md="12">
                                                <v-text-field  v-model="editedItem.date_create" label="Date" disabled></v-text-field>
                                              </v-col>
                                            </v-row>
                                          </v-container>
                                        </v-form>
                                        </v-card-title>
                            
                                    
                            
                                        <v-card-actions>
                                          <v-spacer></v-spacer>
                                          <v-btn color="blue darken-1" text @click="close">Annuler</v-btn>
                                          <v-btn color="blue darken-1" text @click="save">Sauvegarder
                                          </v-btn>
                                        </v-card-actions>
                                      </v-card>
                                    </v-dialog>
                                    
                              
                                
                              
                               
                                </div>

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

<script src="{{ asset('js/gategories_vue.js') }}"></script>


@endsection
