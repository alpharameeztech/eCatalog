<template>
    <div>

        <v-card>
        <v-card-title>
            Stores
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
        </v-card-title>
         <v-data-table
            :headers="headers"
            :items="desserts"
            :search="search"
        >   
        
        <!-- country name -->
            <template v-slot:item.country="{ item }">
                     <v-text>{{ item.country.name }} </v-text>
            </template>
        <!-- country name end-->
            
        <!-- formatted created date -->    
            <template v-slot:item.created_at="{ item }">
                    <v-row  class="d-flex justify-end">
                        <v-chip
                            class="ma-2"
                            color="primary"
                            outlined
                            pill
                        >
                            <v-avatar left>
                                <v-icon>av_timer</v-icon>
                            </v-avatar>

                            {{ ago(item.created_at) }}

                        </v-chip>
                    </v-row>
                </template>
            <!-- formatted created date end -->

            <!-- formatted updated date -->
            <template v-slot:item.updated_at="{ item }">
                    <v-row  class="d-flex justify-end">
                        <v-chip
                            class="ma-2"
                            color="primary"
                            outlined
                            pill
                        >
                            <v-avatar left>
                                <v-icon>av_timer</v-icon>
                            </v-avatar>

                            {{ ago(item.updated_at) }}

                        </v-chip>
                    </v-row>
                </template>
                <!-- formatted updated date end-->        
       
        <!-- add/update modal -->
            <template v-slot:top>
                <v-toolbar flat color="white">

                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark class="mb-2" v-on="on">Add Store</v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-file-input
                                                v-model="file"
                                                label="Select Image File..."
                                                accept="image/*"
                                                @change="onFileChange"
                                            ></v-file-input>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field v-model="editedItem.website_link" label="Website Link"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field v-model="editedItem.facebook_link" label="Facebook Page"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                             <v-textarea
                                                v-model="editedItem.about"
                                                outlined
                                                name="input-7-4"
                                                label="Outlined textarea"
                                                ></v-textarea>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Send</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
        <!-- add/update modal end -->

        <!-- action -->
         <template v-slot:item.action="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
            >
                edit
            </v-icon>
        </template>
        <!-- action end -->
        </v-data-table>
    </v-card>


    </div>
</template>
<script>
import api from "../../../mixins/api";
import moment from 'moment';

    export default {
        mixins: [api],
        data() {
            return {
                country: '',
                search: '',
                editingPassword: false,
                ban:'',
                show1: false,
                password: '',
                avatar: false,
                file: null,
                imageUrl: null,
                profilePicture: '',
                rules: {
                    required: value => !!value || 'Required.',
                    min: v => v.length >= 8 || 'Min 8 characters',
                },
                dialog: false,
                publishers: [],
                headers: [
                    
                    {
                        text: 'Id',
                        value: 'id',
                    },
                    {
                        text: 'Name',
                        align: 'left',
                        sortable: true,
                        value: 'name',
                    },
                    { text: 'Slug', value: 'slug'},
                    { text: 'Image', value: 'image'},
                    { text: 'Website Link', value: 'website_link'},
                    {text: 'Facebook Link', value: 'facebook_link', width: 250},
                    {text: 'About', value: 'about', width: 250},
                    {text: 'Status', value: 'status'},
                    {text: 'Updated At', value: 'updated_at'},
                    {text: 'Created At', value: 'created_at'},
                    {text: 'Actions', value: 'action', sortable: false},
                ],
                desserts: [],
                banPublishers:[],
                editedIndex: -1,
                editedItem: {
                    id:'',
                    name: '',
                    website_link: '',
                    facebook_link: '',
                    about: '',
                },
                defaultItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                }
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add Store' : 'Edit Store'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
        },

        created () {
            this.initialize()
        },

        methods: {
            initialize () {

                var self = this;

                this.$root.$emit('loading', true);

                axios.get('/api/stores')
                    .then(function (response) {

                        self.desserts = response.data;

                        self.$root.$emit('loading', false);
                    })
                    .catch(function (error) {

                        console.info('error');

                    })
                    .finally(function () {
                        self.$root.$emit('loading', false);
                    });

            },
             ago(date){

                moment.locale();

                return moment.utc(date).fromNow();

            },

            editItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.desserts.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                    this.ban= ''
                }, 300)
            },

            save () {
                var self = this;

                this.$root.$emit('loading', true);

                let formData = new FormData();
                /*
                    Add the form data we need to submit
                */
                formData.append('profilePicture', this.profilePicture);

                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    axios.patch('/api/store', {
                        id: this.editedItem.id,
                        name: this.editedItem.name,
                        countryId: this.editedItem.country_id.id
                    })
                        .then(function (response) {
                            flash('Changes Saved.', 'success');

                            this.initialize()

                        })
                        .catch(function (error) {
                        })
                        .finally( function() {
                            self.$root.$emit('loading', false);
                        });


                } else {
                    var self = this
                    this.$root.$emit('loading', true);

                    this.desserts.push(this.editedItem)
                    
                    axios.post('/api/store', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'enctype' : 'multipart/form-data'
                        }
                    }).then(function (response) {

                        self.$root.$emit('loading', false)

                        flash('Changes Saved')

                        self.initialize()

                        self.removeImage()

                    })
                    .catch(function (error) {

                        self.$root.$emit('loading', false)

                        flash('Changes Not Saved', 'error')
                    })
                    .finally(function () {
                        self.$root.$emit('loading', false)

                    });
                    this.close()
                    this.initialize()
                }
               
            },
            onFileChange() {
                let reader = new FileReader()
                reader.onload = () => {
                    this.imageUrl = reader.result
                }
                reader.readAsDataURL(this.file)
                this.profilePicture = this.file
            },

            removeImage: function (e) {
                this.profilePicture = ''
                this.file = ''
            },

        },

        mounted() {

            this.initialize()

            this.getBanPublishers()
        }

    }
</script>
