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

    .course_details>img {
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


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new Chapter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form-horizontal" action="<?php echo base_url('/instructor/add_chapter') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="course_id" value="<?php echo $course_id;  ?>">


                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-10 control-label" for="selectbasic">Select Type</label>
                        <div class="col-md-10">
                            <select id="chapter_type" name="chapter_type" class="form-control">
                                <option selected="true" disabled="disabled"> Choose type</option>
                                <?php
                                foreach ($chapter_types as $type) { ?>
                                    <option value="<?php echo $type['id'];  ?>"> <?php echo $type['label'];  ?> </option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="form-group" id="image">
                        <label class="col-md-10 control-label" for="image">Image</label>
                        <div class="col-md-10">
                            <input name="image" class="input-file" type="file">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group" id="link">
                        <label class="col-md-10 control-label" for="link">Url</label>
                        <div class="col-md-10">
                            <input name="link" type="text" placeholder=" link" class="form-control input-md">

                        </div>
                    </div>


                    <!-- Text input-->
                    <div class="form-group" id="video">
                        <label class="col-md-10 control-label" for="video">Video</label>
                        <div class="col-md-10">
                            <input name="video" type="text" placeholder="Youtube link" class="form-control input-md">

                        </div>
                    </div>


                    <!-- Textarea -->
                    <div class="form-group" id="text">
                        <label class="col-md-10 control-label" for="text">Text</label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="text chapter" name="text"> </textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" id="add_chapt_btn" value="Save changes" class="btn btn-primary" />
                </div>
                <!--            End form HERE -->
            </form>
        </div>
    </div>
</div>
<!-- ENd modal section -->

<main>

    <div class="course_details">
        <img src="<?php echo $img_path . '/' . $course['image'] ?>" alt="" />
        <h3> <?php echo $course['title']; ?></h3>
        <div class="desc">
            <em>Description</em>
            <p> <?php echo $course['description']; ?> </p>
        </div>
    </div>


    <a href="#" class="btn btn-info add_chapter" data-toggle="modal" data-target="#exampleModalLong"> Add new
        Chapter </a>


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
                            src="' . $img_path . '/' . $chapter['image'] . '"
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


        <!--        <div class="chapter">lorem ipsum xxx</div>
                <div class="chapter">lorem ipsum xxx</div>
                <div class="chapter doc"> download doc <a href="#">PDF</a></div>
                <div class="chapter">lorem ipsum xxx</div>
                <div class="chapter">lorem ipsum xxx</div>
                <div class="chapter video">

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/t_Kd_G7p6ZQ"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                </div>
                <div class="chapter">lorem ipsum xxx</div>
                <div class="chapter doc"> download doc <a href="#">PDF</a></div>
                <div class="chapter image"><img
                            src="https://assets.justinmind.com/wp-content/uploads/2018/11/Lorem-Ipsum-alternatives-768x492.png"
                            alt=""></div>
                <div class="chapter doc"> download doc <a href="#">PDF</a></div>-->


    </div>

</main>


<script>
    $(document).ready(function() {
        // Hide all options loaded
        // $('#image').hide() ;
        // $('#text').hide() ;
        // $('#link').hide() ;
        // $('#document').hide() ;
        enable();



        //   disable the submit button
        $('#add_chapt_btn').prop("disabled", true);


        $('#chapter_type').on('change', function() {
            console.log(this.value);
            console.log($('#chapter_type :selected').text());
            let selected_opt = $('#chapter_type :selected').text();
            enable(selected_opt);


        });


        function enable(element = "") {
            $('#image').hide();
            $('#text').hide();
            $('#link').hide();
            $('#document').hide();
            $('#video').hide();

            if (element !== "") {
                console.log("#" + $.trim(element));
                $("#" + $.trim(element)).show();
                $('#add_chapt_btn').prop("disabled", false);
            }

        }



    });
</script>