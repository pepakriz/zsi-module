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
 * @Table(name="zsiProduct")
 */
class ProductEntity extends NamedEntity
{

	/**
	 * @var string
	 * @Column(type="text")
	 */
	protected $description = '';

	/**
	 * @var string
	 * @Column(type="date")
	 */
	protected $date;

	/**
	 * @var bool
	 * @Column(type="boolean")
	 */
	protected $enable = false;

	/**
	 * @var string
	 * @Column(type="text")
	 */
	protected $barcode = '';


	/**
	 * @var ArrayCollection|TagEntity[]
	 * @ManyToMany(targetEntity="TagEntity", inversedBy="products")
	 * @JoinTable(
	 *       joinColumns={@JoinColumn(onDelete="CASCADE")},
	 *       inverseJoinColumns={@JoinColumn(onDelete="CASCADE")}
	 *       )
	 */
	protected $tags;

	/**
	 * @var ArrayCollection|ScoreEntity[]
	 * @OneToMany(targetEntity="ScoreEntity", mappedBy="product")
	 */
	protected $scores;

	/**
	 * @var ArrayCollection|CommentEntity[]
	 * @OneToMany(targetEntity="CommentEntity", mappedBy="product")
	 */
	protected $comments;

	/**
	 * @var \CmsModule\Security\Entities\UserEntity
	 * @ManyToOne(targetEntity="\CmsModule\Security\Entities\UserEntity", inversedBy="products")
	 * @JoinColumn(onDelete="SET NULL")
	 */
	protected $user;

	/**
	 * @var \CmsModule\Content\Entities\FileEntity
	 * @OneToOne(targetEntity="\CmsModule\Content\Entities\FileEntity", cascade={"all"}, orphanRemoval=true)
	 * @JoinColumn(onDelete="SET NULL")
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
	 * @param \CmsModule\Security\Entities\UserEntity $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}


	/**
	 * @return \CmsModule\Security\Entities\UserEntity
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
