 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: rgba(0, 0, 0, 0);">
                    	 <h1 class="text-uppercase text-black font-weight-bold">Learn to sell</h1>
                        <!-- <hr class="divider my-4" /> -->
                    </div>
                    
                </div>
            </div>
        </header>

    <!--<section class="page-section">
        <div class="container">     
        </div>
        </section>-->

    <!-- PDF Section -->


<!--<section class="page-section">
    <div class="container">
        <object data= "learnings/01_Introduction.pdf" width="400" height="400"> </object> 
    </div>
</section>-->

<section class="page-section">
    <div class="container">
        <div class="row">
            <?php
                // Directory where PDFs are stored
                $pdfDirectory = 'learnings';

                // Get all PDF files from the directory
                $pdfFiles = glob($pdfDirectory . '/*.pdf');

                // Display PDFs with embedded viewer and download button
                $count = 0;
                foreach ($pdfFiles as $pdfFile) {
                    $title = pathinfo($pdfFile, PATHINFO_FILENAME);
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $title; ?></h5>
                                <object data="<?php echo $pdfFile; ?>" type="application/pdf" width="100%" height="200">
                                    <p>It appears you don't have a PDF plugin for this browser.
                                        No biggie... you can <a href="<?php echo $pdfFile; ?>" download>click here to download the PDF file.</a></p>
                                </object>
                                <a href="<?php echo $pdfFile; ?>" download class="btn btn-primary mt-2">Download PDF</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                    // Close the row and start a new one after every 3 PDFs
                    if ($count % 3 === 0) {
                        echo '</div><div class="row">';
                    }
                }
            ?>
        </div>
    </div>
</section>