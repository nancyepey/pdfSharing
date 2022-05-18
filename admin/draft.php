

  <!-- add news tab for lang-->
  <div id="tabadd">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Add</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">En</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Fr</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Config</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <!-- add news form -->
                                        <form action="" method="post">
                                            <!-- add news config -->
                                            <div class="mb-3">
                                                <label for="thumb" class="form-label">Thumbnail</label>
                                                <div class="drag-area">
                                                    <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                    <header>Drag & Drop to Upload File</header>
                                                    <span>OR</span>
                                                    <button>Browse File</button>
                                                    <input type="file" name="thumbnail" hidden>
                                                </div>
                                            </div>                        
                                            <!-- <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                            </div> -->
                                            
                                            <!-- submit btn -->
                                            <div class="mb-3">
                                                <input type="submit" name="Add News" value="Add New" id="addNews" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <!-- for en -->
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp">
                                            <div id="titleHelp" class="form-text">Write a captivating title.</div>
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" cols="20" rows="4" aria-describedby="short_descHelp"></textarea>
                                            
                                            <div id="short_descHelp" class="form-text">Not more than 100 words.</div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <!-- for fr -->
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <!-- more config -->
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>



