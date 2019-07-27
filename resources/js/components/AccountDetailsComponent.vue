<script>
    import merge from 'lodash/merge';
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
                    email_preference: this.$parent.account.email_preference,
                })
            }
        },
        methods: {
            sendProfileAvatar: function() {
                this.$parent.setAvatar(this.form.avatarUrl);
            },
            saveAccount: function() {
                this.form.post('/account/update').then(response => {
                    this.$Message.success('Changes to your account saved');
								}).catch(response => {
								    if (response.status !== 422){
                        this.$Message.error(error.message);
										}
								});
                merge(this.$parent.account, this.form);
						},
            refreshApiToken: function() {
                this.$Modal.confirm({
                    title: 'Confirmation Required',
                    okText: 'Confirm',
                    content: `Are you sure you want to change your listing API token?`
                }).then(() => {
                    axios.post(`/account/refreshApiToken`).then((response) => {
                        console.log(response.data.token);
                        this.$parent.account.api_token = response.data.token;
                        this.$Message.success(`Token successfully changed, please update any links being used!`);
                    });
                });
            }
        }
  }
</script>