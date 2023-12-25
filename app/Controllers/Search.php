<?php
namespace App\Controllers;
use App\Models\Offers; 

    class Search {

        public function search(){
            $S_Offer = new Offers;
    

            if(isset($_GET["term"])) {
                $search = $_GET["term"];
                $jobOffers = $S_Offer->searchOffer($search);
                 
                
                   
            ?>
                       <?php foreach ($jobOffers as $offer): ?>
                        <article class="postcard light green">
                            <a class="postcard__img_link" href="#">
                                <img class="postcard__img" src="img/<?php echo $offer['img']; ?>" alt="Image Title" />
                            </a>
                          
                            <div class="postcard__text t-dark">
                                <h3 class="postcard__title green"><a href="#"><?php echo $offer['title']; ?></a></h3>
                                <div class="postcard__subtitle small">
                                    <time datetime="2020-05-25 12:00:00">
                                        <i class="fas fa-calendar-alt mr-2"></i><?php echo $offer['created_at']; ?>
                                    </time>
                                </div>
                                <div class="postcard__bar"></div>
                                <div class="postcard__preview-txt"><?php echo $offer['description']; ?></div>
                                <ul class="postcard__tagbox">
                                    <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $offer['company']; ?></li>
                                    <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                                    <?php 
                                     
                                    if($_SESSION['role'] === 'candidate'){
                                    echo '  <li class="tag__item play green">';
                                    echo '<a onclick="apply('.$offer['id'].')" ><i class="fas fa-play mr-2"></i>APPLY NOW</a>';
                                    echo '  </li>';
                                    }
                                    ?>
                                    <?php 
                                  
                                    if($_SESSION['role'] === 'admin'){
                                        echo'<a href="?route=UpdateOffers&upofferid='.$offer['id'] .'&updateimg='.$offer['img'].' " ><li class="tag__item"><i class="fas fa-clock mr-2"></i>update</li></a>';
                                        echo'<a href="?route=Dashboard&offerid='.$offer['id'] .' " ><li class="tag__item"><i class="fas fa-clock mr-2"></i>delete.</li></a>';
                                    
                                    }
                                    ?>
                                </ul>
                            </div>
                        </article>
                        <?php endforeach;
                                            
                    }
                        
        }

    } 