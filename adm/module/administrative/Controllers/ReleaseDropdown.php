<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ReleaseDropdown
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ReleaseDropdown
{
    private $dadoId;
    private $levelAccId;
    private $pageId;
    
    public function liberateDropdown($dadoId = null)
    {
        $this->dadoId = (int) $dadoId;
        $this->levelAccId = filter_input(INPUT_GET, "niv", FILTER_SANITIZE_NUMBER_INT);
        $this->pageId = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->dadoId) && !empty($this->levelAccId) && !empty($this->pageId)) {
            $releaseDropdown = new \Module\administrative\Models\AdmsReleaseDropdown();
            $releaseDropdown->addDropdown($this->dadoId);
            $urlRedirect = URLADM . "permission/list-permission/{$this->pageId}?level={$this->levelAccId}";
            return header("Location: $urlRedirect");
        }
        $urlRedirect = URLADM . 'access-level/list-access';
        return header("Location: $urlRedirect");
    }
}
