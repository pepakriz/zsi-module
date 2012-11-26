<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace ZsiModule\Presenters;

use Venne;
use ZsiModule\Entities\ScoreEntity;
use ZsiModule\Forms\FrontScoreFormFactory;
use ZsiModule\Entities\CommentEntity;
use ZsiModule\Forms\FrontCommentFormFactory;
use DoctrineModule\Repositories\BaseRepository;
use Venne\Forms\Form;
use CmsModule\Content\Presenters\PagePresenter;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ProductPresenter extends PagePresenter
{

	/**
	 * @var string
	 * @persistent
	 */
	public $search;

	/**
	 * @var int
	 * @persistent
	 */
	public $offset;

	/**
	 * @var int
	 * @persistent
	 */
	public $product;

	/** @var BaseRepository */
	protected $productRepository;

	/** @var FrontCommentFormFactory */
	protected $commentFormFactory;

	/** @var FrontScoreFormFactory */
	protected $scoreFormFactory;


	/**
	 * @param \DoctrineModule\Repositories\BaseRepository $productRepository
	 */
	public function __construct(BaseRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}


	/**
	 * @param FrontCommentFormFactory $commentFormFactory
	 */
	public function injectCommentFormFactory(FrontCommentFormFactory $commentFormFactory)
	{
		$this->commentFormFactory = $commentFormFactory;
	}


	/**
	 * @param FrontScoreFormFactory $scoreFormFactory
	 */
	public function injectScoreFormFactory(FrontScoreFormFactory $scoreFormFactory)
	{
		$this->scoreFormFactory = $scoreFormFactory;
	}


	/**
	 * @param $product
	 */
	public function handleShow()
	{
	}


	/**
	 * @return \Venne\Forms\Form
	 */
	protected function createComponentSearchForm()
	{
		$form = new Form;
		$form->setMethod('GET');
		$form->addText('search', 'Search')->setDefaultValue($this->search);
		$form->addSaveButton('Search');

		return $form;
	}


	/**
	 * @return \Venne\Forms\Form
	 */
	protected function createComponentCommentForm()
	{
		$entity = new CommentEntity;
		$entity->setProduct($this->getCurrentProduct());

		$form = $this->commentFormFactory->invoke($entity);
		$form->onSuccess[] = $this->processCommentForm;
		return $form;
	}


	/**
	 * @param \Venne\Forms\Form $form
	 */
	public function processCommentForm(Form $form)
	{
		$this->flashMessage('Comment has been saved', 'success');
		$this->redirect('this');
	}


	/**
	 * @return \Venne\Forms\Form
	 */
	protected function createComponentScoreForm()
	{
		$this->scoreFormFactory->setProductEntity($this->getCurrentProduct());
		$form = $this->scoreFormFactory->invoke(new ScoreEntity);
		$form->onSuccess[] = $this->processScoreForm;
		return $form;
	}


	/**
	 * @param \Venne\Forms\Form $form
	 */
	public function processScoreForm(Form $form)
	{
		$this->flashMessage('Score has been saved', 'success');
		$this->redirect('this');
	}


	/**
	 * @return \Doctrine\CouchDB\View\AbstractQuery|\Doctrine\ORM\QueryBuilder
	 */
	public function getProductsDql()
	{
		$dql = $this->productRepository->createQueryBuilder('a')->andWhere('a.enable = TRUE')->orderBy('a.score', 'DESC');

		if ($this->search) {
			$dql = $dql->andWhere('a.name LIKE :search')->orWhere('a.description LIKE :search')->setParameter('search', "%{$this->search}%");
		}

		if ($this->offset) {
			$dql = $dql->setFirstResult($this->offset);
		}

		return $dql;
	}


	/**
	 * @return ProductEntity[]
	 */
	public function getProducts()
	{
		return $this->getProductsDql()->getQuery()->getResult();
	}


	/**
	 * @return ProductEntity
	 */
	public function getCurrentProduct()
	{
		return $this->productRepository->find($this->product);
	}
}