<script>
    import { Form, HasError, AlertError } from 'vform'

    export default {
        components: {
          'has-error': HasError,
          'alert-error': AlertError,
        },
        mounted() {
            this.sendProfileAvatar();
        },
        data: function() {
            return {
                form: new Form({
                    username: this.$parent.account.username,
                    email: this.$parent.account.email,
                    avatarUrl: this.$parent.account.avatarUrl,
                })
            }
        },
        methods: {
            sendProfileAvatar: function() {
                this.$parent.setAvatar(this.account.avatarUrl);
            }
        }
  }
</script>