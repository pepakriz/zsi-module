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
use DoctrineModule\Entities\NamedEntity;

/**
 * Score of particular product.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 * @ORM\Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @ORM\Table(name="zsiScore")
 * @ORM\HasLifecycleCallbacks
 */
class ScoreEntity extends NamedEntity
{

	/**
	 * @var DateTime
	 * @ORM\Column(type="datetime")
	 */
	protected $date;

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $score = 0;

	/**
	 * @var ProductEntity
	 * @ORM\ManyToOne(targetEntity="ProductEntity", inversedBy="scores")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	protected $product;

	/**
	 * @var ScoreTypeEntity
	 * @ORM\ManyToOne(targetEntity="ScoreTypeEntity", inversedBy="scores")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	protected $scoreType;

	/**
	 * @var UserEntity
	 * @ORM\ManyToOne(targetEntity="\CmsModule\Security\Entities\UserEntity")
	 * @ORM\JoinColumn(onDelete="CASCADE")
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
	 * Generate score.
	 *
	 * @ORM\PrePersist
	 */
	public function prePersist()
	{
		$this->product->generateScore();
	}


	/**
	 * Generate score.
	 *
	 * @ORM\PreUpdate
	 */
	public function preUpdate()
	{
		$this->product->getScores()->removeElement($this);
		$this->product->scores[] = $this;
		$this->product->generateScore();
	}


	/**
	 * Generate score.
	 *
	 * @ORM\PreRemove
	 */
	public function preRemove()
	{
		$this->product->getScores()->removeElement($this);
		$this->product->generateScore();
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
		$this->product->scores[] = $this;
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
