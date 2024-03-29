function validateForm() {

    
    var tableProductLength = $("#table_product tbody tr").length;

    if(tableProductLength == 0){
        toastr.info("il faut choisir au mois un produit", {
            progressBar: !0,
            positionClass: "toast-bottom-right",
            showDuration: 200
        });

        return false;

    }
 
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#table_product tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);
       var val_quantite =  $("#quantite" + count).val();
          if(val_quantite <= 0.0 && val_quantite){
              
           
            toastr.info(" etre superieure de 0", "La valeur de quantite doit", {
                progressBar: !0,
                positionClass: "toast-bottom-right",
                showDuration: 200
            });
           return false;
          }
          
      
    } 


    var date =   $("#picker3").val();

    if(date == '' ){

        toastr.info("La Date de commande", "Veuillez choisir ", {
            progressBar: !0,
            positionClass: "toast-bottom-right",
            showDuration: 200
        });
        return false;


    }




}


function calcul_total(row) {

   var new_price =  $("#price" + row).html();
   var new_quantite =  $("#quantite" + row).val();
    
    var total = Number(new_price) * Number(new_quantite);

     total= total.toFixed(2);
             

                    

    $("#total_product" + row).html(total);
    $("#total_productValue" + row).val(total);


    subAmount();


}


var tableLength = 1;
var count = 1;



function subAmount() {
    var tableProductLength = $("#table_product tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#table_product tbody tr")[x];
        var count = $(tr).attr('id');
    
        count = count.substring(3);

        totalSubAmount = Number(totalSubAmount) + Number($("#total_product" + count).html());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

   

    // sub total
    $("#subTotal").html(totalSubAmount);
    $("#subTotalValue").val(totalSubAmount);


    // vat
    var vat = (Number($("#subTotal").html()) / 100) * 20;
    vat = vat.toFixed(2);
    $("#tva").html(vat);
    $("#tvaValue").val(vat);


    // total amount
    var totalAmount = (Number($("#subTotal").html()) + Number($("#tva").html()));
    totalAmount = totalAmount.toFixed(2);
    $("#total").html(totalAmount);

    $("#totalValue").val(totalAmount);





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
            url: '/product/getproduct_data',
            data: {
                productId: productId
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {

                
                var price = data.product.prix;
                var quantite = data.product.quantite;

              
              

                $("#price" + row).html(price);
                $("#priceValue" + row).val(price);
                $("#quantite" + row).val(quantite);

                
                $("#quantite" + row).val();
                $("#quantite" + row).attr({
                    "max" : data.product.quantite,        
                    "min" : 0         
                 });

                var total = Number(data.product.prix) * Number(data.product.quantite);
             
              
                total= total.toFixed(2);

                $("#total_product" + row).html(total);
                $("#total_productValue" + row).val(total);
               

                subAmount();

            },
            error: function(data) {


            }
        });



    }




}



function removeRow(e,row) {

    e.preventDefault();

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


    

    

     $(document).on("click", ".prevent-default" , function() {
      e.preventDefault();
     });


    $("#arrow-down").click(function(e) { 
        
        e.preventDefault();
 
        $(".table-product").toggleClass("active");
     });
    

 
 
 

    $(".btn-add").click(function(e) {

        e.preventDefault();


        $('html,body').animate({
            scrollTop: 9999
        }, 'slow');

        var ajaxurl = '/product/getproduct';

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
                add_row += '<td>  <div class="d-flex "> <div id="price'+count+'"> 0 </div>  <span class="text-muted pl-1">DH</span>  </div> </td>';
                add_row += ' <input type="hidden" id="priceValue'+count+'" name="rate[]" class="form-control input_or" required>';
                add_row += '<td><input type="number" onclick="calcul_total('+count+')" name="quantite[]" id="quantite' + count + '" name="" class="form-control input_or" required></td>';
                add_row += '<td> <div class="d-flex "> <div id="total_product'+count+'"> 0.00  </div>  <span class="text-muted pl-1">DH</span></div></div></td>';
                add_row += ' <input type="hidden" id="total_productValue'+count+'" name="totalp[]" class="form-control input_or" required> ';
                add_row += ' <td><a href="" class="prevent-default" onClick="removeRow(event,' + count + ')" ><i class="i-Close-Window text-19 text-danger font-weight-700""></i></a></td></tr>';
                    



                if (tableLength > 0) {

                    $("#table_product tbody tr:last").after(add_row);
                }
                if (tableLength == 0) {

                    $("#table_product tbody ").append(add_row);
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