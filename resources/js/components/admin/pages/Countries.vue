<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="slug"
        class="elevation-1"
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

        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Countries</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="50%">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Add Country</v-btn>
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
                                                    <v-text>Page Description</v-text>
                                                    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
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
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text>Arabic Page Description</v-text>
                                                    <ckeditor :editor="editor" v-model="arabicEditorData" :config="editorConfig"></ckeditor>
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
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>
    </v-data-table>
</template>
<script>
import moment from 'moment';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        data() {
            return {
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
                        text: 'Name',
                        align: 'left',
                        sortable: false,
                        value: 'name',
                    },
                    {text: 'Slug', value: 'slug'},
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
                }
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add Country' : 'Edit Country'
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

                axios.get('/api/countries')
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
                this.editedItem.name = item.name.en
                this.editedItem.arabic_name = item.name.ar
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
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
                this.editorData = ''
                this.arabicEditorData = ''

            },

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    
                    var self = this
                    this.$root.$emit('loading', true);
                    axios.patch('/api/country/' + this.editedItem.slug, {
                        name: this.editedItem.name,
                        arabic_name: this.editedItem.arabic_name,
                        description: this.editorData,
                        arabic_description : this.arabicEditorData
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

                    axios.post('/api/countries', {
                        name: this.editedItem.name,
                        arabic_name: this.editedItem.arabic_name,
                        description: this.editorData,
                        arabic_description : this.arabicEditorData
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
            
            ago(date){

                moment.locale();

                return moment.utc(date).fromNow();

            },
        },

    }
</script>
