<?php
 
 function checkProduct($conn){
   if(isset($_POST['approve'])){
      $productIDtoVerify =  $_POST['currentProductID']; 
      $retrieveID = "SELECT * FROM rentro_products_review WHERE productID = '$productIDtoVerify'"; 
      $currentRetrieveID = $conn->query($retrieveID); 
       if(mysqli_num_rows($currentRetrieveID)>0){
        while($rowProduct = mysqli_fetch_assoc($currentRetrieveID)){
            $IDtoUse = $rowProduct['accountID'];    
            $PIDtoUse = $rowProduct['productID'];  
            $pN = $rowProduct['productName'];
            $pD = $rowProduct['productDesc'];
            $pL = $rowProduct['productLS']; 
            $pR = $rowProduct['productRP'];       
            $insertIntoSQL = "INSERT INTO rentro_products (accountID,productID, productName,productDesc, productLS, productRP) 
                                   VALUES ('$IDtoUse', '$PIDtoUse', '$pN', '$pD', '$pL', '$pR')"; 
            $insertIntoQuery = $conn->query($insertIntoSQL); 
            $deleteFromSQL = "DELETE FROM rentro_products_review WHERE productID = '$productIDtoVerify' "; 
            $deleteFromQuery = $conn->query($deleteFromSQL); 
        }
      }//end of retrieving id 
   } //end of isset 
   ///BEGINNING OF NEXT ISSET
      if(isset($_POST['sendback'])){
      $productIDtoVerify =  $_POST['currentProductID']; 
      $retrieveID = "SELECT * FROM rentro_products_review WHERE productID = '$productIDtoVerify'"; 
      $currentRetrieveID = $conn->query($retrieveID); 
       if(mysqli_num_rows($currentRetrieveID)>0){
        while($rowProduct = mysqli_fetch_assoc($currentRetrieveID)){
            $IDtoUse = $rowProduct['accountID']; 
            $pN = $rowProduct['productName'];
            $pD = $rowProduct['productDesc'];
            $pL = $rowProduct['productLS']; 
            $pR = $rowProduct['productRP'];     
            $aESQL = "SELECT accountEM FROM rentro_accounts WHERE accountID = '$IDtoUse' ";    
            $aeQuery = $conn->query($aESQL);  
            if(mysqli_num_rows($aeQuery)>0){
                while($rowEmail = mysqli_fetch_assoc($aeQuery)){
                    $emailToUse = $rowEmail['accountEM']; 
                }
            }      
        }
      }//end of biggest if
      echo "
      <div class = 'edit-box'> 
          <button class = 'closeEditBox' aria-label='Close' >X</button>
          <form class = 'issue-select-form' method = 'POST' action = '' style = 'margin: 30px 5px;'> 
            <h2> Please select the issue(s) with this post: </h2> <br> 
              <input class = 'edit-box-input' type='radio' name='issue' value='invalid-name' checked> Name is not descriptive enough, or seems to falsely advertise. <br>
              <input class = 'edit-box-input' type='radio' name='issue' value='invalid-description'> Description does not metion enough about the device, or is missing. <br>
              <input class = 'edit-box-input' type='radio' name='issue' value='invalid-weeks'> Weeks are either missing, or a decimal, or zero. <br> 
              <input class = 'edit-box-input' type='radio' name='issue' value='invalid-replacement-price'> Replacement Price is either missing, or too high for product in current condition. <br> 
              <input class = 'edit-box-input' type='radio' name='issue' value='invalid-pictures'> Photos are either unable to be displayed, or do not provide enough information to potential buyers. <br> 
              <input class = 'edit-box-input' type='radio' name='issue' value='invalid-other'> Other Issue <br> 
              <textarea class = 'edit-box-input edit-box-textarea'  name = 'issue' placeholder = 'Please add more to describe the issue here. The producer will be able to see this comment.' style = 'resize:none' ></textarea> 
              <input type = 'hidden' name = 'userEmail' value = $emailToUse>
              <input type = 'hidden' name = 'userpN' value = $pN>
              <input type = 'hidden' name = 'userpD' value = $pD>
              <input type = 'hidden' name = 'userpL' value = $pL>
              <input type = 'hidden' name = 'userpR' value = $pR>          
              <button class = 'SI-bottom-button edit-box-button' name = 'submitIssue'>Send Back</button> 
          </form> 
      </div>  
      
      "; 
   } //end of isset 

 }

 function sendIssue(){
  if(isset($_POST['submitIssue'])){
    $currentEmail = $_POST['userEmail'];
    $currentPN = $_POST['userpN'];
    $currentPD = $_POST['userpD'];
    $currentPL = $_POST['userpL'];
    $currentPR = $_POST['userpR'];
    $currentIssues = $_POST['issue']; 

    if(empty($currentEmail) || empty($currentIssues) || empty($currentPD) || empty($currentPL) || empty($currentPN) || empty($currentPR)){
        //error whatever
    } else {
        //do the email yooha here
    }

  }//end of isset

 }
