<script>
    export default {
        data() {
            return {
                breakdown: false,
            }
        },
        methods: {
            edit(route) {
                window.location.assign(route);
            },
            destroy(route) {
                this.$Modal.confirm({
                    title: 'Confirmation Required',
                    okText: 'Confirm',
                    content: `Are you sure you wish to delete this review permanently?`
                }).then(() => {
                    axios.delete(`${route}`).then(function (response) {
                        window.location.assign(response.data.route);
                    });
                });
            },
            report(route) {
                this.$Modal.prompt({
                    title: 'Report Content',
                    content: 'Type your reason for reporting this review:'
                }).then((data) => {
                    this.report.reason = data.value;
                    this.report.post(route).then(response => {
                        this.$Message.success('Thanks, We will notify you when we decide action upon the review.');
                    }).catch(error => {
                        this.$Message.error("Unable to process your report on this review.");
                    })
                });
            }
        }
    }
</script>
