<?php
session_start(); 
include 'header.php'; 
include 'sendback_or_approve.php'; 

echo "
<body>
        <div class = 'loader-div' style = 'display:block'>
          <div class = 'loader'> </div>
        </div>

 <div class = 'container-fluid'> 
              <h1 class = 'display-1' style = 'text-align: CENTER; margin-top:30px; '> Products Pending Reivew </h1>
              <h3 class = 'showme-text'  style = 'text-align: CENTER;'>Check that each post follows the Posting Guidelines</h3>
              <h4 class = 'CS-top-text' style = 'text-align: LEFT; width:50%; font-size:20px; margin-top: 50px; margin-left:25%;'>Orders:</h4>
 </div> 
      <form method = 'POST' action = '".checkProduct($conn)."'> 
 "; 
 $retrieveOrder = "SELECT * FROM rentro_products_review ORDER BY created_at DESC";
 $getOrder = $conn->query($retrieveOrder);
 $firstSlideCount = 1; 
 if(mysqli_num_rows($getOrder)>0){
   while($rowOrder = mysqli_fetch_assoc($getOrder)){
      //get the pid of the current order 
      $useCurrentPID = $rowOrder['productID']; 
       //get everything from the current product 
       $pN = $rowOrder['productName'];
       $pD = $rowOrder['productDesc'];
       $pL = $rowOrder['productLS']; 
       $pR = $rowOrder['productRP']; 
       $imageCount = 1; 
      //the sql query to get every image from the current order 
       $confirmIMG = "SELECT * FROM rentro_products_images WHERE productID = '$useCurrentPID'"; 
       $confirmResultIMG = $conn->query($confirmIMG); 
      //this echo is being done for each of the the times a product is being taken 
       echo " 
        <div class = 'confirm-item'> 
         <h2 class = 'confirm-item-li confirm-item-name'>$pN</h2> 
          <ul class = 'confirm-item-ul'> 
            <div class = 'containers'>
                <!--- MARKER OF CODE ------>
             ";
                    if(mysqli_num_rows($confirmResultIMG)>0){
                        while($rowImg = mysqli_fetch_assoc($confirmResultIMG)){   
                            $iS = $rowImg['imageSrc']; 
                            echo "
                              <div class='mySlides$firstSlideCount'>
                                <img src = 'rentro_product_images/$iS'/ style='width:300px, height:300px;'> 
                              </div>
                                ";                                
                        }
                    }  
            echo "           
                <div class = 'row'>
                                <!--- MARKER OF CODE IN THE SLIDER NAV------>
                ";
                    mysqli_data_seek($confirmResultIMG, 0); //this is so it can be reused
                    if(mysqli_num_rows($confirmResultIMG)>0){
                        while($rowImgs = mysqli_fetch_assoc($confirmResultIMG)){   
                            $iSS = $rowImgs['imageSrc']; 
                            echo"
                             <div class = 'column'>
                                <img class = 'demo cursor' id = 'previewIMG'src = 'rentro_product_images/$iSS' onclick='currentSlide$firstSlideCount($imageCount)'/> 
                                                <!--- MARKER OF CODE FOR PICTURES BEING CREATED IN NAV ------>
                             </div>
                            "; 
                            $imageCount++;
                        }
                    }  
            echo "          
                </div>  
            </div> <!--END OF CONTAINAER-->
            <div class = 'product-text'>
                <label class = 'confirm-item-label'>Product Description:</label> 
                <li class = 'confirm-item-li' style = 'padding-right:30px;'>$pD</li> 
                <label class = 'confirm-item-label'>Renting Out For:</label> 
                <li class = 'confirm-item-li' id='pL'>$pL weeks</li> 
                <label class = 'confirm-item-label'>Replacement Price:</label> 
                <li class = 'confirm-item-li' id='pL'>$$pR</li> 
            </div>
          </ul> 
        </div>
          <input type = 'hidden' name = 'currentProductID' value = $useCurrentPID > 
          <div class = 'bottom-buttons'> 
            <button class = 'SI-bottom-button' name = 'approve' id='postButton' style = 'margin-top:50px'>Approve Item </button> 
            <button class = 'SI-bottom-button' name = 'sendback' id='concernButton' style = 'margin-top:50px'>Send Back</button> 
          </div> 
          <br> 
          <hr> 
          <br>
                        <!--- MARKER OF CODE ------>
                                        <!--- MARKER OF CODE ------>
  <script>
  
        var slideIndex = 1;
        showSlides$firstSlideCount(slideIndex);

        function plusSlides$firstSlideCount(n) {
        showSlides$firstSlideCount(slideIndex += n);
        }

        function currentSlide$firstSlideCount(n) {
        showSlides$firstSlideCount(slideIndex = n);
        }

        function showSlides$firstSlideCount(n) {
        var i;
        var slides = document.getElementsByClassName('mySlides$firstSlideCount');
        var dots = document.getElementsByClassName('demo');
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none';
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(' active', '');
        }
        slides[slideIndex-1].style.display = 'block';
        dots[slideIndex-1].className += ' active';
        }

        $(document).ready(function(){
             $('#continueButton').click(function(){
                 window.location.replace('index.php'); 
             }); 
        });
        
    </script> 
    <!---------------------------------------- ONE ITERATION DONE HERE ------------------------------------->
    </form>
       "; 
            //end of major form
           $firstSlideCount++; 
   } //end of largest mysqli while
 } //end of largest mysqli if 

 include 'footer.php'; 