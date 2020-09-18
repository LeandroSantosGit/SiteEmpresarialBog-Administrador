<?php

namespace Module\administrative\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of SynchronizeLevelAccessPage
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class SynchronizeLevelAccessPage
{
    public function synchronizeAccessPg()
    {
        $synchronizeAccPg = new \Module\administrative\Models\AdmsSynchronizeLevelAccessPage();
        $synchronizeAccPg->synchronizeAccPage();
        $urlRedirect = URLADM . 'access-level/list-access';
        header("Location: $urlRedirect");
    }
}
