<div class="heading">
	<h3>Page Browser</h3>
</div>
<div class="tw-flex tw-flex-row tw-shadow tw-bg-white rounded tw-mb-6 lg:tw-mb-0 tw-items-center tw-py-2" style="justify-content: space-evenly">
	<at-pagination @page-change="changePage" size="small" class="tw-pl-0 tw-mb-0" :current="listings.meta.current_page" :page-size="listings.meta.per_page" :total="listings.meta.total"></at-pagination>
</div>
