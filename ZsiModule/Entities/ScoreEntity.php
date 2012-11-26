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
use CmsModule\Security\Entities\UserEntity;
use Nette\DateTime;
use DoctrineModule\Entities\NamedEntity;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @Table(name="zsiScore")
 */
class ScoreEntity extends NamedEntity
{

	/**
	 * @var DateTime
	 * @Column(type="date")
	 */
	protected $date;

	/**
	 * @var int
	 * @Column(type="integer")
	 */
	protected $score = 0;

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
	 * @var UserEntity
	 * @ManyToOne(targetEntity="\CmsModule\Security\Entities\UserEntity")
	 * @JoinColumn(onDelete="CASCADE")
	 */
	protected $user;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->name = '';
		$this->date = new DateTime;
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
	 * @param int $score
	 */
	public function setScore($score)
	{
		$this->score = $score;
	}


	/**
	 * @return int
	 */
	public function getScore()
	{
		return $this->score;
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


	/**
	 * @param \ZsiModule\Entities\UserEntity $user
	 */
	public function setUser(UserEntity $user = NULL)
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
