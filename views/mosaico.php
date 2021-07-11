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