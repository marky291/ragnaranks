<script>
	export default {
	    props: ['tags'],
      data: function() {
          return {
              listing: {
                  name: '',
                  tags: [],
                  language: '',
                  description: '',
									background: '',
									screenshots: [],
							}
          }
      },
			methods: {
          updateListing() {
              this.$root.$emit('listing:profile:modified', {
                 data: this.listing,
							});
					}
			}
	}
</script>