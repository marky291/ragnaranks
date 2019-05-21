<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RagnaRanks Assets</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="my-3">Full Cards</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    @for ($i = 0; $i < 8; $i++)
                        <div class="mb-4">
                            @include('partials.cards.normal',
                            [
                                'name' => 'Lychee Ragnarok Online',
                                'tags' => ['freebies', 'frost', 'donation', 'pk-mode'],
                                'image' => 'https://scontent.fdub1-2.fna.fbcdn.net/v/t1.0-9/59295836_2302946656648580_4601660632750620672_o.jpg?_nc_cat=101&_nc_ht=scontent.fdub1-2.fna&oh=25376b313ae0fed100aca9c0bea55412&oe=5D698327',
                                'language' => 'english',
                                'score' => 98,
                                'vote_count' => 121,
                                'click_count' => 933,
                                'rate' => 'High Rate',
                                'description' => 'An inviting server full of extraordinary custom features.'
                            ])
                        </div>
                        <div class="mb-4">
                            @include('partials.cards.normal',
                            [
                                'name' => 'Clashed Online',
                                'tags' => ['events', 'activeStaff', 'freebies', 'customEvents'],
                                'image' => 'https://scontent.fdub2-1.fna.fbcdn.net/v/t1.0-9/59415072_391378791449559_8430613871076573184_o.jpg?_nc_cat=101&_nc_ht=scontent.fdub2-1.fna&oh=40af42fe40369932146f1406469c8413&oe=5D5F078B',
                                'language' => 'english',
                                'score' => 82,
                                'vote_count' => 55,
                                'click_count' => 104,
                                'rate' => 'Middle Rate',
                                'description' => 'Get your "Surprised" Freebies'
                            ])
                        </div>
                        <div class="mb-4">
                            @include('partials.cards.normal',
                            [
                                'name' => 'Ragnarok Champions',
                                'tags' => ['moneyPrizes', 'hardcore', 'pvp', 'challenges'],
                                'image' => 'https://scontent.fdub2-1.fna.fbcdn.net/v/t1.0-9/59625025_565703400603739_6771623564052267008_n.png?_nc_cat=102&_nc_ht=scontent.fdub2-1.fna&oh=5885911b518bdb21037fd9be74ad775a&oe=5D6011EA',
                                'language' => 'english',
                                'score' => 92,
                                'vote_count' => 504,
                                'click_count' => 344,
                                'rate' => 'Middle Rate',
                                'description' => 'We are calling out all Ragnarok Players who wants to try our server'
                            ])
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </body>
</html>
