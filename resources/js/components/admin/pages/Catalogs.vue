<template>
    <div>

        <v-card>
        <v-card-title>
            Catalogs
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

        <!-- store name -->
            <template v-slot:item.store_id="{ item }">
                <v-text>{{ item.store.name.en }} </v-text>
            </template>
        <!-- store name end-->

             <!-- featured -->
            <template v-slot:item.featured="{ item }">
                <v-text>{{ isFeatured(item.featured) }} </v-text>
            </template>
        <!-- featured end-->

        <!-- description name -->
            <template v-slot:item.description="{ item }">
                <v-text>{{ item.description.en }} </v-text>
            </template>
        <!-- description name end-->

        <!-- start at -->
            <template v-slot:item.start_at="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.start_at.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- start at end-->

        <!-- end at -->
            <template v-slot:item.end_at="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text v-if="item.end_at != null"> {{item.end_at.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- end at end-->

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
                            <v-btn color="primary" dark class="mb-2" v-on="on">Add a Catalog</v-btn>
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
                                                    <v-text-field v-model="editedItem.seo_title" label="SEO title"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-textarea
                                                        v-model="editedItem.seo_description"
                                                        outlined
                                                        name="input-7-4"
                                                        label="SEO description"
                                                        ></v-textarea>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                     <v-select
                                                        v-model="editedItem.tags"
                                                        :items="tags"
                                                        item-text="name.en"
                                                        item-value="id"
                                                        label="Select tags"
                                                        multiple
                                                        >
                                                     </v-select>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <p>Start date</p>
                                                    <v-date-picker v-model="editedItem.start_at" label="Select end date"></v-date-picker>
                                                </v-col>
                                                 <v-col cols="12" sm="12" md="12">
                                                     <p>
                                                         <v-switch
                                                            v-model="for_unlimited_time"
                                                            label="Set this catalog for unlimited time"
                                                            ></v-switch>
                                                     </p>
                                                    <p v-if="!for_unlimited_time">Expiry date</p>
                                                    <v-date-picker v-model="editedItem.end_at" v-if="!for_unlimited_time" label="Select end date"></v-date-picker>
                                                </v-col>

                                                <v-col cols="12" sm="12" md="12">
                                                    <p>
                                                        <v-switch
                                                            v-model="editedItem.featured"
                                                            label="Set this catalog as featured"
                                                        ></v-switch>
                                                    </p>
                                                    <p v-if="editedItem.featured">Set expiry date of the featured one</p>
                                                    <v-date-picker v-model="editedItem.featured_expiry_at" v-if="editedItem.featured" label="Select end date"></v-date-picker>
                                                </v-col>

                                                <v-col cols="12" sm="12" md="12">
                                                    <!-- <v-select

                                                        v-model="editedItem.store"
                                                        :items="stores"
                                                        item-text="name.en"
                                                        item-value="id"
                                                        label="Select Store"
                                                        persistent-hint
                                                        return-object
                                                        single-line
                                                        ></v-select> -->

                                                        <v-autocomplete
                                                            v-model="editedItem.store"
                                                            :items="stores"
                                                            item-value="id"
                                                            :filter="customFilter"
                                                            item-text="name.en"
                                                            return-object
                                                            label="Store"
                                                            @change="storeSelected"
                                                        ></v-autocomplete>

                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-autocomplete
                                                        v-model="editedItem.country_id"
                                                        :items="countries"
                                                        item-value="id"
                                                        :filter="customFilter"
                                                        item-text="name.en"
                                                        return-object
                                                        label="Select Country"
                                                    ></v-autocomplete>
                                                </v-col>

                                                <v-col cols="12" sm="12" md="12">
                                                    <v-autocomplete
                                                        v-model="editedItem.city_id"
                                                        :items="cities"
                                                        item-value="id"
                                                        :filter="customFilter"
                                                        item-text="name.en"
                                                        return-object
                                                        label="Select City"
                                                    ></v-autocomplete>
                                                </v-col>

                                                <v-col cols="12" sm="12" md="12">
                                                     <v-select
                                                        v-model="editedItem.branches"
                                                        :items="branches"
                                                        item-text="name.en"
                                                        item-value="id"
                                                        label="Select branches"
                                                        multiple
                                                        >
                                                     </v-select>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-textarea
                                                        v-model="editedItem.description"
                                                        outlined
                                                        name="input-7-4"
                                                        label="Description"
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
                                                            <v-text-field v-model="editedItem.arabic_seo_title" label="SEO title in Arabic"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-textarea
                                                            v-model="editedItem.arabic_seo_description"
                                                            outlined
                                                            name="input-7-4"
                                                            label="SEO description in Arabic"
                                                        ></v-textarea>
                                                    </v-col>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-text-field v-model="editedItem.arabic_start_at" label="Select start date in Arabic"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-text-field v-model="editedItem.arabic_end_at" v-if="!for_unlimited_time" label="Select end date in Arabic or leave it blank if its for unlimited time"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-textarea
                                                            v-model="editedItem.arabic_description"
                                                            outlined
                                                            name="input-7-4"
                                                            label="Description in Arabic"
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
import stores_api from "../../../mixins/apis/store";
import tags_api from "../../../mixins/apis/tags";
import branches_api from "../../../mixins/apis/branches";
import cities_api from "../../../mixins/apis/cities";
import countries_api from "../../../mixins/apis/countries";
import moment from 'moment';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        mixins: [tags_api, stores_api, branches_api, cities_api, countries_api],
        data() {
            return {
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
                    },
                    {text: 'Slug', value: 'slug', width: 300},
                    {text: 'Store', value: 'store_id'},
                    {text: 'Status', value: 'status'},
                    {text: 'Featured', value: 'featured'},
                    {text: 'Description', value: 'description'},
                    {text: 'Starting from', value: 'start_at'},
                    {text: 'End on', value: 'end_at'},
                    {text: 'Total Views', value: 'total_views'},
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
                }
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add a Catalog' : 'Edit a Catalog'
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
                if(this.editedItem.end_at != null){
                    this.editedItem.end_at = item.end_at.en
                    this.editedItem.arabic_end_at = item.end_at.ar
                }
                this.editedItem.description = item.description.en
                this.editedItem.arabic_description = item.description.ar
                if(this.editedItem.seo_tags != null){
                    this.editedItem.seo_title = item.seo_tags.title.en
                    this.editedItem.arabic_seo_title = item.seo_tags.title.ar
                    this.editedItem.seo_description = item.seo_tags.description.en
                    this.editedItem.arabic_seo_description = item.seo_tags.description.ar
                }
                if(this.editedItem.end_at == null){
                    this.for_unlimited_time = true
                }
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
                    formData.append('id',this.editedItem.id);
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)

                    var self = this
                    this.desserts.push(this.editedItem)
                   // alert(this.editedItem.city_id.id);return;
                    //send the form data to server
                    axios.patch('/api/catalog/'+ this.editedItem.slug, {
                        name: this.editedItem.name,
                        arabic_name: this.editedItem.arabic_name,
                        description: this.editedItem.description,
                        arabic_description: this.editedItem.arabic_description,
                        start_at: this.editedItem.start_at,
                        arabic_start_at: this.editedItem.arabic_start_at,
                        end_at: this.editedItem.end_at,
                        arabic_end_at: this.editedItem.arabic_end_at,
                        store: this.editedItem.store,
                        city: this.editedItem.city_id,
                        country: this.editedItem.country_id,
                        seo_title: this.editedItem.seo_title,
                        arabic_seo_title: this.editedItem.arabic_seo_title,
                        seo_description: this.editedItem.seo_description,
                        arabic_seo_description: this.editedItem.arabic_seo_description,
                        for_unlimited_time: this.for_unlimited_time,
                        tags: this.editedItem.tags,
                        branches: this.editedItem.branches,
                        featured: this.editedItem.featured,
                        featured_expiry_at: this.editedItem.featured_expiry_at,
                        page_description: this.editorData,
                        page_arabic_description : this.arabicEditorData
                    })
                    .then(function (response) {

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


                } else {
                    var self = this
                    this.$root.$emit('loading', true);
                    //alert(this.editedItem.start_at);return;
                    this.desserts.push(this.editedItem)

                    //send the form data to server
                    axios.post('/api/catalog', {
                        name: this.editedItem.name,
                        arabic_name: this.editedItem.arabic_name,
                        description: this.editedItem.description,
                        arabic_description: this.editedItem.arabic_description,
                        start_at: this.editedItem.start_at,
                        arabic_start_at: this.editedItem.arabic_start_at,
                        end_at: this.editedItem.end_at,
                        arabic_end_at: this.editedItem.arabic_end_at,
                        store: this.editedItem.store,
                        city: this.editedItem.city_id,
                        country: this.editedItem.country_id,
                        seo_title: this.editedItem.seo_title,
                        arabic_seo_title: this.editedItem.arabic_seo_title,
                        seo_description: this.editedItem.seo_description,
                        arabic_seo_description: this.editedItem.arabic_seo_description,
                        for_unlimited_time: this.for_unlimited_time,
                        tags: this.editedItem.tags,
                        branches: this.editedItem.branches,
                        featured: this.editedItem.featured,
                        featured_expiry_at: this.editedItem.featured_expiry_at,
                        page_description: this.editorData,
                        page_arabic_description : this.arabicEditorData
                    })
                    .then(function (response) {

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
                }

            },
            toggleBan(item){
                var self = this

                this.$root.$emit('loading', true);

                axios.patch('/api/toggle/catalog/status', {
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

            }

        },

        mounted() {

            this.initialize()

        }

    }
</script>
