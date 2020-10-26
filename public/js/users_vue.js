new Vue({
    el: '#app_users',
    vuetify: new Vuetify(),

    data() {

        return {
            dialog: false,
            expanded: [],
            dialog_add: false,
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            items_project: [],
            model_project: [],
            search_project: null,
            select: { 
                id: '',
                 name: ''
                 },
                 role_items: [
       
                  ],
            user_a: {
                id: 0,
                name : '',
                email: '',
                role : '',
                password:''
            },
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'id',
            sortDesc: true,

            headers: [

                {
                    text: 'Id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                {
                    text: 'Nom',
                    value: 'name'
                },
                {
                    text: 'Email',
                    value: 'email'
                },
                {
                    text: "roles",
                    value: "roles[0].name",
                }
                ,
                {
                    text: "Action",
                    value: "action",
                    sortable: false
                }

            ],

            users: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                name : '',
                email: '',
                role : '',
                password:''

            },
            defaultItem: {
                id: 0,
                name : '',
                email: '',
                role : '',
                password:''
            },

        }
    },


    methods: {

        reset() {

            this.user_a.name = "";

            this.user_a.email = "";

            this.user_a.role = "";
            this.user_a.password = "";


        },

        get_color(name,color) {

            var role_print = '<a style="background-color: '+color+';" class="badge badge-primary  p-2">'+name+'</a>';

           return role_print;
        },

        clicked(value) {
            const index = this.expanded.indexOf(value)



            if (index === -1) {
                this.expanded.push(value)

            } else {
                this.expanded.splice(index, 1)
            }

        },

        editItem(item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true

        },

        save() {

            if (this.editedIndex > -1) {
                Object.assign(this.marque[this.editedIndex], this.editedItem)
                this.update_marque(this.editedItem)

            } else {
                this.marque.push(this.editedItem)
            }

            this.close()

        },

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

                        axios.delete(window.laravel.url + '/deletemarque/' + this.selected[i].id)
                            .then(response => {

                            })
                            .catch(error => {
                                console.log(error);
                            })

                        const index = this.marque.indexOf(this.selected[i]);


                        this.marque.splice(index, 1);
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
        update_marque: function(item_object) {



            axios.put(window.laravel.url + '/updatemarque', item_object)
                .then(response => {
                    console.log(response.data);

                })
                .catch(error => {
                    console.log(error);
                })

        },

        add: function() {
            let jsonData = new FormData()
            jsonData.append('name', this.user_a.name)
            jsonData.append('email', this.user_a.email)
            jsonData.append('password', this.user_a.password)
            jsonData.append('role_id', this.select.id)

            

            axios.post(window.laravel.url + '/user_post', jsonData)
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
                        this.user_a.id = response.data.id_user;
                        this.users.unshift(this.user_a);

                        this.user_a = {
                            id: 0,
                            name : '',
                            email: '',
                            role : '',
                            password:''

                        };
                        this.dialog_add =false;

                    }


                })
        },
        remove_item() {

            if(this.btn_control){
                this.deleteItem();
            }
            else {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Au moins un élément doit être sélectionné!',
                  })

            }

        },

        get_data: function() {
           
            axios.get(window.laravel.url + '/get_users/')
                .then(response => {
                
                    this.users = response.data.users;

                    this.role_items = response.data.roles_all;

            

                })
                .catch(error => {
                    console.log(error);
                })

                axios.get(window.laravel.url + '/getclient/')
                .then(response => {
             
                    this.items_project = response.data.clients;


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