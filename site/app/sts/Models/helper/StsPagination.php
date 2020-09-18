<?php

namespace Sts\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of StsPagination
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class StsPagination
{
    private $link;
    private $maxLinks;
    private $page;
    private $limitResult;
    private $offset;
    private $query;
    private $parseString;
    private $resultDb;
    private $resultPagination;
    private $totalPages;
    
    function getResultPagination()
    {
        return $this->resultPagination;
    }
    
    function getOffset()
    {
        return $this->offset;
    }
    
    function __construct($link)
    {
        $this->link = $link;
        $this->maxLinks = 2;
    }
    
    public function requirementPage($page, $limitResult)
    {
        $this->page = (int) $page ? $page : 1;
        $this->limitResult = (int) $limitResult;
        $this->offset = ($this->page * $this->limitResult) - $this->limitResult;
    }
    
    public function paginationPage($query, $parseString = null)
    {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        $Count = new \Sts\Models\helper\StsRead();
        $Count->fullRead($this->query, $this->parseString);
        $this->resultDb = $Count->getResult();
        if ($this->resultDb[0]['num_result'] > $this->limitResult) {
            $this->createPagination();
        } else {
            $this->resultPagination = null;
        }
    }
    
    private function createPagination()
    {
        $this->totalPages = ceil($this->resultDb[0]['num_result'] / $this->limitResult);
        if ($this->totalPages >= $this->page) {
            return $this->layoutPagination();
        }
        return header("Location: {$this->link}");        
    }
    
    private function layoutPagination()
    {
        $this->paginationFirst();
        $this->paginationBefore();
        $this->paginationCenter();
        $this->paginationAfter();
        $this->paginationLast();
    }
    
    private function paginationFirst()
    {
        $this->resultPagination =
            "<nav aria-label='paginacao'>
            <ul class='pagination justify-content-center'>
            <li class='page-item'>
            <a class='page-link' href=\"{$this->link}\" tabindex='-1'>Primeira</a>
            </li>";
    }
    
    private function paginationBefore()
    {
        for ($beforePag = $this->page - $this->maxLinks; $beforePag <= $this->page -1; $beforePag++) {
            if ($beforePag >= 1) {
                $this->resultPagination .= 
                    "<li class='page-item'>
                    <a class='page-link' href=\"{$this->link}?page={$beforePag}\">$beforePag</a>
                    </li>";
            }
        }
    }
    
    private function paginationCenter()
    {
        $this->resultPagination .=
            "<li class='page-item active'>
            <a class='page-link' href='#'>{$this->page}
            <span class='sr-only'>(current)</span>
            </a>
            </li>";
    }
    
    private function paginationAfter()
    {
        for ($afterPage = $this->page + 1; $afterPage <= $this->page + $this->maxLinks; $afterPage++) {
            if ($afterPage <= $this->totalPages) {
                $this->resultPagination .=
                    "<li class='page-item'>
                    <a class='page-link' href=\"{$this->link}?page={$afterPage}\">{$afterPage}</a>
                    </li>";
            }
        }
    }
    
    private function paginationLast()
    {
        $this->resultPagination .=
            "<li class='page-item'>
            <a class='page-link' href=\"{$this->link}?page={$this->totalPages}\">Útima</a>
            </li>
            </ul>
            </nav>";
    }
}
