<template>
    <div>

        <v-card>
        <v-card-title>
            Malls
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

        <!-- city name -->
            <template v-slot:item.city_id="{ item }">
                     <v-text>{{ item.city.name.en }} </v-text>
            </template>
        <!-- city name end-->

        <!-- address -->  
            <template v-slot:item.address="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        
                        <v-text> {{item.address.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- address end-->

        <!-- opening hours -->  
            <template v-slot:item.opening_hours="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        
                        <v-text> {{item.opening_hours.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- opening hours end-->

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
                    <v-dialog v-model="dialog" max-width="50%">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark class="mb-2" v-on="on">Add Mall</v-btn>
                        </template>

                        <!-- tabs -->
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
                                                    <v-text-field v-model="editedItem.telephone" label="Telephone"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.opening_hours" label="Opening Hours"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.map_location" label="Location in Map"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <!-- <v-select
                                                        v-model="editedItem.city"
                                                        :items="cities"
                                                        item-text="name.en"
                                                        item-value="id"
                                                        label="Select City"
                                                        persistent-hint
                                                        return-object
                                                        single-line
                                                        ></v-select> -->
                                                        <v-autocomplete
                                                            v-model="editedItem.city"
                                                            :items="cities"
                                                            item-value="id"
                                                            :filter="customFilter"
                                                            item-text="name.en"
                                                            return-object
                                                            label="Select City"
                                                        ></v-autocomplete>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-textarea
                                                        v-model="editedItem.address"
                                                        outlined
                                                        name="input-7-4"
                                                        label="Address"
                                                        ></v-textarea>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text>Page Description</v-text>
                                                    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
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
                            </v-tab-item>
                            <!-- english tab item end -->

                            <!-- Arabic tab item -->
                            <v-tab-item>

                                    <v-card>
                                   
                                        <v-card-text>
                                            <v-container>
                                                <v-row>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.arabic_name" label="Name in Arabic"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.arabic_opening_hours" label="Opening Hours in Arabic"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-textarea
                                                        v-model="editedItem.arabic_address"
                                                        outlined
                                                        name="input-7-4"
                                                        label="Address in Arabic"
                                                        ></v-textarea>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text>Arabic Page Description</v-text>
                                                    <ckeditor :editor="editor" v-model="arabicEditorData" :config="editorConfig"></ckeditor>
                                                </v-col>
                                            </v-row>
                                            </v-container>
                                        </v-card-text>

                                 </v-card>

                            </v-tab-item>
                            <!-- Arabic tab item end-->

                        </v-tabs>
                        <!-- tabs end -->
                      
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        mixins: [api],
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
                arabicEditorData: '',
                editorConfig: {
                },
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
                        sortable: true,
                        value: 'name',
                        width: 500
                    },
                    { text: 'Slug', value: 'slug', width: 300},
                    { text: 'Address', value: 'address',width: 500},
                    {text: 'Telephone', value: 'telephone'},
                    {text: 'Opening Hours', value: 'opening_hours', width: 500},
                    {text: 'Map Location', value: 'map_location'},
                    {text: 'City', value: 'city_id'},,
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
                    arabic_name:'',
                    address: '',
                    arabic_address: '',
                    telephone: '',
                    opening_hours: '',
                    arabic_opening_hours: '',
                    map_location: '',
                    city_id:'',
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
                return this.editedIndex === -1 ? 'Add Mall' : 'Edit Mall'
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

                axios.get('/api/malls')
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
                this.editedItem.name = item.name.en
                this.editedItem.arabic_name = item.name.ar
                this.editedItem.address = item.address.en
                this.editedItem.arabic_address = item.address.ar
                this.editedItem.opening_hours = item.opening_hours.en
                this.editedItem.arabic_opening_hours = item.opening_hours.ar
                if(this.editedItem.page != null){
                    this.editorData = this.editedItem.page.description.en
                    this.arabicEditorData = this.editedItem.page.description.ar
                }
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.desserts.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
            },

            close () {
                var self = this
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                    this.ban= ''
                }, 300)
                this.editorData = ''
                this.arabicEditorData = ''
            },

            save () {
                var self = this;

                this.$root.$emit('loading', true);

                let formData = new FormData();
                /*
                    Add the form data we need to submit
                */
               
                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    
                    var self = this

                    this.desserts.push(this.editedItem)
                   // alert(this.editedItem.city_id.id);return;
                    //send the form data to server
                   axios.patch('/api/mall', {
                        id: this.editedItem.id,
                        name: this.editedItem.name,
                        arabicName: this.editedItem.arabic_name,
                        address: this.editedItem.address,
                        arabicAddress: this.editedItem.arabic_address,
                        telephone: this.editedItem.telephone,
                        openingHours: this.editedItem.opening_hours,
                        arabicOpeningHours: this.editedItem.arabic_opening_hours,
                        mapLocation: this.editedItem.map_location,
                        city: this.editedItem.city,
                        description: this.editorData,
                        arabic_description : this.arabicEditorData
                    })
                    .then(function (response) {

                        self.$root.$emit('loading', false)

                        flash('Changes Saved')

                        self.initialize()

                    })
                    .catch(function (error) {

                        self.$root.$emit('loading', false)
                        console.log(error)

                        flash('Changes Not Saved', 'error')
                    })
                    .finally(function () {
                        self.$root.$emit('loading', false)

                    });
                    this.close()
                    this.initialize()
                    

                } else {
                    var self = this
                    this.$root.$emit('loading', true);

                    this.desserts.push(this.editedItem)

                    //send the form data to server
                    axios.post('/api/mall',{
                        name: this.editedItem.name,
                        arabicName: this.editedItem.arabic_name,
                        address: this.editedItem.address,
                        arabicAddress: this.editedItem.arabic_address,
                        telephone: this.editedItem.telephone,
                        openingHours: this.editedItem.opening_hours,
                        arabicOpeningHours: this.editedItem.arabic_opening_hours,
                        mapLocation: this.editedItem.map_location,
                        city: this.editedItem.city,
                        description: this.editorData,
                        arabic_description : this.arabicEditorData
                    })
                    .then(function (response) {

                        self.$root.$emit('loading', false)

                        flash('Changes Saved')

                        self.initialize()

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
            customFilter (item, queryText, itemText) {
                const textOne = item.name.en.toLowerCase()
                const textTwo = item.name.en.toLowerCase()
                const searchText = queryText.toLowerCase()

                return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(searchText) > -1
            }


        },

        mounted() {

            this.initialize()

        }

    }
</script>
