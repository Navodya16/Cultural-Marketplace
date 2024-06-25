<!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: rgba(0, 0, 0, 0);">
                    	 <h1 class="text-uppercase text-black font-weight-bold">My products</h1>
                        <!-- <hr class="divider my-4" /> -->
                    </div>
                    
                </div>
            </div>
        </header>

<section class="page-section" id="menu">
    <center><a class="btn btn-info btn-xl js-scroll-trigger" href="javascript:void(0)" id="add_product" data-id="<?php echo $_SESSION['login_user_id']; ?>" >Add Products</a></center>
    <br>
        <div id="menu-field" class="card-deck">
                <?php 
                    include'admin/db_connect.php'; //remove product categories 
                    //$qry = $conn->query("SELECT * FROM  product_list order by rand()"); //select only from non users , add product change to my projects, from there we can add new product
                    if(isset($_SESSION['login_user_id'])) 
                    {
                        $qry = $conn->query("SELECT * FROM  product_list WHERE user_id = '".$_SESSION['login_user_id']."' order by rand() ");
                    }
                    //else{
                     //   $qry = $conn->query("SELECT * FROM  product_list order by rand()");
                    //}

                    
                    while($row = $qry->fetch_assoc()): 
                    ?>
                    <div class="col-lg-3">
                     <div class="card menu-item ">
                        <img src="assets/img/<?php echo $row['img_path'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $row['name'] ?></h5>
                          <h6 class="card-title">Unit Price : Rs. <?php echo $row['price'] ?></h6>
                          <!--<p class="card-text truncate">Available: alkaine, purified and mineral</p>-->
                          <div class="text-center">
                              <button class="btn btn-sm btn-outline-primary view_prod btn-block" data-id=<?php echo $row['id'] ?>><i class="fa fa-eye"></i> View</button>
                              
                          </div>
                        </div>
                        
                      </div>
                      </div>
                    <?php endwhile; ?>
        </div>
    </section>
    <script>
        
        $('.view_prod').click(function(){
            uni_modal_right('Product','view_prod.php?id='+$(this).attr('data-id'))
        })
    </script> 
	
