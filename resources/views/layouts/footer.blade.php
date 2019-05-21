    <footer class="shadow-inner">

{{--        <div class="website-banner container text-uppercase text-left mb-4">--}}
{{--            <h1 class="text-transparent">--}}
{{--                <img src="{{ asset('images/footer-banner.png') }}" alt="">--}}
{{--            </h1>--}}
{{--        </div>--}}

        <div class="container d-flex mb-5">
            <div class="w-50 mr-5">
                <h2 class="pb-1">RagnaRanks</h2>
                <p>
                    Our web-service is designed in a way that allows you to easily find the server
                    you are searching for in the box of never ending server advertisements, we accomplish this
                    by utilising tags, filters and keyword searching throughout all of our cards, this allows
                    you to easily narrow down a specific search and discover servers you would have never
                    found otherwise.
                </p>
                <div class="social pt-2">
                    <i class="icon fab fa-facebook text-white mr-1"></i>
                    <i class="icon fab fa-reddit-square text-white mr-1"></i>
                </div>
            </div>
            <div class="w-50 d-flex flex-row justify-content-between">
                <div class="flex-fill">
                    <h2>Develop</h2>
                    <ul class="list-unstyled list">
                        <li class="text-transparent">Share your ideas</li>
                        <li class="text-transparent">API Callbacks</li>
                        <li class="text-transparent">Contribute to Codebase</li>
                    </ul>
                </div>
                <div class="flex-fill">
                    <h2>Play</h2>
                    <ul class="list-unstyled list">
                        <?php /** @var \App\Mode $mode */ ?>
                        @foreach(\App\Mode::all() as $mode)
                            <li class="text-transparent">{{ ucfirst($mode->name) }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex-fill">
                    <h2>Administrate</h2>
                    <ul class="list-unstyled list">
                        <li class="text-transparent">Register A Server</li>
                        <li class="text-transparent">View Server Stats</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="copyrights" class="container text-center rounded-top">
            <p class="text-transparent mb-0">©Ragnaranks 2018. All Rights belong to Respective Owners</p>
            <p class="text-transparent mb-0">
                Developed and Designed by <a class=text-white href="https://www.facebook.com/Marky291">Mark Hester</a>,
                with special thanks to Rainer Popowski & Zurina Johnston for their insight.
            </p>
        </div>

    </footer>