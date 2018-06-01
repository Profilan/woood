<?php
/**
 * weblog-12.0
 * 
 * Deze broncode is onderdeel van het weblog-voorbeeld uit het boek 
 * "Leer jezelf Professioneel werken met het Zend Framework".
 * U mag deze broncode gebruiken voor uw eigen projecten onder de voorwaarde
 * dat dit commentaarblock gehandhaafd blijft. U bent vrij de broncode aan
 * te passen en uit te breiden voor uw eigen doeleinden
 * De auteurs bieden geen garantie voor de correcte werking van de broncode.
 * 
 * @copyright Copyright (c) 2010 Leer Jezelf Professioneel Zend Framework
 * @license http://framework.zend.com/license/new-bsd New BSD License
 * @author Wouter Tengeler <wouter@leerjezelf-zendframework.nl>
 * @author Matthijs van den Bos <matthijs@leerjezelf-zendframework.nl>
 * @link http://www.leerjezelf-zendframework.nl
 * @category LeerJezelf
 * @version weblog-12.0
 */

/**
 * Navigation Action Helper
 *
 * @author Wouter Tengeler
 */
class LeerJezelf_Controller_Action_Helper_Navigation extends Zend_Controller_Action_Helper_Abstract
{
	public function postDispatch()
	{
		//Zend_Registry::get('logger')->debug(__METHOD__. ' - ');
		try {
			$view = $this->getActionController()->view;
			// zoek het pad en filenaam uit de application.ini
			$options = $this->getFrontController()->getParam('bootstrap')->getOptions();
			if (isset($options['navigation']) && isset($options['navigation']['file'])) {
				$file = $options['navigation']['file'];
				// lees de navigatie uit het xml-bestand
				$navConfig = new Zend_Config_Xml($file, 'navigation');
				// instantieer het navigatie-object
				$navigation = new Zend_Navigation($navConfig);

				// voeg het archief toe
				$this->addArchive($navigation);
				//Zend_Registry::get('logger')->debug(__METHOD__. ' - navigation: '. print_r($navigation->toArray(), true));

				// haal het Zend_Acl-object op
				$acl = LeerJezelf_Model_Acl::getInstance()->getAcl();
				$role = Site_Model_Authentication::getInstance()->getUser()->getRole();
				// voeg het object toe aan de View Helper in het View-object
				$view->navigation($navigation);
				// geef het gebruikte Acl-object door aan de navigation helpers
				$view->navigation()->menu()
						->setAcl($acl)
						->setRole($role);
				$view->navigation()->sitemap()
						->setAcl($acl)
						->setRole('guest');
				// we genereren het menu in een named segment van het response object
				$response = $this->getResponse();
				// Als we in een controller de view-variable noMenu op true hebben gezet,
				// mogen we geen HTML-menu genereren. Bijvoorbeeld in het geval van XML-output
				if ((null === $view->noMenu) || (false === $view->noMenu)) {
					// render het menu met de template menu.phtml en voeg het resultaat toe aan het response object
					$response->append('menu', $view->render('menu.phtml'));
				}
			}
		} catch (Exception $e) {
			// negeer de exception, We hebben geen menu kunnen inlezen.
		}
	}

	/**
	 * voeg een dynam,ische lijst van het archief toe aan de navigatiestructuur
	 * @param Zend_Navigation $navigation
	 */
	protected function addArchive(Zend_Navigation $navigation)
	{
		if (null !== $navigation) {
			// zoek de pagina met id archive op
			$container = $navigation->findById('archive');
			if (null !== $container) {
				$bloglist = new Site_Model_BlogList();
				$list = $bloglist->getArchive('', '');
				if (count($list) > 0) {
					$pages = array();
					foreach($list as $year => $months) {
						$page['id'] = 'archive_'.$year;
						$page['label'] = strVal($year);
						$page['module'] = 'default';
						$page['controller'] = 'blogpost';
						$page['action'] = 'archive';
						$page['resource'] = 'default_blogpost';
						$page['privilege'] = 'archive';
						$page['params'] = array ('year' => $year, 'month' => '');
						$page['pages'] = array();
						foreach($months as $month => $blogposts) {
							$subpage = array();
							$subpage['id'] = 'archive_'.$year.'_'.$month;
							$subpage['label'] = strVal($month);
							$subpage['module'] = 'default';
							$subpage['controller'] = 'blogpost';
							$subpage['action'] = 'archive';
							$subpage['resource'] = 'default_blogpost';
							$subpage['privilege'] = 'archive';
							$subpage['params'] = array ('year' => $year, 'month' => $month);
							foreach($blogposts as $blogpost) {
								$post = array();
								$post['label'] = $blogpost->getTitle();
								$post['module'] = 'default';
								$post['controller'] = 'blogpost';
								$post['action'] = 'view';
								$post['resource'] = 'default_blogpost';
								$post['privilege'] = 'view';
								$post['params'] = array ('id' => $blogpost->getId());
								$subpage['pages'][] = $post;
							}
							$page['pages'][] = $subpage;
						}
						$pages[] = $page;
					}
					try {
						$container->addPages($pages);
					} catch(Exception $e) {
						// iets ging er mis, negeer de fout, geen pagina's toegevoegd
						Zend_Registry::get('logger')->debug(__METHOD__. ' - container error : '.$e->getMessage(), true);
					}
				}
			}
		}
	}
}