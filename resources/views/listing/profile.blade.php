
<div data-aos="fade-down" data-aos-once="true" class="mb-3 server-card item flex-fill shadow border rounded">
	<div id="profile-card" class="profile-block">
		<div class="server-card-head image rounded-top" style="height:350px;" v-bind:style="{ backgroundImage: 'url(' + listing.background + ')' }"></div>
		<div class="server-card-head overlap d-flex" style="margin-top:-169px;">
			<i class="fas fa-arrow-left tw-text-white tw-text-2xl tw-absolute tw-align-top"></i>
			<div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
				<h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">@{{ serverName }}</h1>
				<ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light">
					<li class="mr-2" v-for="tag in listing.tags">#@{{ tag.name }}</li>
					<li class="mr-2" v-if="!listing.tags.length">#TagYourServerFunctionality</li>
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

	<div data-aos="fade-up" data-aos-once="true" class="tw-container mt-4">
		<div id="description" class="profile-block">
			<div class="container px-5 py-4">
				<div class="row no-gutters">
					<div class="tw-tracking-normal tw-whitespace-pre-wrap markdown-compiled" v-html="compiledMarkdown"></div>
				</div>
			</div>
		</div>
	</div>

	<section data-aos="fade-up" data-aos-once="true" id="previews">
		<div class="container px-5 pt-4 pb-3">
			<h3 class="heading mb-4 tw-font-bold text-dark heading-underline tw-tracking-tight">Specifications</h3>
			<div class="tw-my-0 w-flex">
				<carousel-3d :count="listing.screenshots.length" :height="220" :width="380" :controls-visible="true" :autoplay="true" :autoplay-timeout="2500">
					<slide v-for="(screenshot, i) in listing.screenshots" :index="i" :key="i">
						<template slot-scope="{ index, isCurrent, leftIndex, rightIndex }">
							<img :data-index="index" :class="{ current: isCurrent, onLeft: (leftIndex >= 0), onRight: (rightIndex >= 0) }" :src="screenshot">
						</template>
					</slide>
				</carousel-3d>
			</div>
		</div>
	</section>

	<section id="configuration" data-aos="fade-up" data-aos-once="true" class="content-block">
		<div class="container px-5 py-4">
{{--			<h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Server Setup</h3>--}}
			<at-tabs>
				<at-tab-pane label="Configs" name="rates" icon="icon-bar-chart-2">
					<div class="row">
						<div class="list col-4 d-flex flex-column mb-3">
							@component('listing.partial.config', ['name' => __('configs.item_rate_common')])
								@{{ getDrop('item_rate_common') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_common_boss'])
								@{{ getDrop('item_rate_common_boss') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_common_mvp'])
								@{{ getDrop('item_rate_common_mvp') }}
							@endcomponent
						</div>
						<div class="list col-4 d-flex flex-column mb-3">
							@component('listing.partial.config', ['name' => 'item_rate_heal'])
								@{{ getDrop('item_rate_heal') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_heal_boss'])
								@{{ getDrop('item_rate_heal_boss') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_heal_mvp'])
								@{{ getDrop('item_rate_heal_mvp') }}
							@endcomponent
						</div>
						<div class="list col-4 d-flex flex-column mb-3">
							@component('listing.partial.config', ['name' => 'item_rate_use'])
								@{{ getDrop('item_rate_use') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_use_boss'])
								@{{ getDrop('item_rate_use_boss') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_use_mvp'])
								@{{ getDrop('item_rate_use_mvp') }}
							@endcomponent
						</div>
						<div class="list col-4 d-flex flex-column mb-3">
							@component('listing.partial.config', ['name' => 'item_rate_equip'])
								@{{ getDrop('item_rate_equip') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_equip_boss'])
								@{{ getDrop('item_rate_equip_boss') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_equip_mvp'])
								@{{ getDrop('item_rate_equip_mvp') }}
							@endcomponent
						</div>
						<div class="list col-4 d-flex flex-column mb-3">
							@component('listing.partial.config', ['name' => 'item_rate_card'])
								@{{ getDrop('item_rate_card') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_card_boss'])
								@{{ getDrop('item_rate_card_boss') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_card_mvp'])
								@{{ getDrop('item_rate_card_mvp') }}
							@endcomponent
						</div>
						<div class="list col-4 d-flex flex-column mb-3">
							@component('listing.partial.config', ['name' => 'item_rate_mvp'])
								@{{ getDrop('item_rate_mvp') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_adddrop'])
								@{{ getDrop('item_rate_adddrop') }}
							@endcomponent
							@component('listing.partial.config', ['name' => 'item_rate_treasure'])
								@{{ getDrop('item_rate_treasure') }}
							@endcomponent
						</div>
					</div>
				</at-tab-pane>
				<at-tab-pane label="Comamnds" name="commands" icon="icon-target">
					<p>Content of Tab Pane 2</p>
				</at-tab-pane>
				<at-tab-pane label="Features" name="features" icon="icon-award">
					<p>Content of Tab Pane 2</p>
				</at-tab-pane>
				<at-tab-pane label="Woe Times" name="timetable" icon="icon-target">
					<p>Content of Tab Pane 4</p>
				</at-tab-pane>
			</at-tabs>
		</div>
	</section>

	<section id="ratings">
		<div class="container pl-5 pr-5">
			<div class="py-3 mb-3 rounded" data-aos="fade-up" data-aos-once="true" style="border:1px solid rgba(255, 255, 255, 0.2);">
				<h3 class="heading mb-4 tw-font-bold text-dark heading-underline tw-tracking-tight">Balance Ratings</h3>
				<div class="row no-gutters">
					<scoreboards inline-template>
						<div class="d-flex">
							<scoreboard title="Donations" description="Non-Donators can compete with Donators." :score="avg_donation_score"></scoreboard>
							<scoreboard title="Updates" description="Improvements made each update." :score="avg_update_score"></scoreboard>
							<scoreboard title="Classes" description="Classes are balanced against other classes." :score="avg_class_score"></scoreboard>
							<scoreboard title="Items" description="Item stats are fair and well thought out." :score="avg_item_score"></scoreboard>
						</div>
					</scoreboards>
				</div>
			</div>
			<div class="py-3 mb-3 rounded" data-aos="fade-up" data-aos-once="true" style="border:1px solid rgba(255, 255, 255, 0.2)">
				<h3 class="heading mb-4 tw-font-bold text-dark heading-underline tw-tracking-tight">Server Ratings</h3>
				<div class="row no-gutters">
					<scoreboards inline-template>
						<div class="d-flex">
							<scoreboard title="Support" description="Non-Donators can compete with Donators." :score="avg_support_score"></scoreboard>
							<scoreboard title="Hosting" description="The availability and ping is playable and fun." :score="avg_hosting_score"></scoreboard>
							<scoreboard title="Content" description="There is much to do and progress upon." :score="avg_content_score"></scoreboard>
							<scoreboard title="Events" description="Rewards are good and events are regular." :score="avg_event_score"></scoreboard>
						</div>
					</scoreboards></div>
			</div>
		</div>
	</section>

</div>