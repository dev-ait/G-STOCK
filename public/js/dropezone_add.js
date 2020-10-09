
var mockFile_delete = false;
var length_file = 0;

Dropzone.autoDiscover = false;
var dropzone = new Dropzone ("#mydropzone", {
    addRemoveLinks: true,

 
    init: function() {
        var mockFile = { name: window.img.photo_nom, size: 702345, type: 'image/png',  accepted: true   };       
        this.options.addedfile.call(this, mockFile);
        this.options.thumbnail.call(this, mockFile, window.img.url+"/images/"+window.img.photo_nom);
        mockFile.previewElement.classList.add('dz-success');
        mockFile.previewElement.classList.add('dz-complete');        

    

    }
});


var count_file =1;
var current_file = "non";
dropzone.on("removedfile", function(file){
    count_file--;
    mockFile_delete = true;
  
});


dropzone.on("addedfile", function(file) {
    count_file++; 
    current_file = "yes";

});

dropzone.on("success", function(file, response) {
    
    file.previewElement.id = response.id;


    
});











    

 
