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
use Nette\Forms\Container;
use Venne\Forms\Form;
use Venne\Forms\IControlExtension;
use DoctrineModule\Forms\FormFactory;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class CommentsFormFactory extends FormFactory
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
		$comments = $form->addMany('comments', function (Container $container) {
			$container->setCurrentGroup($container->form->addGroup('Comment'));
			$container->addManyToOne('user', 'User');
			$container->addTextArea('text', 'Text');

			$container->addSubmit('remove', 'Remove')
				->addRemoveOnClick();
		});

		$comments->addSubmit('add', 'Add comment')
			->addCreateOnClick();

		$form->addSaveButton('Save');
	}
}
