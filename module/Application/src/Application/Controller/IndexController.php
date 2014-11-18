<?php

namespace Application\Controller;

use Application\Model\Link;
use Application\Repository\LinkRepository;
use Application\Service\ShortenedLinkService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Endroid\QrCode\QrCode;
use Zend\Http\Response;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @var \Application\Repository\LinkRepository
     */
    protected $linkRepository;

    /**
     * @var \Application\Service\ShortenedLinkService
     */
    protected $shortenedLink;

    /**
     * @param LinkRepository $repo
     * @param ShortenedLinkService $shortenedLink
     */
    public function __construct(LinkRepository $repo, ShortenedLinkService $shortenedLink)
    {
        $this->linkRepository = $repo;
        $this->shortenedLink = $shortenedLink;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $link = new Link();

        $form = $this->getServiceLocator()->get('LinkForm');

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $linkData = $form->getData();
                $link->setName($linkData['name']);
                $link->setLongUrl($linkData['url']);
                $shortenedLink = $this->shortenedLink->shortenLink($link);
                $link->setShortUrl($shortenedLink);

                $this->linkRepository->persist($link);
                $this->linkRepository->flush();

                return $this->redirect()->toRoute('links', ['action' => 'view', 'id' => $link->getId()]);
            }
        }
        return new ViewModel(
            [
                'form' => $form,
                'link' => $link
            ]
        );

    }

    /**
     * Show Shortened Link and corresponding QR Code
     *
     * @return JsonModel|ViewModel
     */
    public function viewAction()
    {
        $link = $this->linkRepository->getById($this->params()->fromRoute('id', 0));

        if (!$link) {
            return new JsonModel(['success' => false]);
        }

        $qrCode = new QrCode();
        $qrCode->setText($link->getLongUrl());
        $qrCode->setSize(300);
        $qrCode->setPadding(10);
        $qrCode->render('public/img/qr_code.png', 'png');

        return new ViewModel(
            [
                'link' => $link
            ]
        );
    }
}
