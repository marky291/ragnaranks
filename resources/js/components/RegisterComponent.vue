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
                  avatarUrl: 'http://www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg',
              })
          }
      },
      methods: {
          attemptRegister: function() {
              this.form.post('/register').then(response => {
                  window.location = '/'; })
							.catch((error) => {
                  if (error.status === 302) {
                      window.location = '/';
                  }
                  this.$Message.error(error.message);
              });
          }
      }
  }
</script>