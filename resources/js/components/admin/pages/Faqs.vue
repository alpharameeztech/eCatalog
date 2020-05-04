<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="slug"
        class="elevation-1"
    >
        <!-- question -->  
            <template v-slot:item.question="{ item }">
                <v-row  class="d-flex justify-start">
                    <v-col cols="12" sm="12" md="12">
                        <v-text> {{item.question.en}} </v-text>
                    </v-col>
                </v-row>
            </template>
        <!-- question end-->

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
                <v-toolbar-title>FAQ's</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="50%">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Add FAQ</v-btn>
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
                                                    <v-text-field v-model="editedItem.question" label="Question"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text>Answer</v-text>
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
                                                    <v-text-field v-model="editedItem.arabic_question" label="Question in Arabic"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text>Answer in Arabic</v-text>
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
                        text: 'Question',
                        align: 'left',
                        sortable: false,
                        value: 'question',
                    },
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
                }
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Add FAQ' : 'Edit FAQ'
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

                axios.get('/api/faqs')
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
                this.editedItem.question = item.question.en
                this.editedItem.arabic_question = item.question.ar
                this.editorData = item.answer.en
                this.arabicEditorData = item.answer.ar
                
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
                    axios.patch('/api/faq/' + this.editedItem.id, {
                        question: this.editedItem.question,
                        arabic_question: this.editedItem.arabic_question,
                        answer: this.editorData,
                        arabic_answer : this.arabicEditorData
                    })
                        .then(function (response) {
                            flash('Changes Saved.', 'success');

                            self.initialize()

                        })
                        .catch(function (error) {
                            self.$root.$emit('loading', false)
                        })
                        .finally( function() {
                            self.$root.$emit('loading', false);
                        });


                } else {
                    var self = this

                    this.$root.$emit('loading', true);

                    this.desserts.push(this.editedItem)

                    axios.post('/api/faq', {
                        question: this.editedItem.question,
                        arabic_question: this.editedItem.arabic_question,
                        answer: this.editorData,
                        arabic_answer : this.arabicEditorData
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

                    this.initialize()
                }
                this.close()
            },
            toggleStatus(item){
                var self = this

                this.$root.$emit('loading', true);
                
                axios.patch('/api/toggle/faq/status', {
                    id: item.id,
                })
                .then(function (response) {

                    self.initialize()
                    
                    flash('Changes Saved.', 'success');
                })
                .catch(function (error) {
                    flash(error, 'error');
                })
                .finally( function() {
                    self.$root.$emit('loading', false);
                });

            },
            ago(date){

                moment.locale();

                return moment.utc(date).fromNow();

            },
        },

    }
</script>
