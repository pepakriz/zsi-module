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
use Doctrine\Common\Collections\ArrayCollection;
use Nette\DateTime;
use DoctrineModule\Entities\NamedEntity;

/**
 * Information about product. It is connected with score, tag, user etc. entities.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 * @ORM\Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @ORM\Table(name="zsiProduct")
 */
class ProductEntity extends NamedEntity
{

	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $description = '';

	/**
	 * @var string
	 * @ORM\Column(type="datetime")
	 */
	protected $date;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean")
	 */
	protected $enable = false;

	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $barcode = '';

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $score = 0;


	/**
	 * @var ArrayCollection|TagEntity[]
	 * @ORM\ManyToMany(targetEntity="TagEntity", inversedBy="products", cascade={"all"}, orphanRemoval=true)
	 * @ORM\JoinTable(
	 *       joinColumns={@ORM\JoinColumn(onDelete="CASCADE")},
	 *       inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
	 *       )
	 */
	protected $tags;

	/**
	 * @var ArrayCollection|ScoreEntity[]
	 * @ORM\OneToMany(targetEntity="ScoreEntity", mappedBy="product", cascade={"all"}, orphanRemoval=true)
	 */
	protected $scores;

	/**
	 * @var ArrayCollection|CommentEntity[]
	 * @ORM\OneToMany(targetEntity="CommentEntity", mappedBy="product", cascade={"all"}, orphanRemoval=true)
	 */
	protected $comments;

	/**
	 * @var UserEntity
	 * @ORM\ManyToOne(targetEntity="UserEntity")
	 * @ORM\JoinColumn(onDelete="SET NULL")
	 */
	protected $user;

	/**
	 * @var CompanyEntity
	 * @ORM\ManyToOne(targetEntity="CompanyEntity")
	 * @ORM\JoinColumn(onDelete="SET NULL")
	 */
	protected $company;

	/**
	 * @var \CmsModule\Content\Entities\FileEntity
	 * @ORM\OneToOne(targetEntity="\CmsModule\Content\Entities\FileEntity", cascade={"all"}, orphanRemoval=true)
	 * @ORM\JoinColumn(onDelete="SET NULL")
	 */
	protected $photo;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->date = new DateTime;
		$this->name = '';

		$this->tags = new ArrayCollection;
		$this->scores = new ArrayCollection;
	}


	/**
	 * Generate score.
	 */
	public function generateScore()
	{
		$count = count($this->getScores());

		$sum = 0;
		foreach ($this->getScores() as $score) {
			$sum += $score->getScore();
		}

		if ($count === 0) {
			$this->score = 0;
		} else {
			$this->score = (int)($sum / $count);
		}
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
	 * @param  $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}


	/**
	 * @return DateTime
	 */
	public function getDate()
	{
		return $this->date;
	}


	/**
	 * @param  $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}


	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}


	/**
	 * @param  $enable
	 */
	public function setEnable($enable)
	{
		$this->enable = $enable;
	}


	/**
	 * @return bool
	 */
	public function getEnable()
	{
		return $this->enable;
	}


	/**
	 * @param string $barcode
	 */
	public function setBarcode($barcode)
	{
		$this->barcode = $barcode;
	}


	/**
	 * @return string
	 */
	public function getBarcode()
	{
		return $this->barcode;
	}


	/**
	 * @param $tags
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	}


	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection|TagEntity[]
	 */
	public function getTags()
	{
		return $this->tags;
	}


	/**
	 * @param $scores
	 */
	public function setScores($scores)
	{
		$this->scores = $scores;
	}


	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection|ScoreEntity[]
	 */
	public function getScores()
	{
		return $this->scores;
	}


	/**
	 * @param $comments
	 */
	public function setComments($comments)
	{
		$this->comments = $comments;
	}


	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection|CommentEntity[]
	 */
	public function getComments()
	{
		return $this->comments;
	}


	/**
	 * @param \ZsiModule\Entities\CompanyEntity $company
	 */
	public function setCompany($company)
	{
		$this->company = $company;
	}


	/**
	 * @return \ZsiModule\Entities\CompanyEntity
	 */
	public function getCompany()
	{
		return $this->company;
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


	/**
	 * @param \CmsModule\Content\Entities\FileEntity $photo
	 */
	public function setPhoto($photo)
	{
		$this->photo = $photo;
	}


	/**
	 * @return \CmsModule\Content\Entities\FileEntity
	 */
	public function getPhoto()
	{
		return $this->photo;
	}
}
