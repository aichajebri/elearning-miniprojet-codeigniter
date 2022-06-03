<?php
// function checkLength() ---
function checkLength($description)
{

    if (strlen($description) < 75) {
        return $description;
    } else {
        return substr($description, 0, 75) . '...';
    }
}
?>
<style>
    .card {
        background-color: dodgerblue;
        color: white;
        padding: 1rem;
        /*height: 4rem;*/
    }

    .cards {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-gap: 1rem;
    }

    .card {
        background-color: #9e9e9e54;
        color: white;
        padding: 1rem;
        /* height: 4rem; */
        color: black;
        max-height: 530px;
    }

    .card a {
        text-decoration: none;
        color: black;
    }

    .enroll_btn {
        background-color: #f91616;
        position: absolute;
        /* top: 277px; */
        font-weight: 700;
        display: inline;
        width: 106px;
        padding: 0.4rem;
        z-index: 6;
        bottom: 4px;
    }


    @media (min-width: 600px) {
        .cards {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<main>


    <div class="cards">
        <?php
        foreach ($courses as $course) {
        ?>

            <div class="card">

                <img src="<?php echo $img_path . '/' . $course['image']; ?>">
                <a href="<?php echo site_url() . '/student/open_course/' . $course['id'];  ?>">
                    <h4> <?php echo $course['title'];  ?> </h4>
                    <p><?php echo checkLength($course['description']); ?></p>
                </a>
                <br><br>
                <a class="enroll_btn" href="<?php echo site_url('/student/enroll/' . $course['id']) ?>">Enroll NOW</a>
            </div>


        <?php }
        ?>

    </div>

</main>