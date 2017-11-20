<?php

class ControllerComponentPagination
{
    protected $targetpage = '';
    //items to show per page
    protected $resultsPerPage = 3;
    //adjacent pages
    protected $adjacents = 2;
    //number Of Pages
    protected $numberOfPages;
    //first item to display on page
    protected $pageFirstResult;
    //active page
    protected $page;
    //previous page
    protected $prevPage;
    //next page
    protected $nextPage;
    //last page
    protected $lastPage;
    //last page minus 1
    protected $lpm1;
    //order by
    protected $order;
    //sort by
    protected $sort;

    //structure of paging
    protected $pagination;
}
