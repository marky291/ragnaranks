<script>
    import { Form } from 'vform'

    export default {
        data: function() {
            return {
                updating: new Form({}),
                destroying: new Form({}),
            }
        },
        methods: {
            update: function(url) {
                this.$Modal.confirm({
                    title: 'You are about to judge the review is acceptable.',
                    content: 'Please confirm that you wish to perform this action on this review!',
                    okText: 'Allow',
                }).then(() => {
                    this.updating.patch(url).then(response => {
                        this.$Message.success("Cool Modding, that review has been allowed.");
                    }).catch(error => {
                        this.$Message.error(error.message);
                    });
                });
            },
            destroy: function(url) {
                this.$Modal.confirm({
                    title: 'You are about to destroy this review.',
                    content: 'Please confirm that you wish to perform a deletion of this review!',
                    okText: 'Destroy',
                }).then(() => {
                    this.destroying.delete(url).then(response => {
                        this.$Message.success("Cool Modding, that report was removed.");
                    }).catch(error => {
                        this.$Message.error(error.message);
                    });
                });
            }
        }
    }
</script>