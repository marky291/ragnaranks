<script>
    import axios from 'axios';
    import Velocity from 'velocity-animate';

    export default {

        data: function () {
            return {
                listings: [],
                pagination: {},
            }
        },

        created: function(){
            axios.get('api/servers/all/all/all/rank/7').then(response => {
                this.listings = response.data.data;
            });

            this.$root.$on('filter:changed', (param) => {
                axios.get(param).then(response => {
                    this.listings = response.data.data
                });
            })
        },
        methods: {
            visit: function(slug) {
                window.location.href = '/listing/' + slug;
            },
            beforeEnter: function (el) {
                el.style.opacity = 0
                el.style.height = 0
            },
            enter: function (el, done) {
                var delay = el.dataset.index * 2
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 1, height: '270px' },
                        { complete: done }
                    )
                }, delay)
            },
            leave: function (el, done) {
                var delay = el.dataset.index * 2
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 0, height: 0 },
                        { complete: done }
                    )
                }, delay)
            }
        }
    }
</script>