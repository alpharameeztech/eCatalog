<template>
    <div>

        <v-card>
        <v-card-title>
            Catalog Pdfs
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
                <v-text> {{item.name.en}} </v-text>
            </template>
        <!-- name end-->

       
        <!-- formatted created date -->    
            <template v-slot:item.created_at="{ item }">
                    <v-row  class="d-flex justify-start">
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
                <v-row  class="d-flex justify-start">
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
                            <v-btn color="primary" dark class="mb-2" v-on="on">Upload Pdf</v-btn>
                        </template>

                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>
                           
                            <!-- add image -->
                            <v-card-text v-if="editedIndex == -1">
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="12">
                                            <!-- <v-select
                                                v-model="editedItem"
                                                :items="catalogs"
                                                item-text="name.en"
                                                item-value="id"
                                                label="Select Catalog"
                                                persistent-hint
                                                return-object
                                                single-line
                                                ></v-select> -->
                                                <v-autocomplete
                                                        v-model="editedItem"
                                                        :items="catalogs"
                                                        item-value="id"
                                                        :filter="customFilter"
                                                        item-text="name.en"
                                                        return-object
                                                        label="Select Catalog"
                                                    ></v-autocomplete>
                                        </v-col>

                                        <v-col cols="12" sm="12" md="12">
                                            <v-file-input v-model="file" @change="selectFiles" accept="pdf/*" label="Select pdf"></v-file-input>
                                        </v-col>

                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <!-- add image end -->

                            <!-- update images -->
                            <v-card-text v-if="editedIndex > -1">
                                <v-container>
                                    <v-text>
                                        <i> {{editedItem.name}}</i> catalog have total of <i>{{editedItem.pdfs.length}}</i> Pdf
                                    </v-text>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-select
                                                v-model="editedItem"
                                                :items="catalogs"
                                                item-text="name.en"
                                                item-value="id"
                                                label="Select Catalog"
                                                persistent-hint
                                                return-object
                                                single-line
                                                ></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12" v-for="pdf in editedItem.pdfs" :key="pdf.id">
                                           Pdf File <a :href="storeImage(pdf)" target="_blank">{{pdf.pdf}}</a>
                                          
                                            <v-btn color="pink darken-1" text @click="deleteFile(pdf)">
                                                <v-icon>delete</v-icon>
                                            </v-btn>
                                        </v-col>
                                        
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <!-- update images end -->
                            
                            <v-card-actions v-if="editedIndex == -1">
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
import catalogs from "../../../mixins/apis/catalogs";
import moment from 'moment';

    export default {
        mixins: [catalogs],
        data() {
            return {
               
                file:'',
                search: '',
                show1: false,
                dialog: false,
                headers: [
                    
                    {
                        text: 'Id',
                        value: 'id',
                    },
                    {
                        text: 'Name',
                        sortable: true,
                        value: 'name',
                    },
                     {
                        text: 'Slug',
                        sortable: true,
                        value: 'slug',
                    },
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
                return this.editedIndex === -1 ? 'Add Pdf' : 'Edit Pdf'
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

                axios.get('/api/catalogs')
                    .then(function (response) {

                        self.desserts = response.data;

                        self.$root.$emit('loading', false);

                    })
                    .catch(function (error) {

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
                this.editedItem.start_at = item.start_at.en
                this.editedItem.arabic_start_at = item.start_at.ar
                
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
            },

            deleteFile (pdf) {

                var self = this

                this.$root.$emit('loading', true);

                axios.post('/api/delete/catalog/pdf', {
                    pdf: pdf
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

            },

            save () {
                var self = this;

                this.$root.$emit('loading', true);

                
                /*
                    Add the form data we need to submit
                */

                if (this.editedIndex > -1) {
                    formData.append('id',this.editedItem.id);
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    
                    var self = this
                    this.desserts.push(this.editedItem)
                   // alert(this.editedItem.city_id.id);return;
                    //send the form data to server
                

                } else {
                    var self = this
                    this.$root.$emit('loading', true);
                    this.desserts.push(this.editedItem)
                    
                    let formData = new FormData();
                    formData.append('id', this.editedItem.id);
                    formData.append('file', this.file);

                    //send the form data to server
                    axios.post('/api/catalog/pdf', formData)
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
           
            selectFiles(event){
                this.file = event //event[0]
                console.log(this.file)
            },
            storeImage(image){
               return 'https://ecatalog.s3-ap-southeast-1.amazonaws.com/' + image.pdf;
            },
          

        },

        mounted() {

            this.initialize()

        }

    }
</script>
