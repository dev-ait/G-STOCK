$(document).ready(function() {


    $(".update").click(function(e) {

        var id_user = $("#id_user").val();
        var nom = $("#nom").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var role_id = $("#role_id").val();



        var ajaxurl = '/update_user';



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: ajaxurl,
            data: {
                id: id_user,
                nom: nom,
                email: email,
                password: password,
                role_id: role_id,
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {

                console.log(data);


                if (data.etat == true) {
                    window.location.href = '/users';
                }

                if (data.etat == false) {
                    var alert1 = "<div class='alert alert-card alert-danger' role='alert'>";
                    alert1 += " <strong class='text-capitalize'>avertissement!</strong> le champs <strong>" + data.text + "</strong>";
                    alert1 += " est obligatoire";
                    alert1 += " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                    alert1 += "  <span aria-hidden='true'>×</span></button></div>"
                    $("#msg").empty().append(alert1);

                }



            },
            error: function(data) {


            }
        });



    });


    $(".delete").click(function(e) {
        var id_user = $(this).next().val();


        var ajaxurl = '/delete_user/' + id_user;



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: ajaxurl,

            type: 'post',
            dataType: 'json',
            success: function(data) {


                if (data.etat == true) {
                    window.location.href = '/users';
                }



            },
            error: function(data) {


            }
        });




    });

    $("#submit-all").click(function(e) {




        var nom = $("#nom").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var role_id = $("#role_id").val();



        var ajaxurl = 'user_post';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: ajaxurl,
            data: {
                nom: nom,
                email: email,
                password: password,
                role_id: role_id,
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {

                if (data.email == true) {
                    var alert2 = "<div class='alert alert-card alert-danger' role='alert'>";
                    alert2 += " <strong class='text-capitalize'>avertissement!</strong>  ";
                    alert2 += "cette <strong> adresse email </strong> deja utilisé par un autre utilisateur";
                    alert2 += " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                    alert2 += "  <span aria-hidden='true'>×</span></button></div>"
                    $("#msg").empty().append(alert2);
                }

                if (data.etat == false) {
                    var alert1 = "<div class='alert alert-card alert-danger' role='alert'>";
                    alert1 += " <strong class='text-capitalize'>avertissement!</strong> le champs <strong>" + data.text + "</strong>";
                    alert1 += " est obligatoire";
                    alert1 += " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                    alert1 += "  <span aria-hidden='true'>×</span></button></div>"
                    $("#msg").empty().append(alert1);

                }
                if (data.etat == true) {
                    window.location.href = '/users';
                }



            },
            error: function(data) {


            }
        });




    });




});