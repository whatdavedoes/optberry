<script>let basePrice = <?php echo $product['base_price']; ?></script>

                    <div style="background: #FFF; border-radius: 4px;" class="shadow p-3">
                      
                    <table class="table table-borderless table-sm mt-0">
                        <tr style="font-size: 1.2em;" class="table-secondary font-weight-bold">
                          <td>Subtotal</td>
                          <td id="subtotal" class="text-right"></td>
                        </tr>
                    </table>    
                        
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
                                
                                <!--<tr>
                                  <td colspan="2"><span class="pl-0">Shape</span></td>
                                </tr>

                                <tr>
                                  <td class="text-muted m-0" colspan="2"><span class="border-left pl-2">Model</span></td>
                                </tr>

                                <tr>
                                  <td><span class="border-left pl-4">Camila</span></td>
                                  <td class="text-right">2000</td>
                                </tr>-->
                                
                            </table>
                      
                    </div>
                        
                                                 
                                              
                    
                    </div>
             