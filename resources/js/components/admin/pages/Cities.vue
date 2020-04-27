<template>
    <div>

        <v-card>
        <v-card-title>
            Cities
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
      
        <!-- name -->  
            <template v-slot:item.name="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.name.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- name end-->

        <!-- country name -->
            <template v-slot:item.country="{ item }">
                     <v-text>{{ item.country.name.en }} </v-text>
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


        
        
       
        <!-- add/update city -->
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
                        <v-btn color="primary" dark class="mb-2" v-on="on">Add City</v-btn>
                    </template>
                     <v-tabs
                            fixed-tabs
                            background-color="indigo"
                            dark
                        >
                        <v-tabs-slider></v-tabs-slider>
                            <v-tab>
                            English
                            </v-tab>
                            <v-tab>
                            Arabic
                            </v-tab>

                            <!-- english tab item -->
                            <v-tab-item>
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
                                                    <v-select
                                                        v-model="editedItem.country"
                                                        :items="countries"
                                                        item-text="name.en"
                                                        item-value="id"
                                                        label="Select Country"
                                                        persistent-hint
                                                        return-object
                                                        single-line
                                                    ></v-select>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-tab-item>
                            <!-- english tab item end -->

                            <!-- arbaic tab item -->
                            <v-tab-item>
                                 <v-card>
                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.arabic_name" label="Name in Arabic"></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>
                                </v-card>
                            </v-tab-item>
                             <!-- arbaic tab item end -->
                     </v-tabs>
                            
                   
                </v-dialog>
                </v-toolbar>
            </template>
        <!-- add/update city end -->

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
                    { text: 'Country', value: 'country'},
                    {text: 'Updated At', value: 'updated_at', width: 250},
                    {text: 'Created At', value: 'created_at', width: 250},
                    {text: 'Actions', value: 'action', sortable: false},
                ],
                desserts: [],
                banPublishers:[],
                editedIndex: -1,
                editedItem: {
                    id:'',
                    country_id:'',
                    name: '',
                    arabic_name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
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
                return this.editedIndex === -1 ? 'Add City' : 'Edit City'
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

                axios.get('/api/cities')
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
               // alert(item.country_id);
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.editedItem.name = item.name.en
                this.editedItem.arabic_name = item.name.ar
                //this.editedItem.country_id = item.country_id
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
                
                this.$root.$emit('loading', true);

                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)

                    var self = this
                    

                    axios.patch('/api/cities', {
                        id: this.editedItem.id,
                        name: this.editedItem.name,
                        arabic_name: this.editedItem.arabic_name,
                        country: this.editedItem.country
                    })
                        .then(function (response) {
                            flash('Changes Saved.', 'success');

                            self.initialize()

                        })
                        .catch(function (error) {

                        })
                        .finally( function() {
                            
                            self.$root.$emit('loading', false);
                        });


                } else {
                    var self = this

                    this.desserts.push(this.editedItem)
                    
                    axios.post('/api/cities', {
                        name: this.editedItem.name,
                        arabic_name: this.editedItem.arabic_name,
                        country: this.editedItem.country
                    })
                        .then(function (response) {
                            self.initialize()
                            flash('Changes Saved.', 'success');
                        })
                        .catch(function (error) {
                            flash('Changes Saved.', 'error');
                        })
                        .finally( function() {
                            self.$root.$emit('loading', false);
                        });

                    this.initialize()
                }
                this.close()
            },

        },

        mounted() {

            this.initialize()

        }

    }
</script>
