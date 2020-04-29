
export default {

    data() {
        return {
            branches: null
        }
    },

    methods: {

        Branches() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/branches')
            .then(function (response) {

                self.branches = response.data;

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
        this.Branches()
    }
}
