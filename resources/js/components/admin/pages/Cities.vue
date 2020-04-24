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
                                                v-model="country"
                                                :items="countries"
                                                item-text="name"
                                                item-value="id"
                                                label="Select"
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
                                <v-btn color="blue darken-1" text @click="save">Send</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
        <!-- add/update city end -->

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
                   { text: 'Country', value: 'country'},
                    {text: 'Updated At', value: 'updated_at'},
                    {text: 'Created At', value: 'created_at'},
                    // {text: 'Actions', value: 'action', sortable: false},
                ],
                desserts: [],
                banPublishers:[],
                editedIndex: -1,
                editedItem: {
                    name: '',
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

                    //this.desserts.push(this.editedItem)

                    this.$root.$emit('loading', true);

                    axios.post('/api/invitation', {
                        name: this.editedItem.name,
                        alias: this.editedItem.alias,
                        email: this.editedItem.email,
                    })
                    .then(function (response) {

                        flash('Invitation Sent.', 'success');
                    })
                    .catch(function (error) {

                        flash('Invitation Not Saved.', 'error');
                    })
                    .finally(function () {
                        self.$root.$emit('loading', false);
                    });

                this.close()

            },

            toggleEditingPassword(){

                this.editingPassword = !this.editingPassword

                if(this.editingPassword == false){

                    this.password = ''
                }
            },
            toggleBan(item){

                var self = this

                this.$root.$emit('loading', true);

                axios.patch('/api/publisher', {
                    id: item.id,
                    ban: !item.is_ban
                })
                    .then(function (response) {

                        self.initialize()
                        self.getBanPublishers()
                        //self.banPublishers = []

                        flash('Changes Saved.', 'success');
                    })
                    .catch(function (error) {
                        flash('Changes Saved.', 'error');
                    })
                    .finally( function() {
                        self.$root.$emit('loading', false);
                    });

            },

            getBanPublishers () {

                var self = this;

                this.$root.$emit('loading', true);

                axios.get('/api/publishers?ban=1')
                    .then(function (response) {

                        self.banPublishers = response.data;

                        self.$root.$emit('loading', false);
                    })
                    .catch(function (error) {

                        console.info('error');

                    })
                     .finally(function () {
                        self.$root.$emit('loading', false);
                    });

            },
        },

        mounted() {

            this.initialize()

            this.getBanPublishers()
        }

    }
</script>
