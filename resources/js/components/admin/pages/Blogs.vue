<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="slug"
        class="elevation-1"
    >
        <!-- Title -->
            <template v-slot:item.title="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.title.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- title end-->

        <!-- status -->
            <template v-slot:item.status="{ item }">

                    <v-row  class="d-flex justify-start">
                        <v-col cols="12" sm="4" md="4">

                            <v-switch
                                v-model=" item.status "
                                color="success"
                                @change="toggleStatus(item)"
                            ></v-switch>

                        </v-col>

                    </v-row>

            </template>
        <!-- status -->

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

        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Blogs</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="50%">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Add Blog</v-btn>
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
                                                    <v-file-input
                                                        v-model="file"
                                                        label="Select Logo"
                                                        accept="image/*"
                                                        @change="onFileChange"
                                                    ></v-file-input>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field v-model="editedItem.title" label="Title"></v-text-field>
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
                                                    <v-text>Description</v-text>
                                                    <vue-editor id="editor" useCustomImageHandler @image-added="handleImageAdded" v-model="htmlForEditor"> </vue-editor>
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
                                                    <v-text-field v-model="editedItem.arabic_title" label="Title in Arabic"></v-text-field>
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
                                                    <v-text>Description in Arabic</v-text>
                                                    <vue-editor id="editor2" useCustomImageHandler @image-added="handleImageAdded" v-model="htmlForEditor2"></vue-editor>
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
        <template v-slot:item.action="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
            >
                edit
            </v-icon>
        </template>

    </v-data-table>
</template>
<script>
import moment from 'moment';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { VueEditor } from "vue2-editor";
    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                htmlForEditor: '',
                htmlForEditor2:'',
                editor: ClassicEditor,
                editorData: '',
                arabicEditorData: '',
                editorConfig: {

                },
                countries: '',
                dialog: false,
                countries: [],
                headers: [
                    {
                        text: 'Id',
                        value: 'id',
                    },
                    {
                        text: 'Title',
                        align: 'left',
                        sortable: false,
                        value: 'title',
                    },
                    {text: 'Slug', value: 'slug', width: 300},
                    {text: 'Status', value: 'status', width: 300},
                    {text: 'Updated At', value: 'updated_at'},
                    {text: 'Created At', value: 'created_at'},
                    {text: 'Actions', value: 'action', sortable: false},
                ],
                desserts: [],
                editedIndex: -1,
                editedItem: {
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
                },
                avatar: false,
                file: null,
                imageUrl: null,
                profilePicture: '',
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add Blog' : 'Edit Blog'
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
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                var self = this;
                var formData = new FormData();
                formData.append("image", file);
                this.$root.$emit('loading', true);
                axios({
                    url: "/api/blog/upload/image",
                    method: "POST",
                    data: formData
                })
                .then(result => {
                    let url = result.data; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                    self.$root.$emit('loading', false)
                })
                .catch(err => {
                    console.log(err);
                    self.$root.$emit('loading', false)

                });
            },
            initialize () {

                var self = this;

                this.$root.$emit('loading', true);

                axios.get('/api/blogs')
                    .then(function (response) {

                        self.desserts = response.data;

                        self.$root.$emit('loading', false);

                    })
                    .catch(function (error) {

                        console.info('error');

                    })
                    .finally( function() {
                        self.$root.$emit('loading', false);
                    });

            },

            editItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.editedItem.title = item.title.en
                this.editedItem.arabic_title = item.title.ar
                this.htmlForEditor = item.body.en
                this.htmlForEditor2 = item.body.ar
                if(this.editedItem.seo_tags != null){
                    this.editedItem.seo_title = item.seo_tags.title.en
                    this.editedItem.arabic_seo_title = item.seo_tags.title.ar
                    this.editedItem.seo_description = item.seo_tags.description.en
                    this.editedItem.arabic_seo_description = item.seo_tags.description.ar
                }
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
                }, 300)
                this.htmlForEditor = ''
                this.htmlForEditor2 = ''

            },

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)

                    var self = this
                    this.$root.$emit('loading', true);

                    let formData = new FormData();
                    /*
                        Add the form data we need to submit
                    */
                    formData.append('id',this.editedItem.id);
                    formData.append('profilePicture', this.profilePicture);
                    formData.append('title', this.editedItem.title);
                    formData.append('arabic_title', this.editedItem.arabic_title);
                    formData.append('body', this.htmlForEditor);
                    formData.append('arabic_body', this.htmlForEditor2);
                    formData.append('seo_title', this.editedItem.seo_title);
                    formData.append('arabic_seo_title', this.editedItem.arabic_seo_title);
                    formData.append('seo_description', this.editedItem.seo_description);
                    formData.append('arabic_seo_description', this.editedItem.arabic_seo_description);

                    axios.post('/api/blog', formData,{
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'enctype' : 'multipart/form-data'
                        }
                    })
                        .then(function (response) {
                            flash('Changes Saved.', 'success');

                            self.initialize()

                        })
                        .catch(function (error) {
                            self.$root.$emit('loading', false)
                            flash(error.response.data.errors, 'error');
                        })
                        .finally( function() {
                            self.$root.$emit('loading', false);
                        });


                } else {
                    var self = this

                    this.$root.$emit('loading', true);

                    this.desserts.push(this.editedItem)

                    let formData = new FormData();
                    /*
                        Add the form data we need to submit
                    */
                    formData.append('profilePicture', this.profilePicture);
                    formData.append('title', this.editedItem.title);
                    formData.append('arabic_title', this.editedItem.arabic_title);
                    formData.append('body', this.htmlForEditor);
                    formData.append('arabic_body', this.htmlForEditor2);
                    formData.append('seo_title', this.editedItem.seo_title);
                    formData.append('arabic_seo_title', this.editedItem.arabic_seo_title);
                    formData.append('seo_description', this.editedItem.seo_description);
                    formData.append('arabic_seo_description', this.editedItem.arabic_seo_description);

                    axios.post('/api/blog', formData,{
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'enctype' : 'multipart/form-data'
                        }
                    })
                        .then(function (response) {
                            flash('Changes Saved.', 'success');

                            self.initialize()

                        })
                        .catch(function (error) {
                            self.$root.$emit('loading', false)
                            flash(error.response.data.errors, 'error');
                        })
                        .finally( function() {
                            self.$root.$emit('loading', false);
                        });


                    // axios.post('/api/blog', formData, {
                    //     headers: {
                    //         'Content-Type': 'multipart/form-data',
                    //         'enctype' : 'multipart/form-data'
                    //     }
                    // })
                    //     .then(function (response) {
                    //
                    //        self.initialize()
                    //
                    //        flash('Changes Saved.', 'success');
                    //     })
                    //     .catch(function (error) {
                    //         flash(error.response.data.errors, 'error');
                    //     })
                    //     .finally( function() {
                    //         self.$root.$emit('loading', false);
                    //     });

                    this.initialize()
                }
                this.close()
            },
            toggleStatus(item){
                var self = this

                this.$root.$emit('loading', true);
                console.log(this.editedItem)
                axios.patch('/api/toggle/blog/' + item.slug + '/status')
                .then(function (response) {

                    self.initialize()

                    flash('Changes Saved.', 'success');
                })
                .catch(function (error) {

                    flash(error.response.data.errors, 'error');

                })
                .finally( function() {
                    self.$root.$emit('loading', false);
                });

            },
            ago(date){

                moment.locale();

                return moment.utc(date).fromNow();

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

    }
</script>
