<template>
    <div>

        <v-card>
        <v-card-title>
            Advertisements
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

        <!-- image -->
            <template v-slot:item.image="{ item }">
                <v-row  class=" d-flex justify-start">
                    <!-- v-show="item.image.en != 'undefined' " -->
                    <v-col v-show="item.image.en != 'null' " cols="12" sm="12" md="12" >
                        <v-img  :src="storeImage(item.image.en)" ></v-img>
                    </v-col>
                </v-row>
            </template>
        <!-- image end-->

        <!-- url -->
            <template v-slot:item.url="{ item }">
                <v-text v-show="item.url.en != 'undefined' ">{{ item.url.en }} </v-text>
            </template>
        <!-- url end-->

        <!-- ad -->
            <template v-slot:item.ad="{ item }" >
                <v-text  v-show="item.ad.en != 'undefined' ">{{ item.ad.en }} </v-text>
            </template>
        <!-- ad end-->

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
                    <v-dialog v-model="dialog" max-width="45%">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark class="mb-2" v-on="on">Add an Advertisement</v-btn>
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
                                                    <v-select
                                                        v-model="location"
                                                        :items="locations"
                                                        label="Location"
                                                    ></v-select>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.url" label="URL"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-file-input
                                                        v-model="file"
                                                        label="Select Banner"
                                                        accept="image/*"
                                                        @change="onFileChange"
                                                    ></v-file-input>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-textarea
                                                        v-model="editedItem.ad"
                                                        outlined
                                                        name="input-7-4"
                                                        label="Ad"
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
                                                        <v-text-field v-model="editedItem.arabic_url" label="URL for arabic banner"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-file-input
                                                            v-model="arabic_file"
                                                            label="Select Arabic Banner"
                                                            accept="image/*"
                                                            @change="onArabicFileChange"
                                                        ></v-file-input>
                                                    </v-col>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-textarea
                                                            v-model="editedItem.arabic_ad"
                                                            outlined
                                                            name="input-7-4"
                                                            label="Ad in Arabic"
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
import stores_api from "../../../mixins/apis/store";
import tags_api from "../../../mixins/apis/tags";
import branches_api from "../../../mixins/apis/branches";
import moment from 'moment';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        mixins: [tags_api, stores_api, branches_api],
        data() {
            return {
                location: '',
                locations: ['store-left-section', 'store-right-section', 'catalog-small-section', 'catalog-large-section', 'blog-right-section'],
                editor: ClassicEditor,
                editorData: '',
                arabicEditorData: '',
                editorConfig: {
                },
                search: '',
                for_unlimited_time: false,
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
                        text: 'Image',
                        sortable: true,
                        value: 'image',
                    },
                    {text: 'URL', value: 'url', width: 300},
                    {text: 'Ad', value: 'ad'},
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
                    description: '',
                    arabic_description: '',
                    start_at: '',
                    arabic_start_at: '',
                    end_at: '',
                    arabic_end_at: '',
                    seo_title: '',
                    arabic_seo_title: '',
                    seo_description: '',
                    arabic_seo_description: '',
                },
                defaultItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                },
                avatar: false,
                arabicAvatar:'',
                file: null,
                arabicFile: null,
                imageUrl: null,
                arabicImageUrl: null,
                profilePicture: '',
                arabicProfilePicture: ''
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add an Advertisement' : 'Edit an Advertisement'
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

                axios.get('/api/advertisements')
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
                this.editedItem.url = item.url.en
                this.editedItem.arabic_url = item.url.ar
                this.editedItem.ad = item.ad.en
                this.editedItem.arabic_ad = item.ad.ar

                if(this.editedItem.page != null){
                    this.editorData = this.editedItem.page.description.en
                    this.arabicEditorData = this.editedItem.page.description.ar
                }
                this.location = this.editedItem.location
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
                this.profilePicture = ''
            },

            save () {
                var self = this;

                this.$root.$emit('loading', true);

                let formData = new FormData();
                /*
                    Add the form data we need to submit
                */

                    var self = this
                    this.$root.$emit('loading', true);

                    /*
                        Add the form data we need to submit
                    */
                    formData.append('location', this.location);
                    formData.append('banner', this.profilePicture);
                    formData.append('arabic_banner', this.arabicProfilePicture);
                    formData.append('url', this.editedItem.url);
                    formData.append('arabic_url', this.editedItem.arabic_url);
                    formData.append('ad', this.editedItem.ad);
                    formData.append('arabic_ad', this.editedItem.arabic_ad);

                     if (this.editedIndex > -1) {
                        formData.append('id',this.editedItem.id);
                        Object.assign(this.desserts[this.editedIndex], this.editedItem)

                        var self = this
                        this.desserts.push(this.editedItem)


                    } else {
                        var self = this
                        this.desserts.push(this.editedItem)
                    }

                    //alert(this.editedItem.start_at);return;
                    this.desserts.push(this.editedItem)

                    //send the form data to server
                    axios.post('/api/advertisements', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'enctype' : 'multipart/form-data'
                        }
                    }).then(function (response) {

                        self.$root.$emit('loading', false)

                        flash('Changes Saved')

                        self.initialize()

                    })
                    .catch(function (error) {

                        self.$root.$emit('loading', false)

                        flash(error.response.data.errors, 'error');

                    })
                    .finally(function () {
                        self.$root.$emit('loading', false)

                    });
                    this.close()
                    this.initialize()

            },
            toggleBan(item){
                var self = this

                this.$root.$emit('loading', true);

                axios.patch('/api/toggle/advertisements/status', {
                    id: item.id,
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
            isFeatured(isFeatured){
                if(isFeatured){
                    return 'Yes'
                }
                else{
                    return 'No'
                }
            },
            customFilter (item, queryText, itemText) {
                const textOne = item.name.en.toLowerCase()
                const textTwo = item.name.en.toLowerCase()
                const searchText = queryText.toLowerCase()

                return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(searchText) > -1
            },
            storeSelected () {

                var store = this.editedItem.store

                var self = this;

                self.$root.$emit('loading', true);

                axios.get('/api/store/'+ store.slug + '/branches')
                    .then(function (response) {
                        self.branches = response.data
                    })
                    .catch(function (error) {

                    })
                    .finally(function () {
                        self.$root.$emit('loading', false);
                    });

            },
            onFileChange() {
                let reader = new FileReader()
                reader.onload = () => {
                    this.imageUrl = reader.result
                }
                reader.readAsDataURL(this.file)
                this.profilePicture = this.file
            },
            onArabicFileChange() {
                let reader = new FileReader()
                reader.onload = () => {
                    this.arabicImageUrl = reader.result
                }
                reader.readAsDataURL(this.arabic_file)
                this.arabicProfilePicture = this.arabic_file
            },
            storeImage(image){
               return 'https://ecatalog.s3-ap-southeast-1.amazonaws.com/' + image;
            }

        },

        mounted() {

            this.initialize()

        }

    }
</script>
