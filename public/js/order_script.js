function validateForm() {
    var tableProductLength = $("#table tbody tr").length;
 
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#table tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);
       var val_quantite =  $("#quantite" + count).val();
          if(val_quantite <= 0.0 && val_quantite){
              
            alert("La valeur de quantite doit etre superieure de 0");
           return false;
          }
          
      
    } 
}


function calcul_total(row) {

   var new_price =  $("#rateValue" + row).val();
   var new_quantite =  $("#quantite" + row).val();
    
    var total = Number(new_price) * Number(new_quantite);
             
              
                    

    $("#total" + row).val(total);
    $("#totalValue" + row).val(total);

    subAmount();


}


var tableLength = 1;
var count = 1;



function subAmount() {
    var tableProductLength = $("#table tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#table tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);

        totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#subTotal").val(totalSubAmount);
    $("#subTotalvalue").val(totalSubAmount);

    // vat
    var vat = (Number($("#subTotal").val()) / 100) * 20;
    vat = vat.toFixed(2);
    $("#tva").val(vat);
    $("#tvavalue").val(vat);


    // total amount
    var totalAmount = (Number($("#subTotal").val()) + Number($("#tva").val()));
    totalAmount = totalAmount.toFixed(2);
    $("#total").val(totalAmount);
    $("#totalvalue").val(totalAmount);




}




function getProductData(row = null) {

    var productId = $("#productName" + row).val();



    if (productId == "") {

        $("#rate" + row).val("");
        $("#quantite" + row).val("");
        $("#total" + row).val("");

        subAmount();




    } else {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/getproduct_data',
            data: {
                productId: productId
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {

                $("#rate" + row).val(data.product.prix);
                $("#rateValue" + row).val(data.product.prix);
                $("#quantite" + row).val(data.product.quantite);
                $("#quantite" + row).attr({
                    "max" : data.product.quantite,        
                    "min" : 0         
                 });

                var total = Number(data.product.prix) * Number(data.product.quantite);
             
              
                    

                $("#total" + row).val(total);
                $("#totalValue" + row).val(total);

                subAmount();

            },
            error: function(data) {


            }
        });



    }




}

function getphone() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var clientId = $("#valueclient").val();

    $.ajax({
        url: '/getphone',
        data: {
            clientId: clientId
        },
        type: 'post',
        dataType: 'json',
        success: function(data) {
            
            $("#phone_client").val(data.client.telephone);
     

        },
        error: function(data) {


        }
    });

}

function removeRow(row) {
    $('html,body').animate({
        scrollTop: 9999
    }, 'slow');
    document.getElementById("row" + row).remove();
    tableLength--;
    subAmount();

}


function resetOrderForm() {
    $('html,body').animate({
        scrollTop: 9999
    }, 'slow');

	$("#FormOrder")[0].reset();

} 


$(document).ready(function() {




    $(".btn-add").click(function() {


        $('html,body').animate({
            scrollTop: 9999
        }, 'slow');

        var ajaxurl = '/getproduct';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: ajaxurl,
            type: 'get',
            dataType: 'json',
            success: function(data) {

                len = data['products'].length;
                count++;

                

                var add_row = '<tr id=row' + count + '><td><select id="productName' + count + '" onchange="getProductData(' + count + ')" class="js-example-basic-single form-control input-product" style="width: 100%" name="product[]" required>';
                add_row += '<option  value="">Selectionner le produit</option>';
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        console.log(data['products'][i].titre);

                        add_row += "<option  value='"+data["products"][i].id+"'>"+data["products"][i].titre+"</option>";



                    }
                }
                add_row += '</select></td>';
                add_row += '<td><input type="number" name="rate[]" id="rate'+count+'" name="" class="form-control input_or" disabled required></td>';
                add_row += ' <input type="hidden" id="rateValue'+count+'" name="rate[]" class="form-control input_or" required>';
                add_row += '<td><input type="number" onclick="calcul_total('+count+')" name="quantite[]" id="quantite' + count + '" name="" class="form-control input_or" required></td>';
                add_row += '<td><input type="number" name="total[]" id="total' + count + '" name="" class="form-control input_or" disabled required></td>';
                add_row += ' <input type="hidden" id="totalValue'+count+'" name="totalp[]" class="form-control input_or" required>';
                add_row += ' <td><a href="#" class="btn btn-danger btn-circle btn-remove" onClick="removeRow(' + count + ')" required>' +
                    '<i class="fa fa-trash"></i></a></td></tr>';



                if (tableLength > 0) {

                    $("#table tbody tr:last").after(add_row);
                }
                if (tableLength == 0) {

                    $("#table tbody ").append(add_row);
                }
                tableLength++;

                $('.js-example-basic-single').select2({
                    theme: "classic"
                });

            },
            error: function(data) {


            }
        });

    });




    $(window).on("load", function() {
        $('.js-example-basic-single').select2({
            theme: "classic"
        });
    });




});