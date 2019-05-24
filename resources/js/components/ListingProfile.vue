<script>
	import { Carousel3d, Slide } from 'vue-carousel-3d';
  import Scoreboards from '../components/ScoreboardsComponent.vue';

	export default {
		components: {
			Carousel3d,
			Slide,
			Scoreboards
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