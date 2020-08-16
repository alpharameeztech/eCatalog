
export default {

    data() {
        return {
            cities: null
        }
    },

    methods: {

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
        this.Cities()
    }
}
