@extends('layouts.app_dashbord')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
  
  </div>



<div class="row">

            

            <!--  in stock -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 ">
                <div class="card-body text-center">
                  <i class="pl-3  icon-download2 fa-size text-gray-300 pt-2 color-icon position_icon"></i>
                    <div class="content">
                      <p class=" color-button mt-2 mb-0 font_nunito">Les Produits en Sotck</p>
                      <p class="text-primary text-24 line-height-1 mb-2 number">40,000</p>
                    </div>
                 
               
                </div>
              </div>
            </div>

            <!-- out sotck  -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 ">
                <div class="card-body text-center">
                  <i class="pl-3 icon-upload2 fa-size text-gray-300 pt-2 color-icon position_icon"></i>
                    <div class="content">
                      <p class=" color-button mt-2 mb-0">Les Produits hors Sotck</p>
                      <p class="text-primary text-24 line-height-1 mb-2 number">30,000</p>
                    </div>
                 
               
                </div>
              </div>
            </div>

         
          </div>
@endsection
