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
    private array $genre;
    
    function __construct($id,$title,$overview,$vote,$language,$image,$genre){
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
            $template .= $n<= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        $template .= '</p>';
        return $template;
    }

    public function getFlag(){
        $initials =  strtoupper($this->original_language);
        switch ($initials) {
            case 'EN':
                $initials = 'GB';
                break;
            case 'JA':
                $initials = 'JP';
                break;
            case 'KO':
                $initials = 'KM';
                break;
        }
        if (!in_array($initials, ['GB', 'JP', 'KM', 'IT', 'FR'])) { 
            $initials = 'GB';
        }
        return 'https://flagsapi.com/' . $initials . '/shiny/32.png';
    }

    public function printCard(){
        $image = $this->poster_path;
        $title = $this->original_title;
        $content = $this->overview;
        $custom = $this->getVote();
        $flag = $this->getFlag();
        $genre = $this->genre;
        include __DIR__.'/../Views/card.php';
    }
}

$movieString = file_get_contents(__DIR__.'/movie_db.json');
$movieList = json_decode($movieString,true);
$movies=[];
foreach($movieList as $item){

    //mette in genres_item tutti i generi del film in base all'id, NON ESSENDO COLLEGATI REALMENTE I GENERI: vado a prendere ogni casistica (gli id sembrano andare da 10 a 1000) ed avendo 7 generi li ho suddivisi inequalmente (in quando sopra i 100 sono meno rari) se presenti più id nello stesso range non viene aggiunto
    $genres_item = [];
    foreach($item['genre_ids'] as $current_genre){
        if($current_genre<20){
            $current_genre = $genres[0];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }elseif($current_genre>20 && $current_genre<40){
            $current_genre = $genres[1];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }elseif($current_genre>40 && $current_genre<60){
            $current_genre = $genres[2];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }elseif($current_genre>60 && $current_genre<80){
            $current_genre = $genres[3];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }elseif($current_genre>80 && $current_genre<100){
            $current_genre = $genres[4];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }elseif($current_genre>100 && $current_genre<500){
            $current_genre = $genres[5];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }else{
            $current_genre = $genres[6];
            if(!in_array($current_genre,$genres_item)){
                $genres_item[] = $current_genre;
            }
        }
    }
    //istanzio i film
    $movies[] = new Movie($item['id'],$item['title'],$item['overview'],$item['vote_average'],$item['original_language'],$item['poster_path'], $genres_item);
}
?>