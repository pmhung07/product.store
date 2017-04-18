<?php
namespace Nht\Hocs\Core\Metadata;

trait MetadataTrait {

	public function __construct() {
		$this->metadata   = \App::make('Nht\Hocs\Core\Metadata\Metadata');
		$this->domain     = \App::make('Nht\Hocs\Sites\SiteRepository');
		//Category Youdo
		$this->categories = \App::make('Nht\Hocs\SiteResources\SiteResourceRepository');

		view()->share('setting', $this->metadata);
		view()->share('categories', $this->categories->getCategoryHaveDomailCurrent($this->domain->getDomaiByServerName()));
	}

}