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
              this.form.post(this.route).then((response) => {
                  this.$Notify.success({
                      title: 'Awesome!',
                      message: 'We have e-mailed your password reset link!'
                  });
              }).catch((response) => {
                  if (response.status === 500) {
                      this.$Notify.error({
                          title: 'OOPS!',
                          message: 'Too many requests asked, try again later!'
                      });
                  }
              });
          },
      }
  }
</script>