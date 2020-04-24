
export default {

    data() {
        return {
            countries: null,
            cities: null,
        }
    },

    methods: {
        Load () {

            this.Countries()
            this.Cities()
        },

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
        
        Cities() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/cities')
            .then(function (response) {

                self.cities = response.data;

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

        this.Load()
    }
}
