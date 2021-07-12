<?php
include_once("../connection/db_connection.php");
include_once("../templates/header.php");
include_once("../templates/navigation.php")
?>

<div class="page-content">
    <div class="grid-layout">
        <div class="vertical-timeline-layout">
            <div class="vertical-timeline">
                <div class="year-interval year-interval-icon">
                    <a href="/anuario/index.php"><img src="/anuario/img/icons/year-interval-icon.svg" alt="year-icon"></a>
                </div>
                <div class="year-interval">1990</div>
                <div class="year-interval">1990</div>
                <div class="year-interval">1990</div>
                <div class="year-interval">1990</div>
                <div class="year-interval">1990</div>
                <div class="year-interval">1990</div>
            </div>
        </div>
        <div class="mini-cards-layout" id="mini-cards-layout">
            <div class="year-title">2010</div>
            <!-- Javascript agrega las tarjetas -->
            <?php
                $conection = mysqli_connect($host, $user, $pw, $db);
                $query = "SELECT * from miembros";
                $result = mysqli_query($conection, $query);
                $contador = 0;
                while($row = $result->fetch_array(MYSQLI_NUM)){
                    $id = $row[0];
                    $primerNombre = $row[1];
                    $segundoNombre = $row[2];
                    $nombrePreferido = $row[3];
                    $primerApellido = $row[4];
                    $segundoApellido = $row[5];
                    $nombreEnRama = $row[6];
                    $anioIngresoRama = $row[7];
                    $anioSalidaRama = $row[8];
                    $correo = $row[9];
                    $celular = $row[10];
                    $frase = $row[11];
                    $urlFoto = $row[12];
                    $urlLinkedin = $row[13];
                    $contador++;
            ?>
            <div class="mini-card" data-id="<?php echo $id ?>">
                <div class="bg-blue">
                    <div class="img-container">
                        <img class="member-img" src="<?php echo $urlFoto ?>">
                        <div class="glass-hover">
                            <i class="fas fa-arrow-circle-right fa-3x"></i>
                            <p>Ver Más</p>
                        </div>
                    </div>
                    <?php 
                        if($nombrePreferido==1){
                    ?>
                    <p class="member-name"><?php echo $primerNombre ?> <?php echo $primerApellido ?></p>
                    <?php 
                        }else{
                    ?>
                    <p class="member-name"><?php echo $segundoNombre ?> <?php echo $primerApellido ?></p>
                    <?php 
                        }
                    ?>
                </div>
                <div class="insignias">
                    <i class="fab fa-facebook-square"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-linkedin"></i>
                    <i class="fas fa-medal"></i>
                    <i class="fas fa-medal"></i>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
    <div class="card-view-layout" id="card-view-layout">
        <div class="empty-panel" id="card-view-empty-panel"></div>
        <div class="card-view" id="card-view">
            <div class="flip-container" id="flip-container">
            </div>
        </div>
    </div>
</div>

<?php
include_once("../templates/footer.php");
?>