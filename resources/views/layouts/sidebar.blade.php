
    <div>

        @if (in_array('messages', $modules, true))
            <div class="content">
                <h3 class="text-orange font-weight-bold">Site Messages</h3>
                <p class="subheading">We are always interested in listening to feedback and improving our
                    service, let your voice be heard in our subreddit <a href="https://www.reddit.com/r/RagnaRanks">r/Ragnaranks</a> or <a href="http://discord.gg/WGSAce2">Discord</a>!
                </p>
            </div>
        @endif

        {{ $slot }}

        @if (in_array('socials', $modules, true))
            <div class="social content bg-transparent p-3 tw-text-grey tw-text-4xl tw-text-center tw-hidden lg:tw-flex">
                <div class="tw-flex-1">
                    <a href="https://www.facebook.com/ragnaranks/"><i class="tw-text-grey hover:tw-text-blue fab fa-facebook"></i></a>
                </div>
                <div class="tw-flex-1">
                    <a href="http://discord.gg/WGSAce2"><i class="tw-text-grey hover:tw-text-blue fab fa-discord"></i></a>
                </div>
                <div class="tw-flex-1">
                    <a href="https://www.reddit.com/r/RagnaRanks/"><i class="tw-text-grey hover:tw-text-blue fab fa-reddit"></i></a>
                </div>
            </div>
        @endif

    </div>
