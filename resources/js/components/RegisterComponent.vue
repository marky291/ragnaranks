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
              })
          }
      },
      methods: {
          attemptRegister: function() {
              this.form.post('/register').then(response => {
                  window.location = '/'; })
							.catch((response) => {
                  if (response.status === 302) {
                      window.location = '/';
                  }
              });
          }
      }
  }
</script>