
export default {

    data() {
        return {
            catalogs: null
        }
    },

    methods: {

        Catalogs() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/catalogs')
            .then(function (response) {

                self.catalogs = response.data;

                self.$root.$emit('loading', false);

            })
            .catch(function (error) {

            })
            .finally( function() {
                self.$root.$emit('loading', false);
            });

        },
        
    },
    mounted() {
        this.Catalogs()
    }
}
