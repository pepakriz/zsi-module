<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace ZsiModule\Forms;

use Venne;
use Venne\Forms\Form;
use CmsModule\Content\Forms\RegistrationFrontFormFactory;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class UserFormFactory extends RegistrationFrontFormFactory
{

	/**
	 * @param Form $form
	 */
	public function configure(Form $form)
	{
		$form->addGroup('Přihlašovací údaje');
		parent::configure($form);

		unset($form['_submit']);

		$form->addGroup('Údaje uživatele');
		$form->addText('name', 'Name');
		$form->addText('surname', 'Surname');

		$form->addGroup();
		$form->addSaveButton('Register');
	}
}
