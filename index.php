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
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/5.jpg" alt="1-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/7.jpg" alt="2-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/8.jpeg" alt="3-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/6.jpg" alt="4-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/1.jpg" alt="5-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/3.jpg" alt="1-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
        <div class="time-interval">
            <a href="/anuario/views/mosaico.php">
                <div class="flex-1"></div>
                <img src="/anuario/img/timeline/4.jpg" alt="1-range">
                <div class="vertical-line"></div>
                <span>2010s</span>
            </a>
        </div>
    </div>
</div>

<?php
include_once("templates/footer.php");
?>