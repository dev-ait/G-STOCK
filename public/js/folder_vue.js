new Vue({
    el: '#app_folder',
    vuetify: new Vuetify(),
    data: () => ({
      fd: [],
      selectedFile: null,
      dialog: false,
      dialog2: false,
      nomePasta: '',
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
      tree: [],
      items: [
        { name: 'dosssier', 
          children: [ 
            
            { name: '	01. Implementação dos projetos de transmissão de energia', name: 'Cadeia_de_valor_UNC.pdf', file: 'pdf', },
          ],
        },
        { name: 'DISTRIBUIÇÃO', 
          children: [
            { name: '	Cadeia_de_valor_UND.pdf', file: 'pdf', },
          ],
        },
        { name: 'GERAÇÃO',
          children: [
            { name: 'Cadeia_de_valor_UNG.pdf', file: 'pdf', },
          ],
        },
      
        
      ],
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
      selectedFile: null,
    }),
    
    watch: {
      dialog (val) {
        val || this.close()
      },
      dialog2 (val) {
        val || this.close()
      },
    },
    
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
      
      close () {
        this.dialog = false
        this.dialog2 = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
        this.fd = []
        this.nomePasta = ''
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
        const id = this.nextId++;
        const name = this.fd[0].name;
        const file = 'pdf';
        this.editedItem.children.push({
          id,
          name,
          file
        });
        this.dialog = false
      },
      
      addChildFolder() {
        if (!this.editedItem.children) {
          this.$set(this.editedItem, "children", []);
        }
  
        const name = this.nomePasta;
        const id = this.nextId++;
        this.editedItem.children.push({
          id,
          name
        });
        this.dialog2 = false
      },
    }
  })