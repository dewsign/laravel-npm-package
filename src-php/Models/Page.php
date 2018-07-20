<?php

namespace Maxfactor\CMS\Pages\Models;

use Maxfactor\CMS\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Maxfactor\CMS\Traits\HasRepeaterContent;
use Maxfactor\Support\Webpage\Traits\HasParent;
use Maxfactor\Support\Webpage\Contracts\Webpage;
use Maxfactor\Support\Model\Traits\HasActiveState;
use Maxfactor\Support\Model\Traits\WithPrioritisation;
use Maxfactor\Support\Webpage\Traits\HasMetaAttributes;
use Maxfactor\Support\Webpage\Traits\MustHaveCanonical;

class Page extends Model implements Webpage
{
    use HasParent;
    use HasImages;
    use HasActiveState;
    use MustHaveCanonical;
    use HasMetaAttributes;
    use HasRepeaterContent;
    use WithPrioritisation;

    /**
     * Web and admin namespaces.
     *
     * @var array
     */
    protected $namespaces = [
        'admin' => 'admin.pages.',
        'web' => 'pages.'
    ];

    /**
     * The subdomains that should be removed from full path.
     *
     * @var array
     */
    protected $domainMappedFolders = [];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'featured_image' => 'array',
        'page_content' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'priority',
        'sort',
        'featured_image',
        'page_content',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'root_item',
    ];

    /**
     * Get a page's parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get a page's children.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id');
    }

    /**
     * Return a page object to allow customising of meta fields for non-dynamic pages.
     * E.g. blog index page. Pass in a default string incase no page exists matching the slug.
     *
     * @param string $slug
     * @param string $default
     * @return array
     */
    public static function meta(string $slug, string $default = null)
    {
        return self::withParent()->whereFullPath($slug)->first() ?? [
            'page_title' => $default,
            'browser_title' => $default,
            'meta_description' => $default,
            'h1' => $default,
        ];
    }

    public function seed()
    {
        $seed = parent::seed();

        if (method_exists($this, 'parent')) {
            $this->seedParent($seed, $this);
        }

        return $seed->push([
            'name' => $this->h1,
            'url' => $this->full_path,
        ]);
    }

    private function seedParent($seed, $item)
    {
        if (!$parent = $item->parent()->first()) {
            return;
        }

        $this->seedParent($seed, $parent);

        $seed->push([
            'name' => $parent->h1,
            'url' => $parent->full_path,
        ]);
    }

    public function getCanonicalAttribute()
    {
        return $this->full_path;
    }

    /**
     * Add root item attribute.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRootItemAttribute()
    {
        $root_slug = $this->getRootSlug();

        if ($root_slug === $this->slug) {
            return;
        }

        return $this->where('slug', '=', $root_slug)->first();
    }

    /**
     * Add full path attribute without domain mapped folders. Useful
     * when wanting to include the original path to then filter.
     *
     * @return string
     */
    public function getUnmappedFullPathAttribute()
    {
        $pathSections = explode('/', $this->getFullPath());

        $finalSlug = collect($pathSections)
            ->filter()
            ->implode('/');

        return str_start($finalSlug, '/');
    }
}
