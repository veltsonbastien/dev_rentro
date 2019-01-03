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
 }

 function sendBackProduct($conn){
   if(isset($_POST['sendback'])){
      $productIDtoVerify =  $_POST['currentProductID']; 
      $retrieveID = "SELECT accountID FROM rentro_products_reivew WHERE productID = '$productIDtoVerify'"; 
      $currentRetrieveID = $conn->query($retrieveID); 
       if(mysqli_num_rows($currentRetrieveID)>0){
        while($rowProduct = mysqli_fetch_assoc($currentRetrieveID)){
            $IDtoUse = $rowProduct['accountID']; 
            $pN = $rowProduct['productName'];
            $pD = $rowProduct['productDesc'];
            $pL = $rowProduct['productLS']; 
            $pR = $rowProduct['productRP'];            
        }
      }
      $userInformationSQL = "SELECT * FROM rentro_accounts";
      $userInformationQuery = $conn->query($userInformationSQL); 
        if(mysqli_num_rows($userInformationQuery)>0){
        while($rowAccount = mysqli_fetch_assoc($userInformationQuery)){
            $IDtoUse = $rowAccount['accountID'];         
        }
      }//end of retrieving account
   } //end of isset 
 }
