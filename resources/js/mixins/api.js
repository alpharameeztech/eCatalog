
export default {

    data() {
        return {
            countries: null,
            cities: null,
            stores: null,
            malls: null
        }
    },

    methods: {
        Load () {

            this.Countries()
            this.Cities()
            this.Stores()
            this.Malls()
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

        Stores() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/stores')
            .then(function (response) {

                self.stores = response.data;

                self.$root.$emit('loading', false);

            })
            .catch(function (error) {

            })
            .finally( function() {
                self.$root.$emit('loading', false);
            });

        },

        Malls() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/malls')
            .then(function (response) {

                self.malls = response.data;

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
