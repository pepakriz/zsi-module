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
use DoctrineModule\Entities\IdentifiedEntity;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @Table(name="zsiComment")
 */
class CommentEntity extends IdentifiedEntity
{


	/**
	 * @var string
	 * @Column(type="text")
	 */
	protected $text = '';

	/**
	 * @var ProductEntity
	 * @ManyToOne(targetEntity="ProductEntity", inversedBy="comments")
	 * @JoinColumn(onDelete="CASCADE")
	 */
	protected $product;

	/**
	 * @var UserEntity
	 * @OneToOne(targetEntity="UserEntity")
	 * @JoinColumn(onDelete="CASCADE")
	 */
	protected $user;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->name = '';
	}


	/**
	 * @param string $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}


	/**
	 * @return string
	 */
	public function getText()
	{
		return $this->text;
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
	 * @param \ZsiModule\Entities\UserEntity $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}


	/**
	 * @return \ZsiModule\Entities\UserEntity
	 */
	public function getUser()
	{
		return $this->user;
	}
}
