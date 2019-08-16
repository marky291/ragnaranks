    <footer class="shadow-inner">

{{--        <div class="website-banner container text-uppercase text-left mb-4">--}}
{{--            <h1 class="text-transparent">--}}
{{--                <img src="{{ asset('images/footer-banner.png') }}" alt="">--}}
{{--            </h1>--}}
{{--        </div>--}}

        <div class="tw-container d-flex mb-5">
            <div class="tw-flex-1  mr-5">
                <h2 class="pb-1">RagnaRanks</h2>
                <p>
                    Our web-service is designed in a way that allows you to easily find the server
                    you are searching for in the box of never ending server advertisements, we accomplish this
                    by utilising tags, filters and keyword searching throughout all of our cards, this allows
                    you to easily narrow down a specific search and discover servers you would have never
                    found otherwise.
                </p>
                <div class="social pt-2">
                    <a href="https://www.facebook.com/ragnaranks/" class="tw-text-2xl"><i class="fab fa-facebook text-white mr-2"></i></a>
                    <a href="http://discord.gg/WGSAce2" class="tw-text-2xl"><i class="fab fa-discord text-white mr-2"></i></a>
                    <a href="https://www.reddit.com/r/RagnaRanks/" class="tw-text-2xl"><i class="fab fa-reddit-square text-white mr-2"></i></a>
                </div>
            </div>
            <div class="tw-hidden lg:tw-flex tw-flex-1" style="justify-content: space-evenly">
                <div>
                    <h2>Docs</h2>
                    <ul class="list-unstyled list">
                        <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://ragnaranks.github.io/docs/listing.html">Creating a new Listing</a></li>
                        <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://ragnaranks.github.io/docs/vote4points.html">Vote For Points Setup</a></li>
                        <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://ragnaranks.github.io/docs/listing.html">Documentation Overview</a></li>
                    </ul>
                </div>
                <div>
                    <h2>Actions</h2>
                    <ul class="list-unstyled list">
                        <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm" href="https://www.reddit.com/r/RagnaRanks">Share your ideas</a></li>
                        <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm"  href="/listing/create">Create a new Listing</a></li>
                        <li><a class="tw-text-gray-300 hover:tw-text-white tw-text-sm"  href="https://www.facebook.com/ragnaranks/">Message us for Help</a></li>
                    </ul>
                </div>
{{--                <div class="flex-fill">--}}
{{--                    <h2>Administrate</h2>--}}
{{--                    <ul class="list-unstyled list">--}}
{{--                        <li class="text-transparent"><a class="tw-text-gray-500 hover:tw-text-white"  href="/listing/create">Register A Server</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </div>

        <div id="copyrights" class="container text-center rounded-top">
            <p class="text-transparent mb-0">©Ragnaranks 2018. All Rights belong to Respective Owners. Ver {{ config('app.version') }}</p>
            <p class="text-transparent mb-0">
                Developed and Designed by <a class=text-white href="https://www.facebook.com/Marky291">Mark Hester</a>,
                with special thanks to Rainer Popowski & Zurina Johnston for their insight.
            </p>
        </div>

    </footer>
