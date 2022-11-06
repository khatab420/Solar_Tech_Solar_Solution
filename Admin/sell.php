  <?php  
                    
                        if (isset( $_POST['userid'])) {
                            $userid = $_POST['userid'];
                            // echo $userid;
                            include('DBConnection.php');
                            $sql ="SELECT * FROM `goods`WHERE goods_id=".$userid;
                            $result = $conn->query($sql);
                            while($row = $result ->fetch_assoc()){
                                echo '<div class="row">
                                         <img class="card-img-top img-rsponsive" src="'.$row["image"].'" style="width:100%; height:260px; display: inline-block; border-reduced:5px">
                                            <div class ="col">  
            
                                                 <div class="card" style="width:100%">
                                                     <div class =""></div> 
                                                          <div class="card-body text-end">
                                                             <h4 class="card-title"> د محصول په اړه مالومات</h4>
                                                                <ul style="list-style-type:none">
                                                                    <li><span>نوم:</span>' .$row["goods_name"].'</li>
                                                                    <li><span>چزیات:</span>'.$row["goods_discription"].'</li>
                                                                    <li><span>د اخستلو بیه :</span>' .$row["buy_price"].'</li>
                                                                 </ul>
                                                   <a href="#demo" class="btn btn-outline-warning d-flex justify-content-center" data-bs-toggle="collapse" style ="text-align:center;width:100%">Sell</a>
                                                            
                                                            </div>
                                            </div> </div>
                                       </div>


                                       ';
                             }
                         }