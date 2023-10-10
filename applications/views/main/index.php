<p> главная страница</p>
<?php foreach($news as $value){?>

    <h1><?=$value['title']?></h1>
    <h3 style="width:50%;"><?=$value['descText']?></h1>
<?php }?>