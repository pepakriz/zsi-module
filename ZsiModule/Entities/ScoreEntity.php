<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace ZsiModule\Entities;

use Venne;
use DoctrineModule\Entities\NamedEntity;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @Table(name="zsiScore")
 */
class ScoreEntity extends NamedEntity
{

	/**
	 * @var ProductEntity
	 * @ManyToOne(targetEntity="ProductEntity", inversedBy="scores")
	 * @JoinColumn(onDelete="CASCADE")
	 */
	protected $product;

	/**
	 * @var ScoreTypeEntity
	 * @ManyToOne(targetEntity="ScoreTypeEntity", inversedBy="scores")
	 * @JoinColumn(onDelete="CASCADE")
	 */
	protected $scoreType;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->name = '';
	}


	/**
	 * @param \ZsiModule\Entities\ProductEntity $product
	 */
	public function setProduct(ProductEntity $product = NULL)
	{
		$this->product = $product;
	}


	/**
	 * @return \ZsiModule\Entities\ProductEntity
	 */
	public function getProduct()
	{
		return $this->product;
	}


	/**
	 * @param \ZsiModule\Entities\ScoreTypeEntity $scoreType
	 */
	public function setScoreType($scoreType)
	{
		$this->scoreType = $scoreType;
	}


	/**
	 * @return \ZsiModule\Entities\ScoreTypeEntity
	 */
	public function getScoreType()
	{
		return $this->scoreType;
	}
}
