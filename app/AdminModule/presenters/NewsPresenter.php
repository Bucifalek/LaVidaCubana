<?php
/**
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 21:51, 17. 3. 2015
 * @copyright 2015 Jan Kotrba
 */

namespace App\AdminModule\Presenters;

use Nette,
	App\AdminModule\Model;

/**
 * Class NewsPresenter
 * @package App\AdminModule\Presenters
 */
class NewsPresenter extends BasePresenter
{

	/**
	 * @var Model\BranchManager
	 */
	private $branchManager;

	/**
	 * @var Model\BowlingNewsManager
	 */
	private $bowlingNewsManager;


	/**
	 * @param Model\UserManager $userManager
	 * @param Nette\Database\Context $database
	 * @param Model\BranchManager $branchManager
	 * @param Model\BowlingNewsManager $bowlingNewsManager
	 */
	function __construct(Model\UserManager $userManager, Nette\Database\Context $database, Model\BranchManager $branchManager, Model\BowlingNewsManager $bowlingNewsManager)
	{
		parent::__construct($userManager, $database, $branchManager);
		$this->branchManager = $branchManager;
		$this->bowlingNewsManager = $bowlingNewsManager;
	}

	/**
	 *
	 */
	public function beforeRender()
	{
		parent::beforeRender();
		$this->requireBranch(4);
	}

	/**
	 * @param $id
	 */
	public function renderEdit($id)
	{
		$post = $this->bowlingNewsManager->get($id);
		if (!$id OR !$post) {
			$this->flashMessage('Tato aktualita neexistuje');
			$this->redirect('News:default');
		} else {
			$this->template->post = $post;
		}
	}

	/**
	 *
	 */
	public function renderDefault($page)
	{
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount($this->bowlingNewsManager->total());
		$paginator->setPage($page);
		$paginator->setItemsPerPage(10);

		$this->template->news = $this->bowlingNewsManager->getPage($paginator->getLength(), $paginator->getOffset());
		$this->template->paginator = $paginator;

		$this->template->currentFrom = 1 + $paginator->offset;
		$this->template->currentTo = $paginator->itemsPerPage + $paginator->offset;
		$this->template->totalPages = ceil($paginator->itemCount / $paginator->itemsPerPage);

		if ($paginator->isLast()) {
			$this->template->currentTo = $paginator->itemCount;
		}
	}

	/**
	 * @param $page
	 */
	public function handleChangePage($page)
	{
		$this->redirect('News:default', $page);
	}

	/**
	 * @param $id
	 */
	public function handleDeleteNewsPost($id)
	{
		$this->bowlingNewsManager->remove($id);
		$this->flashMessage('Aktualita smazána.', FLASH_SUCCESS);
	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	public function createComponentAddNewsForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addProtection();

		$form->addText('title');
		$form->addTextArea('text');
		$form->addSubmit('save');
		$form->onSuccess[] = [$this, 'addNews'];

		return $form;
	}


	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function addNews(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();

		if (!Nette\Utils\Strings::length($values->title)) {
			$this->flashMessage('Není vyplněný titulek', FLASH_WARNING);
		} else if (!Nette\Utils\Strings::length($values->text)) {
			$this->flashMessage('Není vyplněný text', FLASH_WARNING);
		} else {
			$this->flashMessage('Aktualita přidáná', FLASH_SUCCESS);
			$values['timestamp'] = time();
			$this->bowlingNewsManager->save($values);
		}
	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	public function createComponentEditNewsForm()
	{
		$post = $this->bowlingNewsManager->get($this->getParameter('id'));

		$form = new Nette\Application\UI\Form();
		$form->addProtection();

		$form->addText('title')->setValue($post->title);
		$form->addTextArea('text')->setValue($post->text);
		$form->addCheckbox('saveNewDate');
		$form->addSubmit('save');
		$form->onSuccess[] = [$this, 'saveNews'];

		return $form;
	}

	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function saveNews(Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		if (!Nette\Utils\Strings::length($values->title)) {
			$this->flashMessage('Není vyplněný titulek', FLASH_WARNING);
		} else if (!Nette\Utils\Strings::length($values->text)) {
			$this->flashMessage('Není vyplněný text', FLASH_WARNING);
		} else {
			if ($values->saveNewDate) {
				$values['timestamp'] = time();
			}
			unset($values->saveNewDate);
			$this->bowlingNewsManager->update($this->getParameter('id'), $values);
			$this->flashMessage('Aktualita uložena', FLASH_SUCCESS);
		}
		$this->redirect('News:edit', $this->getParameter('id'));
	}
}