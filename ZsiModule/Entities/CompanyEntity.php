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


/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\DoctrineModule\Repositories\BaseRepository")
 * @Table(name="zsiCompanyUser")
 * @DiscriminatorEntry(name="zsiCompanyUserEntity")
 */
class CompanyEntity extends BaseUserEntity
{

	/**
	 * @var string
	 * @Column(type="string")
	 */
	protected $companyName;


	/**
	 * @param string $companyName
	 */
	public function setCompanyName($companyName)
	{
		$this->companyName = $companyName;
	}


	/**
	 * @return string
	 */
	public function getCompanyName()
	{
		return $this->companyName;
	}
}
