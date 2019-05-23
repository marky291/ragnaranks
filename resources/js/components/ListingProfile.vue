<script>
	import { Carousel3d, Slide } from 'vue-carousel-3d';

	export default {
		components: {
			Carousel3d,
			Slide
		},
		data: function() {
			return {
				listing: {}
			}
		},
		created() {
          this.$root.$on('listing:profile:modified', event => {
              this.listing = event.data;
			})
		}
	}
</script>