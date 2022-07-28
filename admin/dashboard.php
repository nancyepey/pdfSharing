<?php include_once 'main.php'; ?>
<!-- content -->
<style>
  #white {
    color: white;
  }
</style>

<section style="margin-left: 250px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="row">

          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card bg-primary p-3">
              <figure class="p-3 mb-0" id="white">
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 " id="white">
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card bg-success p-3">
              <figure class="p-3 mb-0" id="white">
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 " id="white">
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card bg-info p-3">
              <figure class="p-3 mb-0" >
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 " >
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>

        </div>

        <!-- <div class="row">
          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card p-3">
              <figure class="p-3 mb-0">
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 text-muted">
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>
        </div> -->

        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <h6 class="border-bottom pb-2 mb-0">News that need validation</h6>
          <?php 

              //getting a news not validated
              $query = "SELECT * FROM news WHERE validated = 0 ";
              //
              $select_new_by_id= mysqli_query($conn, $query);

              //we need to values using a while loop
              while($row = mysqli_fetch_assoc($select_new_by_id)) {
                  //cat_categories table
                  //news table
                  $new_id            = $row['id'];
                  $new_thumb         = $row['thumbnail'];
                  $new_tten          = $row['title_en'];
                  $new_ttfr         = $row['title_fr'];
                  $new_cnfr          = $row['content_fr'];
                  $new_cnen         = $row['content_en'];
                  $new_sdfr         = $row['short_desc_fr'];
                  $new_sden         = $row['short_desc_en'];
                  $new_start         = $row['state'];
                  $new_valid         = $row['validated'];
                  $new_author         = $row['author'];
                  $new_translator         = $row['translator'];
                  $new_date          = $row['created_on'];

                
            ?>
          <div class="d-flex text-muted pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
              <div class="d-flex justify-content-between">
                <strong class="text-gray-dark"> <?php echo $new_tten; ?></strong>
                
              </div>
              <span class="d-block"> <?php echo $new_sdfr; ?></span>
              <a href="validate.php?a_id=<?= $new_id; ?>" target="_blank">Validate</a>
            </div>
          </div>
          <?php } ?>

          <!-- <div class="d-flex text-muted pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
              <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">Full Name</strong>
                <a href="#">Follow</a>
              </div>
              <span class="d-block">@username</span>
            </div>
          </div>

          <div class="d-flex text-muted pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
              <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">Full Name</strong>
                <a href="#">Follow</a>
              </div>
              <span class="d-block">@username</span>
            </div>
          </div> -->

          <small class="d-block text-end mt-3">
            <a href="#">View All</a>
          </small>
        </div>

        

        <div class="row">

          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card p-3">
              <figure class="p-3 mb-0">
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 text-muted">
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card p-3">
              <figure class="p-3 mb-0">
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 text-muted">
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card p-3">
              <figure class="p-3 mb-0">
                <blockquote class="blockquote">
                  <p>A well-known quote, contained in a blockquote element.</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0 text-muted">
                  Someone famous in <cite title="Source Title">Source Title</cite>
                </figcaption>
              </figure>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>