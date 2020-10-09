var dropzone = new Dropzone ("#mydropzone", {
 
    
  });



  dropzone.on("addedfile", function(file) {
 
    // Create the remove button
    var removeButton = Dropzone.createElement("<button class='btn  dark'>Effacer le fichier</button>");

    // Listen to the click event
    removeButton.addEventListener("click", function(e) {
        // Make sure the button click doesn't submit the form:
        e.preventDefault();
        e.stopPropagation();

        // Remove the file preview.
        dropzone.removeFile(file);
        // If you want to the delete the file on the server as well,
        // you can do the AJAX request here.
    });

    // Add the button to the file preview element.
    file.previewElement.appendChild(removeButton);
});

dropzone.on("removedfile", function(file){

var name = file.name; 
$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});        
$.ajax({
    type: 'POST',
    url: 'remove_img/'+ file.previewElement.id,
    data: "id="+file.previewElement.id,
    type: 'delete',
});

});


dropzone.on("success", function(file, response) {
    
    file.previewElement.id = response.id;


    
});


