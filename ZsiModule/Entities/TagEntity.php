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
use Doctrine\Common\Collections\ArrayCollection;
use Nette\DateTime;
use DoctrineModule\Entities\NamedEntity;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @Table(name="zsiTag")
 */
class TagEntity extends NamedEntity
{

	/**
	 * @var ProductEntity[]|ArrayCollection|array
	 * @ManyToMany(targetEntity="ProductEntity", mappedBy="tags")
	 */
	protected $products;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->name = '';
		$this->products = new ArrayCollection;
	}


	/**
	 * @param ProductEntity[]|ArrayCollection|array
	 */
	public function setProducts($products)
	{
		$this->products = $products;
	}


	/**
	 * @return ProductEntity[]|ArrayCollection|array
	 */
	public function getProducts()
	{
		return $this->products;
	}
}
