<script>
  import { Form, HasError, AlertError, AlertSuccess } from 'vform'

  export default {
      props: ['route'],
      components: {
          'has-error': HasError,
          'alert-error': AlertError,
          'alert-success': AlertSuccess,
      },
      data: function() {
          return {
              form: new Form({
                  email: '',
              })
          }
      },
      methods: {
          attemptSendLink() {
              this.form.post(this.route).then((errors) => {
                 //
              });
          },
      }
  }
</script>