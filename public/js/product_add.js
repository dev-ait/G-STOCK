

$(document).ready(function() {



 

    $("#submit-all").click(function(e) {
        
        
       var dropzone1= dropzone.files.length;

        if( dropzone1 == 0){

            var alert = "<div class='alert alert-card alert-danger' role='alert'>";
            alert += " <strong class='text-capitalize'>avertissement!</strong> Le champs image est obligatoire"
            alert += " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
            alert += "  <span aria-hidden='true'>×</span></button></div>"
            $("#msg").empty().append(alert);
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
        else if( dropzone1 > 0) {
            var photo_ = dropzone.files[0].previewElement.id;
            var titre =  $("#titre").val();
            var description =  quill.root.innerHTML;
            var quantite =  $("#quantite").val();
            var prix =  $("#prix").val();
            var statut =  $("#statut").val();
            var gategorie =  $("#gategorie").val();
            var marque =  $("#marque").val();
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
                    quantite:quantite,
                    prix:prix,
                    statut:statut,
                    gategorie:gategorie,
                    marque:marque,
                    photo:photo
                },
                type: 'post',
                dataType: 'json',
                success: function(data) {
    
                  
    
                   if(data.etat == false){
                    var alert1 = "<div class='alert alert-card alert-danger' role='alert'>";
                    alert1 += " <strong class='text-capitalize'>avertissement!</strong> "+data.text+"";
                    alert1 += " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                    alert1 += "  <span aria-hidden='true'>×</span></button></div>"
                    $("#msg").empty().append(alert1);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                   }
                   if(data.etat == true){
                    window.location.href = '/product';
                   }
                    
    
                },
                error: function(data) {
    
    
                }
            });
        }

       

    });




    




});