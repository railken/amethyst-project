<?php

namespace Railken\Amethyst\Providers;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Common\CommonServiceProvider;

class ProjectServiceProvider extends CommonServiceProvider
{
    /**
     * @inherit
     */
    public function register()
    {
        parent::register();

        $this->app->register(\Railken\Amethyst\Providers\TaxonomyServiceProvider::class);

        \Illuminate\Database\Eloquent\Builder::macro('projects', function (): MorphMany {
            return app('amethyst')->createMacroMorphRelation($this, \Railken\Amethyst\Models\Project::class, 'projects', 'target');
        });

        app('amethyst.taxonomy')->add('project.status', Config::get('amethyst.project.data.project.attributes.status.vocabulary'), [
            'pending',
            'started',
            'suspended',
            'canceled',
        ]);
    }
}
