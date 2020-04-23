<template>

    <v-container>
        <v-row dense>


        </v-row>

    </v-container>

</template>
<script>


    export default {


        data() {
            return {

            }
        },

        methods: {
            initialize () {

                var self= this

                //load countStats mixins
                this.Load()

            },

        },
        created() {

            this.initialize()
            //console.log(this.$data)

        }
    }
</script>

<style>
    img {
        width: 30%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }
</style>
