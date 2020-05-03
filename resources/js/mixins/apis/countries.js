
export default {

    data() {
        return {
            countries: null
        }
    },

    methods: {

        Countries() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/countries')
            .then(function (response) {

                self.countries = response.data;

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
        this.Countries()
    }
}
