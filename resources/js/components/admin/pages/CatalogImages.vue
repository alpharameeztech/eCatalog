<template>
    <div>

        <v-card>
        <v-card-title>
            Catalog Images
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
                            <v-btn color="primary" dark class="mb-2" v-on="on">Upload Images</v-btn>
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
                                            <v-file-input v-model="file" @change="selectFiles" accept="image/*" label="Select images"></v-file-input>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <p>
                                                <v-switch
                                                v-model="featured"
                                                label="Set this image as cover image"
                                                ></v-switch>
                                            </p>
                                        </v-col>

                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <!-- add image end -->

                            <!-- update images -->
                            <v-card-text v-if="editedIndex > -1">
                                <v-container>
                                    <v-text>
                                        <i> {{editedItem.name}}</i> catalog have total of <i>{{editedItem.images.length}}</i> images
                                    </v-text>
                                    <p>
                                        You can set only one image as cover image of a catalog.
                                    </p>
                                    <p>
                                        You can change the images order with drag and drop and then saving the changes.
                                    </p>
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
                                      
                                        <draggable v-model="editedItem.images" group="people" @start="drag=true" @end="drag=true">
                                            <div v-for="image in editedItem.images" :key="image.id">{{image.image}}
                                                
                                                <v-row>
                                                    <v-col cols="12" sm="1" md="1">
                                                        <v-icon>more_vert</v-icon>
                                                    </v-col>

                                                    <v-col cols="12" sm="11" md="11">
                                                        <v-img 
                                                            :src="storeImage(image)" 
                                                            aspect-ratio="1.7">
                                                        </v-img>
                                                    </v-col>

                                                    <v-row>

                                                        <v-col cols="12" sm="6" md="6">
                                                            <v-switch
                                                                v-model="image.featured"
                                                                label="cover image"
                                                                @change="toggleFeaturedImageStatus(image)"
                                                            ></v-switch>
                                                        </v-col>

                                                        <v-col cols="12" sm="6" md="6">
                                                            <v-btn color="pink darken-1" text @click="deleteImage(image)">
                                                                <v-icon>delete</v-icon>
                                                            </v-btn>
                                                        </v-col>

                                                     </v-row>

                                                </v-row>
                                              
                                            </div>
                                        </draggable>
                                            
                                    </v-row>

                                </v-container>
                            </v-card-text>
                            <!-- update images end -->
                            
                            <v-card-actions >
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Update</v-btn>
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
import draggable from 'vuedraggable';

    export default {
        components: {
            draggable,
        },
        mixins: [catalogs],
        data() {
            return {
                featured: false,
                markedAsFeatured: true,
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
                return this.editedIndex === -1 ? 'Add Image' : 'Edit Images'
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

            deleteImage (image) {

                var self = this

                this.$root.$emit('loading', true);

                axios.post('/api/delete/catalog/image', {
                    image: image
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
                    
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    
                    var self = this
                    this.desserts.push(this.editedItem)
                    //send the form data to server
                    axios.patch('/api/reorder/catalog/images', {
                        id: this.editedItem.id,
                        images: this.editedItem.images
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

                } else {
                    var self = this
                    this.$root.$emit('loading', true);
                    this.desserts.push(this.editedItem)
                    
                    let formData = new FormData();
                    formData.append('id', this.editedItem.id);
                    formData.append('file', this.file);
                    formData.append('featured', this.featured);

                    //send the form data to server
                    axios.post('/api/catalog/images', formData)
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
                console.log(image.image)
               return 'https://ecatalog.s3-ap-southeast-1.amazonaws.com/' + image.image;
            },
            toggleFeaturedImageStatus(image){
                var self = this

                this.$root.$emit('loading', true);

                axios.post('/api/toggle/featured/image', {
                    image: image
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
            }

        },

        mounted() {

            this.initialize()

        }

    }
</script>
