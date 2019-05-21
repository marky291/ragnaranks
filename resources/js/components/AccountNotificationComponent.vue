<script>
    import axios from 'axios';

  	export default {
      props: {
          id: String,
          status: Number,
      },

      data: function() {
          return {
              read: this.status,
          }
      },
      methods: {
          markRead: function() {
              axios.post('/notifications/read/' + this.id).then(response => {
									this.read = true;
              }).catch(error => {
                  //
							});
          },
          markUnread: function() {
              axios.post('/notifications/unread/' + this.id).then(response => {
                  this.read = false;
              }).catch(error => {
                  //
              });
          },
      }
  }
</script>