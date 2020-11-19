
// register the component
Vue.component('treeselect', VueTreeselect.Treeselect)



new Vue({
  el: '#app_folder',
  vuetify: new Vuetify(),
  
  data: () => ({
    name_folder: '',
    id_item : '',
    nextId: 0,
    open: ['public'],
    files: {
      html: 'mdi-language-html5',
      js: 'mdi-nodejs',
      json: 'mdi-json',
      md: 'mdi-markdown',
      pdf: 'mdi-file-pdf',
      png: 'mdi-file-image',
      txt: 'mdi-file-document-outline',
      xls: 'mdi-file-excel'
    },
    files: [],
    tree: [],
    items: [],
    tab: null,

    text: 'Lorem ipsum doloraliquip ex ea commodo consequat.',
    item_tabs :  [
      'Assigner', 'tab2', 'tab3',
    ],
    select_item: null,
    options: [ {
      id: 'a',
      label: 'a',
      children: [ {
        id: 'aa',
        label: 'aa',
      }, {
        id: 'ab',
        label: 'ab',
      } ],
    }, {
      id: 'b',
      label: 'b',
    }, {
      id: 'c',
      label: 'c',
    } ],
    editedItem: {
      id: '',
      name: '',
      file: ''
    },
    defaultItem: {
      id: '',
      name: '',
      file: ''
    },
    editedIndex: -1,
   
  
  }),



  methods: {

    buscaBlob (item) {      axios.get(`https://localhost:44392/api/Files/GetSpecific/5?blobName=PDF TESTE.pdf`)
        .then(response => {
          item.comCheckout = 1
          // this.editedItem.urlAnexo = response.data.uri
          let file = response.data
          let docfile = new File([file], `${file.name}`)
          // const objectURL = window.URL.createObjectURL(file);
          let link = document.createElement('a')
          // link.href = window.URL.createObjectURL(docfile);
          link.href = file.StorageUri.PrimaryUri
          link.download = docfile.name
          document.body.appendChild(link)
          link.click()
          document.body.removeChild(link)
        })
    },
    add_item(){

     this.add_folder(this.select_item,this.name_folder); 

     alert(this.name_folder)

    },
    close () {
      this.dialog = false
      this.dialog2 = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
      this.fd = []
      this.name_folder = ''
      this.selectedFile = null
    },
    
    addFile (item) {
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = item
      this.dialog = true
      
    },

    addFolder (item) {
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = item
      this.dialog2 = true
 
    },
    

    addChildFile() {
      if (!this.editedItem.children) {
        this.$set(this.editedItem, "children", []);
      }
   

      console.log(this.selectedFile[0]);
    },
    
    addChildFolder() {
      if (!this.editedItem.children) {
        this.$set(this.editedItem, "children", []);
      }

      const name = this.name_folder;
      const id = this.nextId++;
      this.editedItem.children.push({
        id,
        name
      });

      this.add_folder(this.editedItem.id,this.name_folder)

    
      this.dialog2 = false
    },
    add_folder: function(id,name) {
        let jsonData = new FormData()
        jsonData.append('id_parent', id)
        jsonData.append('name', name)



        axios.post(window.laravel.url + '/add_folder', jsonData)
            .then(response => {
                console.log(response.data);

                if (response.data.etat) {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Ajouté avec succes'
                    })


                   this.select_item = null;
                   this.name_folder = '';
              

                }


            })
    },
    get_data: function() {
      axios.get(window.laravel.url + '/get_folders_items_v1')
          .then(response => {

            const treeify = (arr, pid) => {
              const tree = [];
              const lookup = {};
              // Initialize lookup table with each array item's id as key and 
              // its children initialized to an empty array 
              arr.forEach((o) => {
                lookup[o.id] =o;
                lookup[o.id].children = [];
              });
              arr.forEach((o) => {
                // If the item has a parent we do following:
                // 1. access it in constant time now that we have a lookup table
                // 2. since children is preconfigured, we simply push the item
                if (o.parentId !== null) {
                  lookup[o.parentId].children.push(o);
                } else {
                  // no o.parent so this is a "root at the top level of our tree
                  tree.push(o);
                }
              });
              return tree;
            };
          
            var reponse = response.data.item_folder;
           
             var covert_hierarchie_items =  treeify(reponse);
             this.items = covert_hierarchie_items ;


          })
          .catch(error => {
              console.log(error);
          })
     }
  },
  mounted: function() {

    this.get_data();



    }
})