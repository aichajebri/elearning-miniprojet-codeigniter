<main>
    <div class="add_form">
        <center>

            <form action="<?php echo base_url('/instructor/add_course') ?>" method="post" enctype="multipart/form-data">
                <!-- Title-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Title</label>
                    <div class="col-md-4">
                        <input id="textinput" name="title" type="text" placeholder="Course title" class="form-control input-md" required="">

                    </div>
                </div>



                <!-- Image -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Course Image</label>
                    <div class="col-md-4">

                        <input type="file" name="courseImage" id="fileToUpload" class="btn btn-outline-secondary" required>
                        <!--                    <input id="textinput" name="textinput" type="text" placeholder="Course title" class="form-control input-md" required="">-->

                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">Description</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>




                <input type="submit" class="btn btn-outline-primary" value="Upload Course" name="submit">
        </center>
        </form>
    </div>
</main>