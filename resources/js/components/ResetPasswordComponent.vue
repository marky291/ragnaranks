<script>
  import { Form, HasError, AlertError, AlertSuccess } from 'vform'
  export default {
      props: ['route', 'form_token'],
      components: {
          'has-error': HasError,
          'alert-error': AlertError,
          'alert-success': AlertSuccess,
      },
      data: function() {
          return {
              form: new Form({
                  email: '',
                  password: '',
                  password_confirmation: '',
                  token: this.form_token,
              })
          }
      },
      methods: {
          attemptSendReset() {
              this.form.post(this.route).then((response) => {
                  window.location = '/';
              });
          },
      }
  }
</script>