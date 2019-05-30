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
                email: '',
                password: '',
                rememberMe: false,
            })
        }
    },
    methods: {
      attemptLogin: function() {
          this.form.post('/login').then(({ data }) => { window.location = '/'; }).catch((error) => {
              this.$Message.error(error.message);
          });
      }
    }
  }
</script>