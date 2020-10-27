$(document).ready(function() {




  $(document).on("keyup", ".control_input", function() {

      var length = $(this).val().length;

      var check_price = $(this).attr('id');

      check_price

      if (check_price == "prix") {
          $(this).next().next().removeClass("display_input");
          $(this).removeClass("invalid");

      }


      if (length > 0) {

          $(this).next().removeClass("display_input");
          $(this).removeClass("invalid");

      }

      if (length == 0) {

          $(this).next().addClass("display_input");
          $(this).addeClass("invalid");

      }



  });



  

  $(document).on("change", ".control_input", function() {

    var length = $(this).val().length;


    if (length > 0) {

        $(this).next().removeClass("display_input");
        $(this).removeClass("invalid");

    }

    if (length == 0) {

        $(this).next().addClass("display_input");
        $(this).addeClass("invalid");

    }



});

  $("#type_modele").change(function() {
      var value_modele = $(this).val();
      if (value_modele == 1) {
          $("#modele").removeClass("d-none");
      }
      if (value_modele == 2) {
          $("#modele").addClass("d-none");
      }


  });

  $("#submit-all").click(function(e) {

      $(".form-control").addClass("control_input");

      var dropzone1 = dropzone.files.length;
      var titre = $("#titre").val();
      var description = quill.root.innerHTML;
      var quantite = $("#quantite").val();
      var prix = $("#prix").val();
      var statut = $("#statut").val();
      var gategorie = $("#gategorie").val();
      var marque = $("#marque").val();
      var modele_id = $("#modele_id").val();


      if (titre == "") {
          $("#titre").next().addClass("display_input");
          $("#titre").addClass("invalid");


      }



      if (dropzone1 == 0) {
          $("#file_image").addClass("display_input");


      }

      if (quantite == "") {

          $("#quantite").next().addClass("display_input");
          $("#quantite").addClass("invalid");

      }
      if (prix == "") {

          $("#prix").next().next().addClass("display_input");
          $("#prix").addClass("invalid");

      }
      if (statut == "") {

          $("#statut").next().addClass("display_input");
          $("#statut").addClass("invalid");

      }
      if (gategorie == "") {

          $("#gategorie").next().addClass("display_input");
          $("#gategorie").addClass("invalid");

      }
      if (marque == "") {

          $("#marque").next().addClass("display_input");
          $("#marque").addClass("invalid");

      }
      if (dropzone1 > 0) {
          var photo_ = dropzone.files[0].previewElement.id;
          var photo = photo_;
          var ajaxurl = '/product/store';
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url: ajaxurl,
              data: {
                  titre: titre,
                  description: description,
                  quantite: quantite,
                  prix: prix,
                  statut: statut,
                  gategorie: gategorie,
                  marque: marque,
                  modele_id: modele_id,
                  photo: photo
              },
              type: 'post',
              dataType: 'json',
              success: function(data) {

                  if (data.etat == false) {
                      $("html, body").animate({
                          scrollTop: 0
                      }, "slow");
                  }
                  if (data.etat == true) {
                      window.location.href = '/product';
                  }
              },
              error: function(data) {
              }
          });
      }
  });
});