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
use Nette\DateTime;
use DoctrineModule\Entities\IdentifiedEntity;

/**
 * Comment of user about product.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 * @ORM\Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @ORM\Table(name="zsiComment")
 */
class CommentEntity extends IdentifiedEntity
{


	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $text = '';

	/**
	 * @var DateTime
	 * @ORM\Column(type="datetime")
	 */
	protected $date;

	/**
	 * @var ProductEntity
	 * @ORM\ManyToOne(targetEntity="ProductEntity", inversedBy="comments")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	protected $product;

	/**
	 * @var UserEntity
	 * @ORM\ManyToOne(targetEntity="UserEntity")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	protected $user;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->date = new DateTime;
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
	 * @param \Nette\DateTime $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}


	/**
	 * @return \Nette\DateTime
	 */
	public function getDate()
	{
		return $this->date;
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
	public function setUser(BaseUserEntity $user = NULL)
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
