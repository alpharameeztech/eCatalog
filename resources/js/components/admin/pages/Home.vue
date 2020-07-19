<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="slug"
        class="elevation-1"
    >

         <!-- seo_title -->
            <template v-slot:item.seo_title="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.seo_title.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- seo_title end-->

          <!-- seo_description -->
            <template v-slot:item.seo_description="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.seo_description.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- seo_description end-->

          <!-- page description -->
            <template v-slot:item.description="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.description.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- page description end-->

        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Home Page</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="50%">
                    <template v-slot:activator="{ on }" v-if="!desserts.length">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Add Home Page Info</v-btn>
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
                                                <v-col cols="12" sm="12" md="12" class="home">
                                                    <v-text>Page Description</v-text>
                                                    <vue-editor id="editor" useCustomImageHandler v-model="htmlForEditor"> </vue-editor>
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
                                                    <v-text>Page Description in Arabic</v-text>
                                                    <vue-editor id="editor2" useCustomImageHandler v-model="htmlForEditor2"></vue-editor>
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
                        text: 'Seo Title',
                        align: 'left',
                        sortable: false,
                        value: 'seo_title',
                    },
                    {
                        text: 'Seo Description',
                        align: 'left',
                        sortable: false,
                        value: 'seo_description',
                    },
                    {
                        text: 'Page Description',
                        align: 'left',
                        sortable: false,
                        value: 'description',
                    },
                    // {text: 'Updated At', value: 'updated_at'},
                    // {text: 'Created At', value: 'created_at'},
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
                }
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add Home Page Info' : 'Edit Home Page Info'
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

                axios.get('/api/home')
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
                this.htmlForEditor = item.description.en
                this.htmlForEditor2 = item.description.ar
                if(this.editedItem.seo_title != null){
                    this.editedItem.seo_title = item.seo_title.en
                    this.editedItem.arabic_seo_title = item.seo_title.ar
                }
                if(this.editedItem.seo_description != null){
                    this.editedItem.seo_description = item.seo_description.en
                    this.editedItem.arabic_seo_description = item.seo_description.ar
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
                    axios.patch('/api/home/page/' + this.editedItem.id, {
                        description: this.htmlForEditor,
                        arabic_description : this.htmlForEditor2,
                        seo_title: this.editedItem.seo_title,
                        arabic_seo_title: this.editedItem.arabic_seo_title,
                        seo_description: this.editedItem.seo_description,
                        arabic_seo_description: this.editedItem.arabic_seo_description,
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

                    axios.post('/api/home/page', {
                        description: this.htmlForEditor,
                        arabic_description : this.htmlForEditor2,
                        seo_title: this.editedItem.seo_title,
                        arabic_seo_title: this.editedItem.arabic_seo_title,
                        seo_description: this.editedItem.seo_description,
                        arabic_seo_description: this.editedItem.arabic_seo_description,
                    })
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

                    this.initialize()
                }
                this.close()
            },

            },
            ago(date){

                moment.locale();

                return moment.utc(date).fromNow();

            },

    }
</script>

<style>
.home .ql-image{
    display: none !important;
}
.ql-editor{
    color: #000;
}
</style>
