@extends('layouts.profile')

@section('content')

    <h2 class="heading">Review Explorer</h2>

    {{--  If the player has not reviewed yet lets let them know they can  --}}
    @can ('create', [new App\Reviews\Review, $listing])
        <a href="{{ route('listing.reviews.create', $listing) }}" class="text-{{$listing->accent}}-dark">
            <div class="tw-mt-6 tw-flex tw-flex-row tw-items-center tw-shadow-lg tw-p-4 tw-rounded bc-{{$listing->accent}}-base tw-border-t-2">
                <div class="tw-rounded-full tw-h-10 tw-w-10 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-white">
                    <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle tw-h-10 tw-w-10" src="{{ auth()->user()->avatarUrl }}" alt="">
                </div>
                <div class="tw-flex tw-flex-row tw-flex-1 tw-justify-between">
                    <p class="tw-font-bold">Write a review about {{ $listing->name }}!</p>
                    <i class="fas fa-pencil-alt"></i>
                </div>
            </div>
        </a>
    @else
        <a href="{{ route('listing.reviews.create', $listing) }}" class="text-{{$listing->accent}}-dark">
            <div class="tw-mt-6 tw-flex tw-flex-row tw-items-center tw-shadow-lg tw-p-4 tw-rounded bc-{{$listing->accent}}-base tw-border-t-2">
                <div class="tw-rounded-full tw-h-10 tw-w-10 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-white">
                    <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle tw-h-10 tw-w-10" src="https://ragnaranks.com/img/preset/avatar.png" alt="">
                </div>
                <div class="tw-flex tw-flex-row tw-flex-1 tw-justify-between">
                    <p class="tw-font-bold">Login to review {{ $listing->name }}!</p>
                    <i class="fas fa-pencil-alt"></i>
                </div>
            </div>
        </a>
    @endcan

    {{--  Show all the reviews this listing has --}}
    @if (count($reviews))
    @foreach($reviews as $review)
        <review inline-template>
            <div class="review-item bc-{{$listing->accent}}-base">
                <div class="content left tw-flex-1 tw-flex tw-flex-col">
                    <div class="head tw-flex tw-flex-row tw-mb-4">
                        <div class="tw-rounded-full tw-h-10 tw-w-10 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-white">
                            <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle tw-h-10 tw-w-10" src="{{ $review->user->avatarUrl }}" alt="">
                        </div>
                        <div class="detail tw-flex tw-flex-row tw-flex-1 tw-items-center">
                            <div class="tw-flex-1">
                                <h2 class="tw-font-bold tw-mb-1 tw-text-lg">{{ $review->user->username }}</h2>
                            </div>
                            <div class="">
                                <at-rate :show-text="false" :value="{{ ceil($review->average_score) }}" :count="5" disabled></at-rate>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="message">{{ $review->message }}</p>
                    </div>
                </div>
                <div class="tools">
                    <div class="tw-flex">
                        @if (auth()->check())
                            <button @click="report('{{ route('review.report.store', $review) }}')" class="tool-button"><i class="far fa-flag"></i> Report</button>
                        @can('delete', $review)
                            <button class="tool-button" @click="destroy('{{route('listing.reviews.destroy', [$listing, $review])}}')"><i class="far fa-trash-alt"></i> Delete</button>
                        @endcan
                        @can('edit', $review)
                            <button class="tool-button" @click="edit('{{route('listing.reviews.edit', [$listing, $review])}}')"><i class="fas fa-user-edit"></i> Edit</button>
                        @endcan
                        @else
                            <a href="{{ route('login') }}"><p class="tw-text-gray-600">Login to Interact</p></a>
                        @endif
                    </div>
                    <div class="tw-text-right">
                        <p @click="breakdown = !breakdown" class="tw-cursor-pointer" style="font-size:15px;">View Breakdown</p>
                    </div>
                </div>
                <div v-if="breakdown" class="tw-mx-4 tw-mb-2 at-table at-table--small at-table__content at-table__body">
                    <table class="at-table">
                        <thead class="at-table__thead">
                        <tr>
                            <th class="at-table__cell at-table__column">Record</th>
                            <th class="at-table__cell at-table__column">Score</th>
                            <th class="at-table__cell at-table__column">Grade</th>
                        </tr>
                        </thead>
                        <tbody class="at-table__tbody">
                        <tr>
                            <td class="at-table__cell">Donation Score</td>
                            <td class="at-table__cell">{{ $review->donation_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->donation_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Update Score</td>
                            <td class="at-table__cell">{{ $review->update_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->update_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Classes Score</td>
                            <td class="at-table__cell">{{ $review->class_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->class_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Items Score</td>
                            <td class="at-table__cell">{{ $review->item_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->item_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Support Score</td>
                            <td class="at-table__cell">{{ $review->support_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->support_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Hosting Score</td>
                            <td class="at-table__cell">{{ $review->hosting_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->hosting_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Content Score</td>
                            <td class="at-table__cell">{{ $review->content_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->content_score)) }}</td>
                        </tr>
                        <tr>
                            <td class="at-table__cell">Event Score</td>
                            <td class="at-table__cell">{{ $review->event_score }}</td>
                            <td class="at-table__cell">{{ __('profile.reviews.grades.' . ceil($review->event_score)) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </review>
    @endforeach
    @endif
@endsection
