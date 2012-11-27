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
use ZsiModule\Forms\ScoreFormFactory;
use ZsiModule\Forms\CommentsFormFactory;
use ZsiModule\Forms\ProductFormFactory;
use DoctrineModule\Repositories\BaseRepository;
use CmsModule\Content\SectionControl;


/**
 * Control for editing products.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ProductControl extends SectionControl
{

	/** @var BaseRepository */
	protected $productRepository;

	/** @var ProductFormFactory */
	protected $productFormFactory;

	/** @var CommentsFormFactory */
	protected $commentsFormFactory;

	/** @var ScoreFormFactory */
	protected $scoreFormFactory;


	/**
	 * @param \DoctrineModule\Repositories\BaseRepository $productRepository
	 * @param \ZsiModule\Forms\ProductFormFactory $productFormFactory
	 * @param \ZsiModule\Forms\CommentsFormFactory $commentsFormFactory
	 * @param \ZsiModule\Forms\ScoreFormFactory $scoreFormFactory
	 */
	public function __construct(BaseRepository $productRepository, ProductFormFactory $productFormFactory, CommentsFormFactory $commentsFormFactory, ScoreFormFactory $scoreFormFactory)
	{
		parent::__construct();

		$this->productRepository = $productRepository;
		$this->productFormFactory = $productFormFactory;
		$this->commentsFormFactory = $commentsFormFactory;
		$this->scoreFormFactory = $scoreFormFactory;
	}


	/**
	 * @return \CmsModule\Components\Table\TableControl
	 */
	public function createComponentTable()
	{
		$table = new \CmsModule\Components\Table\TableControl;
		$table->setTemplateConfigurator($this->templateConfigurator);
		$table->setRepository($this->productRepository);
		$table->setPaginator(10);
		$table->enableSorter();

		// forms
		$form = $table->addForm($this->productFormFactory, 'Product');
		$commentsForm = $table->addForm($this->commentsFormFactory, 'Comments');
		$scoreForm = $table->addForm($this->scoreFormFactory, 'Scores');

		// navbar
		$table->addButtonCreate('create', 'Create new', $form, 'file');

		// columns
		$table->addColumn('name', 'Name', '80%');
		$table->addColumn('score', 'Score', '20%');

		// actions
		$table->addActionEdit('edit', 'Edit', $form);
		$table->addActionEdit('comments', 'Comments', $commentsForm);
		$table->addActionEdit('scores', 'Scores', $scoreForm);
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
