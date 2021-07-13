<?php
    include_once("connection/db_connection.php");
    include_once("templates/header.php");
    include_once("templates/navigation.php");
?>

<div class="page-content">
    <div class="arrow left-arrow">
        <div class="center-arrow" id="left-arrow">
        </div>
    </div>
    <div class="arrow right-arrow">
        <div class="center-arrow" id="right-arrow">
        </div>
    </div>
    <div class="timeline" id="timeline">
        <?php 
            include "templates/auto-time-line.php";
            for($i=$anioInicio; $i<=$anioFinal; $i=$i+$intervalo){
        ?>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php?anio=<?php echo $i ?>">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/<?php echo $img ?>.jpg" alt="<?php echo $i ?>-Image">
                <div class="vertical-line"></div>
                <span><?php echo $i ?>s</span>
            </a>
        </div>
        <?php 
            $img++;
            }
        ?>
    </div>
</div>

<?php
    include_once("templates/footer.php");
?>