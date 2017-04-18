<?php

namespace Nht\Hocs\Core;

use Illuminate\Pagination\BootstrapThreePresenter;
// use Illuminate\Contracts\Pagination\Presenter;
class NhtPagination extends BootstrapThreePresenter {

	/**
	 * Custom pagination
	 */
	public function render()
	{
		if( ! $this->hasPages())
			return '';

		return sprintf(
			'<div class="dataTables_paginate paging_bootstrap pagination"><ul>%s %s %s</ul></div>',
			$this->getPreviousButton('&laquo; ' . trans('general.paginate.prev')),
			$this->getLinks(),
			$this->getNextButton('&raquo; ' . trans('general.paginate.next'))
		);
	}

	/**
	 * HTML wrapper for disabled text
	 */
	protected function getDisabledTextWrapper($text)
	{
		return '<li class="disabled" aria-disabled="true"><a href="javascript:void(0)">'.$text.'</a></li>';
	}

	/**
	 * HTML wrapper for active text
	 */
	protected function getActivePageWrapper($text)
	{
		return '<li class="active"><a href="javascript:void(0)">'.$text.'</a></li>';
	}

	/**
    * Get a pagination "dot" element.
    *
    * @return string
    */
	protected function getDots()
   {
		return $this->getDisabledTextWrapper('&hellip;');
   }
}