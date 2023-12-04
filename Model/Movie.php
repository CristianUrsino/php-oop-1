<?php
include __DIR__.'/genre.php';
class Movie
{
    private int $id;
    private string $original_title;
    private string $overview;
    private float $vote_average;
    private string $poster_path;
    private string $original_language;
    private Genre $genre;
    
    function __construct($id,$title,$overview,$vote,$language,$image,Genre $genre){
        $this->id = $id;
        $this->original_title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote;
        $this->poster_path = $image;
        $this->original_language = $language;
        $this->genre = $genre;
    }

    public function getVote(){
        $vote = ceil($this->vote_average/2);
        $template = '<p>';
        for ($n=1;$n<=5;$n++){
            $template .= $n<= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-solid fa-star"></i>';
        }
        $template .= '</p>';
    }

    public function printCard(){
        $image = $this->poster_path;
        $title = $this->original_title;
        $content = $this->overview;
        $custom = $this->vote_average;
        $genre = $this->genre->name;
        include __DIR__.'/../Views/card.php';
    }
}

$movieString = file_get_contents(__DIR__.'/movie_db.json');
$movieList = json_decode($movieString,true);
$movies=[];
foreach($movieList as $item){
    $movies[] = new Movie($item['id'],$item['title'],$item['overview'],$item['vote_average'],$item['original_language'],$item['poster_path'], $genres[1]);//cambiare genre
}
var_dump($movies);
?>