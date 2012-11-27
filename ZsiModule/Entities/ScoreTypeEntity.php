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
 * Entity for type of rating.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @Table(name="zsiScoreType")
 */
class ScoreTypeEntity extends NamedEntity
{

	/**
	 * @var ArrayCollection|ScoreEntity[]
	 * @OneToMany(targetEntity="ScoreEntity", mappedBy="scoreType")
	 */
	protected $scores;


	/**
	 * Construct.
	 */
	public function __construct()
	{
		$this->name = '';
	}


	/**
	 * @param $scores
	 */
	public function setScores($scores)
	{
		$this->scores = $scores;
	}


	/**
	 * @return ArrayCollection|ScoreEntity[]
	 */
	public function getScores()
	{
		return $this->scores;
	}
}
