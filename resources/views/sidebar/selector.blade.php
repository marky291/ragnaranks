<div class="heading">
	<h3>User Actions</h3>
</div>
<div class="content py-0 rounded py-3 d-flex flex-column" id="user-actions">
	<at-button @click="goBack" class="mb-2" hollow type="primary">Back to Searching</at-button>
	<at-button @click="visitWebsite" class="mb-2" hollow>Visit Website</at-button>
	<span v-if="!isCurrentPage('voting')">
		<at-button @click="setCurrentPage('voting')" class="w-100 mb-2" hollow>Vote for server</at-button>
	</span>
	<span v-else>
		<at-button @click="setCurrentPage('profile')" class="w-100 mb-2" hollow type="error">Back to Listing</at-button>
	</span>
	<span v-if="!isCurrentPage('reviewing')">
		<at-button @click="setCurrentPage('reviewing')" class="w-100" hollow type="success">Create a review</at-button>
	</span>
	<span v-else>
		<at-button @click="setCurrentPage('profile')" class="w-100" hollow type="error">Back to Listing</at-button>
	</span>
</div>