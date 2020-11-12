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
        pdf: 'mdi-file-pdf',
      },
      tree: [],
      items: [
        { name: 'COMERCIALIZAÇÃO', 
          children: [
            { name: 'Cadeia_de_valor_UNC.pdf', file: 'pdf', },
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
        { name: 'SERVIÇOS',
          children: [
            { name: 'Cadeia_de_valor_UNS.pdf', file: 'pdf', },
          ],
        },
        { name: 'TRANSMISSÃO',
          children: [
            { name: '	01. Implementação dos projetos de transmissão de energia',
              children: [
                { name: 'logo.pdf', file: 'pdf',}
              ],
            },
            { name: '	02. OeM da Transmissão de energia',
              children: [
                { name: 'logo.pdf', file: 'pdf',}
              ],
            },
            { name: '	03. Gestão comercial da Transmissão',
              children: [
                { name: 'logo.pdf', file: 'pdf',}
              ],
            },
            { name: '	04. Processos de suporte',
              children: [
                { name: 'logo.pdf', file: 'pdf',}
              ],
            },
            { name: 'Cadeia de Valor_Transmissão.pdf', file: 'pdf', },
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