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
 * Entity for page.
 *
 * @author Josef Kříž <pepakriz@gmail.com>
 * @ORM\Entity(repositoryClass="\CmsModule\Content\Repositories\PageRepository")
 * @ORM\Table(name="zsiPage")
 * @ORM\DiscriminatorEntry(name="zsiPage")
 */
class PageEntity extends \CmsModule\Content\Entities\PageEntity
{

	/**
	 * Construct.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->mainRoute->type = 'Zsi:Product:default';
	}
}
