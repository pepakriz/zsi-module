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
use ZsiModule\Forms\ProductFormFactory;
use DoctrineModule\Repositories\BaseRepository;
use CmsModule\Content\SectionControl;


/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ProductControl extends SectionControl
{

	/** @var BaseRepository */
	protected $productRepository;

	/** @var ProductFormFactory */
	protected $productFormFactory;


	/**
	 * @param \DoctrineModule\Repositories\BaseRepository $productRepository
	 * @param \ZsiModule\Forms\ProductFormFactory $productFormFactory
	 */
	public function __construct(BaseRepository $productRepository, ProductFormFactory $productFormFactory)
	{
		parent::__construct();

		$this->productRepository = $productRepository;
		$this->productFormFactory = $productFormFactory;
	}


	public function createComponentTable()
	{
		$table = new \CmsModule\Components\Table\TableControl;
		$table->setTemplateConfigurator($this->templateConfigurator);
		$table->setRepository($this->productRepository);
		$table->setPaginator(10);
		$table->enableSorter();

		// forms
		$form = $table->addForm($this->productFormFactory, 'Product');

		// navbar
		$table->addButtonCreate('create', 'Create new', $form, 'file');

		// columns
		$table->addColumn('name', 'Name', '100%');
		//$table->addColumn('alias', 'Alias', '20%');
		//$table->addColumn('short', 'Short', '30%');

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
