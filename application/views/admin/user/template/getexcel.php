

	<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Sr.</th>
								<th>Username</th>
								<th>Email</th>
								<th>Phone</th>
								<!-- <th>Coin</th>
								<th>Available Coin</th>
								<th>Send Coin</th> -->

							</tr>
							</thead>
							<tbody>
							<?php $i = 1; foreach($list as $data){ ?>
								<tr>
									<td><?= $i;?></td>
									<td><?php  echo $data['username'];?></td>
									<td><?php  echo $data['email'];?></td>
									<td><?php  echo $data['phone'];?></td>
									<!-- <td>
										<?php if(!empty($data['coin'])){ echo $data['coin']; } else { echo "0"; }?>
									</td>
									<td>
										<?php if(!empty($data['purchasedCoin'])){ echo $data['purchasedCoin']; } else { echo "0"; }?>
									</td> -->
									<!-- <td>
											<?php
										$userIdss = $data['id'];
										$sendCoin = $this->db->query("SELECT sum(coin) as sendCoinTotal FROM `userGiftHistory` where userId = $userIdss")->row_array(); ?>
										<?php if(!empty($sendCoin['sendCoinTotal'])){ echo $sendCoin['sendCoinTotal']; } else { echo "0"; }?>
									</td> -->

								</tr>
							<?php $i++; } ?>
							<?php
    					header('Content-Type: application/xls');
             header('Content-Disposition: attachment; filename=download.xls');
						             ?>
							</tbody>
						</table>
