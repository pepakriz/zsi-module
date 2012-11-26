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
use Venne\Forms\IControlExtension;
use DoctrineModule\Forms\FormFactory;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ProductFormFactory extends FormFactory
{

	/**
	 * @return IControlExtension[]
	 */
	protected function getControlExtensions()
	{
		return array(
			new \DoctrineModule\Forms\ControlExtensions\DoctrineExtension(),
			new \CmsModule\Content\ControlExtension(),
			new \FormsModule\ControlExtensions\ControlExtension(),
			new \CmsModule\Content\Forms\ControlExtensions\ControlExtension(),
		);
	}


	/**
	 * @param Form $form
	 */
	public function configure(Form $form)
	{
		$form->addGroup('Informations');
		$form->addText('name', 'Name')->addRule($form::FILLED);
		$form->addText('description', 'Description');
		$form->addCheckbox('enable', 'Enable');
		$form->addFileEntityInput('photo', 'Photo');

		$form->addGroup('Barcode');
		$form->addText('barcode');

		$form->addGroup('Owner');
		$form->addManyToOne('user', 'User');
		$form->addManyToOne('company', 'Company');

		$form->addGroup('Tags');
		$form->addManyToMany('tags');

		$form->addSaveButton('Save');
	}
}
