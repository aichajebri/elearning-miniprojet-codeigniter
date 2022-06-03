<style xmlns:https="http://www.w3.org/1999/xhtml">
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
    }

    .course_details h3 {
        font-size: 2.6rem;
        margin-bottom: 0.8rem;
        margin-top: 0.8rem;
    }

    .course_details > img {
        display: block;
        margin: 0 0 15px;
        width: 100%;
        height: auto;
    }

    .desc p {
        padding: 1rem;
        border: 1px solid #dddddd;
        border-radius: 0.4rem;
        margin-bottom: 1rem;
        margin-top: 1rem;
    }

    em {
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -.02rem;
        font-size: 1.6rem;
        color: gray;
    }

    .chapter {
        margin-bottom: 1rem;
        border-bottom: 2px solid #9e9e9e61;
        padding-bottom: 2rem;
        width: 34vw;
        margin-top: 2rem;
    }

    .chapter img {
        max-width: 560px;
    }

    .chapters {
        margin-bottom: 10rem;
    }

    .add_chapter {
        position: fixed;
        right: 4rem;
        top: 7rem;
    }

    @media (min-width: 600px) {
        .cards {
            grid-template-columns: repeat(3, 1fr);
        }
    }

</style>


<main>

    <div class="course_details">
        <img src="<?php echo $img_path . '/' . $course['image'] ?>" alt=""/>
        <h3> <?php echo $course['title']; ?></h3>
        <div class="desc">
            <em>Description</em>
            <p> <?php echo $course['description']; ?> </p>
        </div>
    </div>


    <div class="chapters">

        <?php
        /*    var_dump($chapters);
            die ;*/
        //    check if there is chapters
        if (count($chapters) === 0) {
            // die("There is no chapters ");
            echo "There is no chapters";
        } else {
            echo '<em> Chapitres</em>';
            foreach ($chapters as $chapter) { ?>

                <?php
                //            for image
                if (!empty($chapter['image'])) {

                    echo '<div class="chapter image"><img
                            src="'.$img_path.'/'.$chapter['image'].'"
                            alt=""></div>';
                }
                ?>


                <?php
                //            for text
                if (!empty($chapter['text'])) {
                    echo '<div class="chapter">' . $chapter['text'] . '</div>';
                }
                ?>


                <?php
                //            for document
                if (!empty($chapter['doc'])) {
                    echo ' <div class="chapter doc"> download doc <a href="#">PDF</a></div>';
                }
                ?>

                <?php
                //            for video
                if (!empty($chapter['video'])) {
                    //  HSS ::>  Edited - for this version we accept only Youtube as video provider
                    //                    youtube link example: https://www.youtube.com/watch?v=lp-EO5I60KA

                    $msk = explode('=', $chapter['video']);
                    $id = $msk[1];
                    echo ' <iframe width="560" height="315" src="https://www.youtube.com/embed/' . $id . '"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>';
                }
                ?>


                <?php
            }
        }


        //        die;
        ?>


    </div>

</main>

