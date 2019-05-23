
<div class="mb-3 server-card item flex-fill shadow border rounded">
	<div id="profile-card" class="profile-block">
		<div class="server-card-head image rounded-top" style="height:250px;" v-bind:style="{ backgroundImage: 'url(' + listing.background + ')' }"></div>
		<div class="server-card-head overlap d-flex" style="margin-top:-169px;">
			<i class="fas fa-arrow-left tw-text-white tw-text-2xl tw-absolute tw-align-top"></i>
			<div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
				<h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">@{{ listing.name }}</h1>
				<ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light">
					<li class="mr-2" v-for="tag in listing.tags">#@{{ tag.name }}</li>
				</ul>
			</div>
			<div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
				<div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
					<h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
					<span class="card-counter font-weight-bold transparency">0</span>
				</div>
				<div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
					<h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
					<span class="card-counter font-weight-bold transparency">0</span>
				</div>
				<div class="d-flex flex-column justify-content-end" style="height:100%;">
					<img src="/img/flags/english.png" alt="EN">
				</div>
			</div>
		</div>
	</div>

	<div class="tw-container tw-px-4 tw-py-5">
		<div id="description" class="profile-block">
			<div class="container py-4">
				<h3 class="heading tw-font-bold mb-4 text-dark heading-underline">Description</h3>
				<div class="row no-gutters">
					<p>@{{ listing.description }}</p>
				</div>
			</div>
		</div>
	</div>

	<section id="previews">
		<div class="container px-5 pt-4 pb-3">
			<h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Screenshot Previews</h3>
			<div class="mb-3">
				<carousel-3d :disable3d="true" :space="360" :height="200" :width="350" :autoplay="true" :autoplay-timeout="5000" :controls-visible="true"  :controls-width="30" :controls-height="60" :clickable="false">
						<slide v-for="(screenshot, index) in listing.screenshots" :index="index">
							<img class="h-100" :src="screenshot">
						</slide>
				</carousel-3d>
			</div>
		</div>
	</section>

</div>