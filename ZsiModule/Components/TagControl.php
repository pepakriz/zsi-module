<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace ZsiModule\Components;

use Venne;
use ZsiModule\Forms\TagFormFactory;
use DoctrineModule\Repositories\BaseRepository;
use CmsModule\Content\SectionControl;


/**
 * Control for editing tags.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class TagControl extends SectionControl
{

	/** @var BaseRepository */
	protected $tagRepository;

	/** @var ProductFormFactory */
	protected $tagFormFactory;


	/**
	 * @param \DoctrineModule\Repositories\BaseRepository $tagRepository
	 * @param TagFormFactory $tagFormFactory
	 */
	public function __construct(BaseRepository $tagRepository, TagFormFactory $tagFormFactory)
	{
		parent::__construct();

		$this->tagRepository = $tagRepository;
		$this->tagFormFactory = $tagFormFactory;
	}


	/**
	 * @return \CmsModule\Components\Table\TableControl
	 */
	public function createComponentTable()
	{
		$table = new \CmsModule\Components\Table\TableControl;
		$table->setTemplateConfigurator($this->templateConfigurator);
		$table->setRepository($this->tagRepository);

		// forms
		$form = $table->addForm($this->tagFormFactory, 'Tag');

		// navbar
		$table->addButtonCreate('create', 'Create new', $form, 'file');

		// columns
		$table->addColumn('name', 'Name')
			->setWidth('100%')
			->setSortable(TRUE)
			->setFilter();

		// actions
		$table->addActionEdit('edit', 'Edit', $form);
		$table->addActionDelete('delete', 'Delete');

		// global actions
		$table->setGlobalAction($table['delete']);

		return $table;
	}


	public function render()
	{
		$this->template->render();
	}
}
