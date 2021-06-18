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
            show_button_validation : true,
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
                    text: "Site",
                    align: "left",
                    sortable: false,
                    value: "site"
                },
               
                
           
                {
                    text: 'Status',
                    value: 'status'
                }
                ,
                {
                    text: 'Les produits commandes',
                    align: "center",
                    value: 'action'
                }

                ,
                {
                    text: 'Details',
                    value: 'details'
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

        get_status(id) {

            var status = "";

            var color = '';

            if(id == 1){
                status = "En cours"
                color = '#ff9800'; 
            }

            if(id == 2){
                status = "Validé"
                color = '#4caf50';
            }


            if(id == 3){
                status = "Refuser"
                color = '#f44336';
            }


            var role_print = '<a style="background-color: ' + color + ';" class="badge badge-primary  p-2">' + status + '</a>';

            return role_print;
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