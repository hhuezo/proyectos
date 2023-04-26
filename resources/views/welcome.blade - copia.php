@extends('layouts.form')

@section('title','Sistema de Seguimiento de Proyectos')

@section('body-class','profile-page')

@section('styles')


  <style>
      .team .row .col-md-4{
        margin-bottom: 5em;
      }
      .row {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display:         flex;
        flex-wrap: wrap;
      }
      .row > [class*='col-'] {
        display: flex;
        flex-direction: column;
      }

      .tt-query {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
           -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      }

      .tt-hint {
        color: #999
      }

      .tt-menu {    /* used to be tt-dropdown-menu in older versions */
        width: 200px;
        margin-top: 4px;
        padding: 4px 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 4px;
           -moz-border-radius: 4px;
                border-radius: 4px;
        -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
           -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                box-shadow: 0 5px 10px rgba(0,0,0,.2);
      }

      .tt-suggestion {
        padding: 3px 20px;
        line-height: 24px;
      }

      .tt-suggestion.tt-cursor,.tt-suggestion:hover {
        color: #fff;
        background-color: #0097cf;

      }

      .tt-suggestion p {
        margin: 0;
      }






      .fullscreen-modal .modal-dialog {
        margin: 0;
        margin-right: auto;
        margin-left: auto;
        width: 100%;
      }
      @media (min-width: 768px) {
        .fullscreen-modal .modal-dialog {
          width: 750px;
        }
      }
      @media (min-width: 992px) {
        .fullscreen-modal .modal-dialog {
          width: 970px;
        }
      }
      @media (min-width: 1200px) {
        .fullscreen-modal .modal-dialog {
           width: 1170px;
        }
      }


  </style>

  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
@endsection

@section('content')
<div class="header header-filter" >
  <div class="container">
    <div class="row">
      <div class="col-md-12">

<center>
  <br>
  <br>
  <br>
  <br>
  <br>

  <h1 style="color:white">Sistema de Seguimiento de Proyectos</h1>
  <h4 style="color:white" >"Llegar juntos es el principio. Mantenerse juntos, es el progreso. Trabajar juntos es el éxito"</h4>


</center>
        <!-- <br />
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-raised btn-lg">
        <i class="fa fa-play"></i>Como funciona?
        </a> -->



  

      </div>
    </div>
  </div>
</div>

<div class="main main-raised">
<div class="container">



















      <div class="team">
        <div class="row">

          

        </div>
      </div>




  </div>

</div>




@include('includes.footer')
@endsection

@section('scripts')




  <script src="{{ asset('/js/typeahead.bundle.min.js')}} " type="text/javascript"></script>

  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->


@endsection
