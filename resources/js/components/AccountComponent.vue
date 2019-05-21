<script>
    export default {
      props: ['account'],
      data: function() {
          return {
              avatarUrl: '',
          }
      },
        methods: {
          setAvatar: function(url) {
              this.avatarUrl = url;
          }
        }
  }
</script>