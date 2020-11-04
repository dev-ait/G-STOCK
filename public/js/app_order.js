new Vue({
    el: '#app_order',
    vuetify: new Vuetify(),

    data() {

        return {
            dialog: false,
            expanded: [],
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'id',
            sortDesc: true,

            subHeaders: [  
                 {
                  text: "Nom produit",
                  align: "left",
                  sortable: false,
                  value: "nom_produit"
                 },
                 {
                    text: "prix",
                    value: "prix"
                   },
                   {
                    text: "Quantite",
                    value: "quantite"
                   },
                   ,
                   {
                    text: "Total",
                    value: "total"
                   }

            ],

            headers: [

                {
                    text: "Nom client",
                    align: "left",
                    sortable: false,
                    value: "nom_client"
                },
               
                {
                    text: 'Telephone de client',
                    value: 'client_telephone'
                },

                {
                    text: 'Sous Total',
                    value: 'subtotal'
                },
                {
                    text: 'Tva',
                    value: 'tva'
                },
                {
                    text: 'Total',
                    value: 'total'
                },
                {
                    text: 'Type Paiement',
                    value: 'typepaiement'
                },
                {
                    text: 'Statut Paiement',
                    value: 'statutpaiement'
                }
                ,
                {
                    text: 'Les produits commandes',
                    align: "center",
                    value: 'action'
                }

                ,
                {
                    text: 'Imprimer',
                    value: 'print'
                }

                ,
                {
                    text: 'Validation de commande',
                    value: 'validate'
                }



            ],

            orders: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                client_id: 0,
                subtotal: 0,
                tva: 0,
                total: 0,
                typepaiement: '',
                statutpaiement: '',
            },
            defaultItem: {
                id: 0,
                client_id: 0,
                subtotal: 0,
                tva: 0,
                total: 0,
                typepaiement: '',
                statutpaiement: '',
            },
            product_order :[]

        }
    },


    methods: {

        show_order_product(item) {
           
             this.product_order =  item.product_order
            
            this.dialog = true
        },


        valide_commande: function(item) {


     
            axios.put(window.laravel.url + '/validation_commande',  item)
            .then(response => {
                
                console.log(response.data);

            })
            .catch(error => {
                console.log(error);
            })

         },


       

        print(item) {
            
            window.location.href = "order/" + item.id + "/edit"
        },

        clicked(value) {
            const index = this.expanded.indexOf(value)



            if (index === -1) {
                this.expanded.push(value)

            } else {
                this.expanded.splice(index, 1)
            }

        },
        remove_item() {

            if(this.btn_control){
                this.deleteItem();
            }
            else{

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Au moins un élément doit être sélectionné!',
                  })

            }

        }
        ,

        close() {

            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1

            })
            this.expanded = [];

        },

        item: function(values) {

            if (values.length > 0) {

                this.btn_control = true;

            } else {
                this.btn_control = false;

            }


        },

        deleteItem() {

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "voulez vous vraiment  supprimé",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Retour',
                confirmButtonText: 'Oui, Supprimé !'
            }).then((result) => {
                if (result.value) {

                    for (var i = 0; i < this.selected.length; i++) {

                        axios.delete(window.laravel.url + '/deleteproduct/' + this.selected[i].id)
                            .then(response => {
                                console.log(response);

                            })
                            .catch(error => {
                                console.log(error);
                            })

                        const index = this.orders.indexOf(this.selected[i]);


                        this.orders.splice(index, 1);
                    }
                    this.selected = [];




                    this.btn_control = false;

                    Swal.fire({

                            title: 'Supprimer!',
                            html: 'Votre experience été supprimer aver succes.',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,


                            onBeforeOpen: () => {

                                timerInterval = setInterval(() => {
                                    const content = Swal.getContent()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                }, 100)
                            },
                            onClose: () => {
                                clearInterval(timerInterval)
                            }


                        }

                    )
                }
            })



        },

        get_data: function() {

            axios.get(window.laravel.url + '/getorder/')
                .then(response => {

                    console.log(response.data);

                    this.orders = response.data.orders;

              


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