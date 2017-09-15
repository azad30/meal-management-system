<div id="totalmembermeal" class="tab-pane fade">
				     <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
									     <th>Member</th>
										 <th>Total Meal</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$total = "SELECT meal.member_id,member.name,SUM(mealinput)
                                FROM meal,member
                                WHERE member.id=meal.member_id
                                GROUP BY member_id";
								$rundeposit = mysqli_query($connect,$total);
								while($row=mysqli_fetch_assoc($rundeposit)){
								?>
								     <tr>
                                        <td><?php echo $row['name'];?></td>
                                      </tr>
                                      <tr>
                                        <td><?php echo $row['SUM(mealinput)'];?></td>
                                     </tr>
								<?php } ?>		
                                </tbody>
                            </table>
                        </div>
                     </div>