
export default {

    data() {
        return {
            tags: null
        }
    },

    methods: {

        Tags() {

            var self = this;

            this.$root.$emit('loading', true);

            axios.get('/api/tags')
            .then(function (response) {

                self.tags = response.data;

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
        this.Tags()
    }
}
