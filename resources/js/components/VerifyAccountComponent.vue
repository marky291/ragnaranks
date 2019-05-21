<script>
  import axios from 'axios';
  export default {
      data() {
          return {
              busy: false,
          }
      },
      methods: {
          sendVerificationEmail() {
              this.busy = true;
              axios.get('/email/resend').then((response) => {
                  this.$Notify.success({
                      title: 'Email Sent!',
                      message: 'Please check your junk and inbox folders.'
                  });
              }).finally((response) => {
                  this.busy = false;
              });
          }
      }
  }
</script>