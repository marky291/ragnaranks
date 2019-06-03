<script>
    export default {
      props: ['user'],
      data: function() {
          return {
              avatarUrl: '',
              account: this.user,
          }
      },
        methods: {
          setAvatar: function(url) {
              this.account.avatarUrl = url;
          }
        }
  }
</script>