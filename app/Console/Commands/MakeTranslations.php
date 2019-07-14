<?php

namespace App\Console\Commands;

use MartinLindhe\VueInternationalizationGenerator\Commands\GenerateInclude;

class MakeTranslations extends GenerateInclude
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:translation {--umd} {--multi} {--with-vendor} {--file-name=} {--lang-files=} {--format=es6} {--multi-locales}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a vue-i18n|vuex-i18n compatible js array out of project translations';
}
