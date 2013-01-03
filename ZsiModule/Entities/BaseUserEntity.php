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
use Doctrine\ORM\Mapping as ORM;

/**
 * Base entity for user and company.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class BaseUserEntity extends \CmsModule\Security\Entities\UserEntity
{

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $surname;


	/**
	 * @var ArrayCollection|ProductEntity[]
	 * @ORM\OneToMany(targetEntity="ProductEntity", mappedBy="user")
	 */
	protected $products;


	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * @param string $surname
	 */
	public function setSurname($surname)
	{
		$this->surname = $surname;
	}


	/**
	 * @return string
	 */
	public function getSurname()
	{
		return $this->surname;
	}


	/**
	 * @param $products
	 */
	public function setProducts($products)
	{
		$this->products = $products;
	}


	/**
	 * @return ArrayCollection|ProductEntity[]
	 */
	public function getProducts()
	{
		return $this->products;
	}
}
