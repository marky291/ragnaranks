<div class="tw-hidden lg:tw-block">
    <div class="heading">
        <h3>Filtered Search</h3>
    </div>
    <filtered-search @filter:changed="changeResource" inline-template>
        <transition name="fade" mode="out-in">
            <div id="filters" class="d-flex tw-shadow flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">
                <select @change="filterChanged" v-model="rates" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">{{ trans('homepage.rate.all.name') }}</option>
                    @foreach(config('filter.rates') as $rate)
                        <option value="{{ $rate }}">{{ trans("homepage.rate.$rate.name") }}</option>
                    @endforeach
                </select>

                <select @change="filterChanged" v-model="mode" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">{{ trans('homepage.mode.all.name') }}</option>
                    @foreach(config('filter.modes') as $mode)
                        <option value="{{ $mode }}">{{ trans("homepage.mode.$mode.name") }}</option>
                    @endforeach
                </select>

                <select @change="filterChanged" v-model="tag" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">{{ trans('homepage.tag.all.name') }}</option>
                    @foreach(config('filter.tags') as $tag)
                        <option value="{{ $tag }}">{{ trans("homepage.tag.$tag.name") }}</option>
                    @endforeach
                </select>

                <select @change="filterChanged" v-model="sort" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="rank" selected>Sorted by Rank Position</option>
                    <option value="name">Sorted by Server Name</option>
                    <option value="created_at">Sorted by Date Added</option>
                </select>

                <select @change="filterChanged" v-model="paginate" style="color: #8795a1" class="form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="10" selected>And show 10 servers</option>
                    <option value="25">And show 25 servers</option>
                    <option value="50">And show 50 servers</option>
                </select>
            </div>
        </transition>
    </filtered-search>
</div>
