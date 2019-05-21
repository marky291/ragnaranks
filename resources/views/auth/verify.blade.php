@extends('layouts.frame')

@section('content')

    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <verify-account-component inline-template>
                    <div class="w-50 tw-mx-auto mt-5 py-3 tw-rounded tw-items-center tw-flex tw-flex-col" style="">
                            <img src="https://rikuhq.files.wordpress.com/2017/11/ro_novicesd-e1511155827699.png" alt="" width="350">
                            <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                                <div class="tw-flex tw-flex-row tw-items-center mb-3 tw-justify-center">
                                    <h3 class="h4 tw-font-bold mb-0 text-center">Unlock your novice abilities! <br><small class="tw-text-xs tw-underline">Verify your account and get all the skills unlocked</small></h3>
                                </div>

                                <p class="mb-3">It is great to know that you are interested in joining our awesome community, but we require
                                    everyone to verify their accounts are legit before access is granted to some features, this protects
                                    both the users and server owners, in knowing that this site is one that you can trust and be assured of its quality.</p>

                                <at-button @click="sendVerificationEmail" :loading="busy" type="primary" class="tw-mx-auto" style="display: block;">Check here to request another verification e-mail!</at-button>
                            </div>
                    </div>
                </verify-account-component>
            </div>
        </div>
    </div>
@endsection
