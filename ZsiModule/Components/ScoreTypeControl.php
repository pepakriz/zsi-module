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
use ZsiModule\Forms\ScoreTypeFormFactory;
use DoctrineModule\Repositories\BaseRepository;
use CmsModule\Content\SectionControl;


/**
 * Control for editing score types.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ScoreTypeControl extends SectionControl
{

	/** @var BaseRepository */
	protected $scoreTypeRepository;

	/** @var ScoreTypeFormFactory */
	protected $scoreTypeFormFactory;


	/**
	 * @param \DoctrineModule\Repositories\BaseRepository $scoreTypeRepository
	 * @param \ZsiModule\Forms\ScoreTypeFormFactory $scoreTypeFormFactory
	 */
	public function __construct(BaseRepository $scoreTypeRepository, ScoreTypeFormFactory $scoreTypeFormFactory)
	{
		parent::__construct();

		$this->scoreTypeRepository = $scoreTypeRepository;
		$this->scoreTypeFormFactory = $scoreTypeFormFactory;
	}


	/**
	 * @return \CmsModule\Components\Table\TableControl
	 */
	public function createComponentTable()
	{
		$table = new \CmsModule\Components\Table\TableControl;
		$table->setTemplateConfigurator($this->templateConfigurator);
		$table->setRepository($this->scoreTypeRepository);

		// forms
		$form = $table->addForm($this->scoreTypeFormFactory, 'Score type');

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
