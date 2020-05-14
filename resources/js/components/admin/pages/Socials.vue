<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="slug"
        class="elevation-1"
    >

    
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Social Media Links</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="50%">
                    <template v-slot:activator="{ on }" v-if="!desserts.length">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Add Social Media Info</v-btn>
                    </template>
                    
                        <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.facebook" label="Facebook page link"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.twitter" label="Twitter page link"></v-text-field>
                                    </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.instagram" label="Instagram page link"></v-text-field>
                                    </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.youtube" label="Youtube page link"></v-text-field>
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
                        text: 'Facebook',
                        align: 'left',
                        sortable: true,
                        value: 'facebook',
                    },
                    {
                        text: 'Twitter',
                        align: 'left',
                        value: 'twitter',
                    },
                    {
                        text: 'Instagram',
                        align: 'left',
                        value: 'instagram',
                    },
                    {
                        text: 'Youtube',
                        align: 'left',
                        value: 'youtube',
                    },
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
                return this.editedIndex === -1 ? 'Add Social Media Info' : 'Edit Social Media Info'
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

                axios.get('/api/social')
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
                    axios.patch('/api/social/' + this.editedItem.id, {
                        facebook: this.editedItem.facebook,
                        twitter : this.editedItem.twitter,
                        instagram: this.editedItem.instagram,
                        youtube: this.editedItem.youtube,
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

                    axios.post('/api/social', {
                        facebook: this.editedItem.facebook,
                        twitter : this.editedItem.twitter,
                        instagram: this.editedItem.instagram,
                        youtube: this.editedItem.youtube,
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
.ql-image{
    display: none !important;
}
.ql-editor{
    color: #000;
}
</style>