<div class="heading">
	<h3>User Actions</h3>
</div>
<div class="tw-p-6 content tw-shadow py-0 rounded py-3 d-flex flex-column" id="user-actions">
	<at-button @click="visitWebsite" class="mb-2" hollow>Visit Website <i class="tw-ml-4 fas fa-map-signs"></i></at-button>
	<span v-if="!isCurrentPage('voting')">
		<at-button @click="setCurrentPage('voting')" class="w-100 mb-2">Vote for server <i class="tw-ml-2 fas fa-grin-hearts"></i></at-button>
	</span>
	<span v-else>
		<at-button @click="setCurrentPage('profile')" class="w-100 mb-2">Back to Listing</at-button>
	</span>
	<span v-if="!isCurrentPage('reviewing')">
		<at-button :disabled="buttons.reviewButton.disabled" @click="setCurrentPage('reviewing')" class="w-100 mb-2">@{{ buttons.reviewButton.text }} <i class="tw-ml-2 fas fa-keyboard"></i></at-button>
	</span>
	<span v-else>
		<at-button @click="setCurrentPage('profile')" class="w-100 mb-2">Back to Listing</at-button>
	</span>
	<at-button @click="goBack" type="primary">Back to Searching</at-button>
</div>
