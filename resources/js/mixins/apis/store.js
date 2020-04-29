
export default {

    data() {
        return {
            stores: null
        }
    },

    methods: {

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
        
    },
    mounted() {
        this.Stores()
    }
}
