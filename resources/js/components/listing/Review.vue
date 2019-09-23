<script>
    export default {
        methods: {
            destroy(route) {
                axios.delete(`${route}`).then(function (response) {
                    window.location.assign(response.data.route);
                });
            },
            edit(route) {
                window.location.assign(route);
            }
        }
    }
</script>
