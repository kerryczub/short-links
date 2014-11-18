<?php

namespace Application\Service;

use Application\Repository\LinkRepository;

/**
 * Class ShortenedLinkService
 * @package Application\Service
 */
class ShortenedLinkService
{
    /**
     * @var \Application\Repository\LinkRepository
     */
    protected $linkRepository;

    /**
     * @param LinkRepository $repo
     */
    public function __construct(LinkRepository $repo)
    {
        $this->linkRepository = $repo;
    }

    /**
     * @return string
     */
    public function shortenLink()
    {
        $shortLink = 'http://sho.lk/';
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';

        for ($i = 0; $i < 9; $i++) {

            $shortLink .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $shortLink;
    }
}
