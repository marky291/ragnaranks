<script>
    export default {
      props: ['user'],
      data: function() {
          return {
              account: this.user,
          }
      },
        computed: {
            avatar: function() {
                return this.account.avatarUrl ? this.account.avatarUrl : 'img/preset/avatar.png';
            }
        },
        methods: {
          setAvatar: function(url) {
              this.account.avatarUrl = url;
          }
        }
  }
</script>