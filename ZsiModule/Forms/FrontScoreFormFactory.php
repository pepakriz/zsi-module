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
use Nette\Security\User;
use CmsModule\Security\Repositories\UserRepository;
use Venne\Forms\Form;
use CmsModule\Security\Entities\UserEntity;
use DoctrineModule\Forms\FormFactory;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class FrontScoreFormFactory extends FormFactory
{


	/** @var UserRepository */
	protected $userRepository;

	/** @var User */
	protected $user;


	/**
	 * @param \CmsModule\Security\Repositories\UserRepository $userRepository
	 */
	public function injectUserRepository($userRepository)
	{
		$this->userRepository = $userRepository;
	}


	/**
	 * @param User $user
	 */
	public function injectUser(User $user)
	{
		$this->user = $user;
	}


	/**
	 * @param Form $form
	 */
	public function configure(Form $form)
	{
		$form->addManyToOne('scoreType', 'Type')->setRequired();
		$form->addSelect('score', 'Score')->setItems(array(0 => '', 1 => '*', 2 => '**', 3 => '***', 4 => '****', 5 => '*****'));
		$form->addSaveButton('Save');
	}


	public function handleSave(Form $form)
	{
		$form->data->user = $this->getCurrentUser();

		parent::handleSave($form);
	}


	/**
	 * @return UserEntity
	 */
	protected function getCurrentUser()
	{
		return $this->userRepository->findOneByEmail($this->user->getIdentity()->getId());
	}
}
