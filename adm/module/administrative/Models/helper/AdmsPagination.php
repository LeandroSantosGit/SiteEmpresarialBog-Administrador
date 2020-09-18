<?php

namespace Module\administrative\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsPagination
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class AdmsPagination
{
    private $link;
    private $page;
    private $limitResult;
    private $offSet;
    private $query;
    private $parseString;
    private $resultDb;
    private $result;
    private $totalPages;
    private $maxLink = 2;
    private $var;
    
    function getResult()
    {
        return $this->result;
    }
            
    function getOffSet()
    {
        return $this->offSet;
    }
    
    function __construct($link, $var = null)
    {
        $this->link = $link;
        $this->var = $var;
    }
    
    public function condition($page, $limitResult)
    {
        $this->page = (int) $page ? $page : 1;
        $this->limitResult = (int) $limitResult;
        $this->offSet = ($this->page * $this->limitResult) - $this->limitResult;
    }
    
    public function pagination($query, $parseString = null)
    {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        $count = new \Module\administrative\Models\helper\AdmsRead();
        $count->fullRead($this->query, $this->parseString);
        $this->resultDb = $count->getResult();
        if ($this->resultDb[0]['numResult'] > $this->limitResult) {
            $this->instructionPagination();
        } else {
            $this->result = null;
        }
    }
    
    private function instructionPagination()
    {
        $this->totalPages = ceil($this->resultDb[0]['numResult'] / $this->limitResult);
        if ($this->totalPages >= $this->page) {
            $this->layoutPagination();
        } else {
            header("Location: {$this->link}");
        }
    }
    
    private function layoutPagination()
    {
        $this->result = "<nav aria-label='Paginacao'>
            <ul class='pagination pagination-sm justify-content-center'>
                <li class='page-item'>
                    <a class='page-link' href='" . $this->link . $this->var . "' tabindex='-1'>Primeira</a>
                </li>";
        $beforePag = $this->page - $this->maxLink;
        for ($beforePag; $beforePag <= $this->page - 1; $beforePag++) {
            if ($beforePag >= 1) {
                $this->result .= "<li class='page-item'>
                                <a class='page-link' href='" . $this->link . "/" . $beforePag . $this->var ."'>
                                    $beforePag
                                </a>
                             </li>";
            }
        }
        $this->result .= "<li class='page-item active'>
                            <a class='page-link' href='#'>" . $this->page . "</a>
                         </li>";
        $afterPage = $this->page + 1;
        for ($afterPage; $afterPage <= $this->page + $this->maxLink; $afterPage++) {
            if ($afterPage <= $this->totalPages) {
                $this->result .= "<li class='page-item'>
                                <a class='page-link' href='" . $this->link . "/" . $afterPage . $this->var ."'>
                                    $afterPage
                                </a>
                             </li>";
            }
        }
        $this->result .= "<li class='page-item'>
                    <a class='page-link' href='" . $this->link . "/" . $this->totalPages . $this->var ."'>Última</a>
                </li>
            </ul>
        </nav>";
    }
}
