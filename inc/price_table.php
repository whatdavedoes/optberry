<script>let basePrice = <?php echo $product['base_price']; ?></script>

                    <div style="background: #FFF; border-radius: 4px;" class="shadow p-3">
                                            
                      
                        
                    <table class="table table-borderless table-sm mb-0 pb-0">
                      <thead>
                        
                      </thead>
                      <tbody>
                          
                        <tr style="font-size: .9em;" class="border-bottom">
                          <td>Base Price</td>
                          <td class="text-right"><?php echo $basePrice; ?></td>
                        </tr>
                          
                        <tr style="font-size: .9em;" class="border-top">
                          <td>Add-Ons<a id="addOnCtrl" class="text-decoration-none noVis" data-toggle="collapse" href="#addOn" role="button" aria-expanded="false" aria-controls="collapseExample">
                              
                          <!--addOnCtrl-->
                          <span class="badge badge-pill badge-secondary ml-2 pt-1">View</span>
                          </a></td>
                            
                          <td id="addOnPrice" class="text-right"></td>
                        </tr>
                          
                        
                        </tbody>
                    </table>
                        
                    <!--addOn-->      
                    <div class="collapse noVis" id="addOn">
                      
                            <table id="addOnTbl" style="font-size: .9em;" class="table table-borderless table-sm mb-0">
                             
                                
                            </table>
                      
                    </div>    
                        
                    <table class="table table-borderless table-sm mt-1 mb-0">
                        <tr style="font-size: 1.2em; color:#FFF; background-color: #303030;" class="font-weight-bold">
                          <td >Subtotal</td>
                          <td id="subtotal" class="text-right"></td>
                        </tr>
                    </table>  
                        
                    <div id="beforeBuyBtn" style="text-align: center" class="">
                     <button style="opacity: 0.2" type="button" class="btn btn-secondary btn-sm mt-3" disabled data-toggle="tooltip" data-placement="top" title="Tooltip on top">Buy Now</button> 
                     <p class="text-muted pb-0 mb-0 mt-2" style="font-size: 12px; max-width: 160px; margin: 0 auto; font-style: italic;">*Please finish all required selections to purchase.</p>     
                   </div>
                        
                    <div id="afterBuyBtn" style="text-align: center" class="mt-4 noVis">
                     <img class="labIco" src="/img/lab-ico-min.png">
                     <p class="text-muted pb-0 mb-0 mt-2" style="font-size: 12px; max-width: 160px; margin: 0 auto; font-style: italic;">*This product is fictional and not available for purchase. It was made up by <a class="nb-link" href="https://www.nibtrek.com" target="_blank"> <img class="nb-sm" src="/img/nibtrek_logo_sm-min.png">NibTrek</a> to present the capabilities of the Optberry web application.</p>     
                   </div>     
                        
                    
                        
                                                 
                                              
                    
                    </div>
             