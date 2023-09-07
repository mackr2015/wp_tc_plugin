<?php


    $ch = curl_init();
    $posts_per_page = 3;
    $url = 'https://techcrunch.com/wp-json/wp/v2/posts?per_page='.$posts_per_page.'&context=embed';
    
    curl_setopt($ch, CURLOPT_URL, $url);
    // Disable SSL certificate verification
    // for local debug and testing
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    
    if ($err) {
        $response = "cURL Error #: " . $err;
    } else {
        $response = json_decode($response, true);

?>
<div class="news_wrapper">

<?php  foreach($response as $data):?>
       
        <div class="news_wrapper__item">
            <a href="<?php echo $data['link'];?>" target="_blank">
                <h4><?php echo $data['title']['rendered'];?></h4>
                <div class="date">
                    <?php  
                    $date = new DateTime($data['date']);
                    $formattedDate = $date->format("F j, Y");
                    ?>
                    <span>Published on: <?php echo $formattedDate;?></span>
                </div>
                <p class="description">
                    <?php echo $data['yoast_head_json']['description']; ?>
                </p>
            </a>
            
        </div>

<?php endforeach;?>

</div>
<?php 
}
?>

<style>
    .news_wrapper {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 20px;
        padding: 40px 0;
    }

    .news_wrapper__item {
        padding: 10px 15px;
        box-shadow: 0 4px 6px 3px rgba(0,0,0,0.1);
        border-radius: 8px;
    }

    .news_wrapper__item a {
        text-decoration: none;
    }
    .news_wrapper__item a:hover .date span {
        color: initial;
    }
    .news_wrapper__item .date {
        padding: 0;
        margin: 10px 0;
    }
    .news_wrapper__item .date span {
        font-size: 14px;
        font-weight: bold;
        display: block;
    }
</style>
