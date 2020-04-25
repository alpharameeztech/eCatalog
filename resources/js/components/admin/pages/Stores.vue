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
          <template v-slot:item.name="{ item }">

                    <v-row  class="d-flex justify-start">
                        <v-col cols="12" sm="4" md="4">
                          
                            <v-text>  {{ parseNameInEnglish(item)}} </v-text>
                        </v-col>

                    </v-row>

            </template>
        <!-- status -->
            <template v-slot:item.status="{ item }">

                    <v-row  class="d-flex justify-start">
                        <v-col cols="12" sm="4" md="4">

                            <v-switch
                                v-model=" item.status "
                                color="success"
                                @change="toggleBan(item)"
                            ></v-switch>

                        </v-col>

                    </v-row>

            </template> 
        <!-- status -->
        
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
                                                    <v-text-field v-model="editedItem.twitter_link" label="Twitter Page"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.instagram_link" label="Instagram Page"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.youtube_link" label="Youtube Page"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-textarea
                                                        v-model="editedItem.about"
                                                        outlined
                                                        name="input-7-4"
                                                        label="About us in English"
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
                                                        <v-textarea
                                                            v-model="editedItem.arabic_about"
                                                            outlined
                                                            name="input-7-4"
                                                            label="About us in Arabic"
                                                            ></v-textarea>
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
                        width: 250
                    },
                    { text: 'Slug', value: 'slug'},
                    { text: 'Image', value: 'image'},
                    { text: 'Website Link', value: 'website_link'},
                    {text: 'Facebook Link', value: 'facebook_link'},
                    {text: 'Twitter Link', value: 'twitter_link'},
                    {text: 'Instagram Link', value: 'instagram_link'},
                    {text: 'Youtube Link', value: 'youtube_link'},
                    {text: 'About', value: 'about'},
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
                    arabic_name:'',
                    website_link: '',
                    facebook_link: '',
                    instagram_link: '',
                    youtube_link: '',
                    twitter_link: '',
                    about: '',
                    arabic_about:'',
                    profilePicture: ''
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

                        console.log(response.data[0].name.en)
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

            parseNameInEnglish(item){
                return item.name.en
            },
            parseNameInArabic(item){
                return item.name.ar
            },

            editItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.editedItem.name =   this.parseNameInEnglish(item)
                this.editedItem.arabic_name =   this.parseNameInArabic(item)
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.desserts.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
            },

            close () {
                var self = this
                self.$root.$emit('loading', false)
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
                formData.append('name', this.editedItem.name);
                formData.append('arabicName', this.editedItem.arabic_name);
                formData.append('websiteLink', this.editedItem.website_link);
                formData.append('facebookLink', this.editedItem.facebook_link);
                formData.append('instagramLink', this.editedItem.instagram_link);
                formData.append('youtubeLink', this.editedItem.youtube_link);
                formData.append('twitterLink', this.editedItem.twitter_link);
                formData.append('about', this.editedItem.about);
                formData.append('arabicAbout', this.editedItem.arabic_about);
               
                if (this.editedIndex > -1) {
                    formData.append('id',this.editedItem.id);
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    
                    var self = this
                    this.$root.$emit('loading', true);

                    this.desserts.push(this.editedItem)
                    

                } else {
                    var self = this
                    this.$root.$emit('loading', true);

                    this.desserts.push(this.editedItem)
                }

                //send the form data to server
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
            
            toggleBan(item){
                var self = this

                this.$root.$emit('loading', true);
                
                axios.patch('/api/toggle/store/status', {
                    id: item.id,
                    status: item.status
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

            },

        },

        mounted() {

            this.initialize()

            this.getBanPublishers()
        }

    }
</script>
