<?php


namespace src\database;


class Paginate
{

    private $total;
    private $totalPages;
    private $perPage;
    private $currentPage;

    public function __construct(int $total, int $perPage = 5, int $currentPage = 1)
    {
        
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->totalPages = ceil($total / $perPage);

    }


    public function links()
    {
        $links = "<ul class='pagination pagination-sm'>";
        if ($this->currentPage > 1) {
            $previous  = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, ["page" => $previous]));
            $first = http_build_query(array_merge($_GET, ["page" => 1]));
            // $links .= "<li class='page-item'><a href='?{$first}' class='page-link'>Primeira</a></li>";
            // $links .= "<li class='page-item'><a href='?{$linkPage}' class='page-link'><</a></li>";
        }


        $start = $this->currentPage - 6;
        $end = $this->currentPage + 6;

        for ($i = $start; $i <= $end; $i++) {
            if ($i > 0 and $i <= $this->totalPages) {
                $class = (($this->currentPage == $i) OR ($this->currentPage === 0 && $i === 1)) ? 'active' : '';
                $linkPage = http_build_query(array_merge($_GET, ["page" => $i]));
                $links .= "<li class='page-item {$class}' onclick='handleLoading()'><a href='?{$linkPage}' class='page-link'>{$i}</a></li>";
            }
        }


        if ($this->currentPage < $this->totalPages) {
            $next  = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, ["page" => $next]));
            $last = http_build_query(array_merge($_GET, ["page" => $this->totalPages]));
            // $links .= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>></a></li>";
            // $links .= "<li class='page-item'><a href='?{$last}' class='page-link'>Última</a></li>";
        }
        $links .= "</ul>";

        return $links;
    }
}
