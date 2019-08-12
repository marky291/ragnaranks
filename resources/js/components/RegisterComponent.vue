<script>
    import { Form, HasError, AlertError } from 'vform'

  export default {
      components: {
          'has-error': HasError,
          'alert-error': AlertError,
      },
      data: function() {
          return {
              form: new Form({
                  username: '',
                  email: '',
                  password: '',
                  password_confirmation: '',
                  avatarUrl: 'https://ragnabox.fra1.digitaloceanspaces.com/preset/avatar.png',
              })
          }
      },
      methods: {
          attemptRegister: function() {
              this.form.post('/register').then(response => {
                  this.$Message.success('Welcome!, A validation email has been sent to the registered email!');
                  setTimeout(function () {
                      window.location = '/';
                  }.bind(this), 1000);
              }).catch((error) => {
                  if (error.status === 302) {
                      window.location = '/';
                  }
                  this.$Message.error(error.message);
              });
          }
      }
  }
</script>
